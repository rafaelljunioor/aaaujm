<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Exception;
use App\Venda;
use App\Produto;
use App\Servico;
use App\Pedido;
use App\Associado;
use App\Pagamento;
use App\Parcela;
use DateTime;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class VendaController extends Controller
{

    public function __construct()
    {
        // Nesse caso o middleware auth será aplicado a todos os métodos
        $this->middleware('auth');

    }
        
    public function buscaVendas(Request $request){

        if(Auth::check()){
              $venda = Venda::orWhereBetween('created_at',[$request->data_inicio,$request->data_termino])
              ->orWhere('id',$request->id_venda)
              ->orderBy('id', 'desc')
              ->get();
          return view('venda.resultadoBusca')->with('venda', $venda);
        }else{
            return redirect()->route('login');
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::check()){
            $venda = Venda::orderBy('id', 'desc')->paginate(10); 
            return view('venda.index')->with('venda', $venda);
        }else{
            return redirect()->route('login');
        }
    }

    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth::check()){
            $produtos = Produto::all();
            $associados = Associado::all();
            $pagamentos = Pagamento::all();
            $servicos = Servico::all();
            return view('venda.create')->with('produtos', $produtos)->with('servicos', $servicos)->with('associados', $associados)->with('pagamentos', $pagamentos)->with('now', Carbon::now());
        }else{
            return redirect()->route('login');
        }
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $mensagens = ['pagamento.required' => 'O campo :attribute é obrigatório',
        'desconto.required' => 'O campo :attribute é obrigatório',
        'desconto.gt' => 'O :attribute deve ser maior que 0',
        //'desconto.integer' => 'O :attribute deve ser um valor inteiro',
        'data_pagamento.required' => 'O campo :attribute é obrigatório',
        'parcelas.required' => 'O campo :attribute é obrigatório',
        'parcelas.min' => 'Numero minimo de parcelas é 1',
        'data_pagamento.after' => 'Data de pagamento válida de hoje em diante',
        'produtos.*.required' => 'O produto é obrigatorio',
        'produtos.*.distinct' => 'Produto duplicado',
        'servicos.*.required' => 'O servico é obrigatorio',
        'servicos.*.distinct' => 'Servico duplicado',
        'quantidade.required' => 'A quantidade de produtos é obrigatorio',
        'quantidade.*.required' => 'A quantidade de produtos é obrigatorio',
        'quantidade.*.gt' => 'A quantidade de produtos deve ser maior/igual a 1',
        'quantidade.*.integer' => 'A quantidade de produtos deve ser um valor inteiro',
        //'valor_unitario.required' => 'O valor unitário é obrigatorio',
        //'valor_unitario.*.required' => 'O valor unitário é obrigatorio',
        //'valor_unitario.*.gt' => 'O valor unitario do produto deve ser maior que 0',
        //'valor_unitario_servicos.required' => 'O valor unitário é obrigatorio',
        //'valor_unitario_servicos.*.required' => 'O valor unitário é obrigatorio',
        //'valor_unitario_servicos.*.gt' => 'O valor unitário do serviço deve ser maior que 0',
        'preco_total.required' => 'O preço total do produto é obrigatorio',
        'preco_total.*.required' => 'O preço total do produto é obrigatorio',
        'preco_total.*.gt' => 'O preço total do produto deve ser maior que 0',
        'preco_total_servicos.required' => 'O preço total é obrigatorio',
        'preco_total_servicos.*.required' => 'O preço total é obrigatorio',
        'preco_total_servicos.*.gt' => 'O preço total do serviço deve ser maior que 0',


    ];


        ///Inicia processo de venda apenas se existir um produto ou servico a ser comprado.

    if ($request->produtos!=null || $request->servicos!=null) { 

        $request->validate(['pagamento'=>'required',
            //'desconto'=>'required|integer|between:0,100',
            'desconto'=>'required|gt:0',
            'data_pagamento'=>'required|date|after:yesterday',
            'parcelas'=>'required|integer|min:1'], 
            $mensagens);

        if ($request->produtos!=null) {
            $request->validate([
                'produtos.*'  => 'distinct|required|integer',
                'quantidade'   => 'required|array',
                'quantidade.*'  => 'required|integer|gt:0'

            ], $mensagens);
        }

        if ($request->servicos!=null) {
            $request->validate([
                'servicos.*'  => 'distinct|required|integer',
                //'valor_unitario_servicos'   => 'required|array',
                //'valor_unitario_servicos.*'  => 'required|gt:0'
            ], $mensagens);

        }

        // Transação de venda será completa apenas se não ocorrer nenhum erro durante o processo
        DB::beginTransaction();

        try {

            $total = 0; /// valor total da venda

            $venda = new Venda();
            $venda->associado_id = $request->associado;
            $venda->pagamento_id = $request->pagamento;
            $venda->desconto = $request->desconto;
            $venda->valor_total_venda = 0;
            $venda->user_id = Auth::id();
            $venda->save();

            // Valida e registra venda de produtos
            if ($request->produtos!=null) {

                $total = $this->processaProdutos($request,$venda);
            } 

            //validação do form e venda dos servicos. 
            if ($request->servicos!=null) {
               
                $total += $this->processaServicos($request,$venda);
            }

            if($request->desconto>$total){
              throw new \Exception('Valor de desconto maior que preço da venda');
            }
            else{
              $venda->valor_total_venda = $total - $request->desconto; 
              $venda->valor_total_venda_sem_desconto =$total;
              $venda->update();
            }     

            $this->criaParcelas($request,$venda);

         DB::commit();

       } catch (Exception $e) {
          DB::rollback(); 
          $request->session()->flash('error', $e->getMessage());
          return redirect()->route('venda.create'); 
       }

      } else{
         $request->session()->flash('error', 'Um produto ou serviço deve ser preenchido');
         return redirect()->route('venda.create');
      }
    return redirect()->route('venda.index');
  }


    /**
     * Função responsável por calcular valor total dos pedido referente aos produtos
     * e gerar os pedidos dos N serviços solicitados.
     *
     * @param  Request  $request 
     * @param  Venda    $venda 
     * @return int      $total 
     */
    private function processaProdutos(Request $request, Venda $venda){
        $total = 0;

        for ($i = 0; $i < count($request->produtos); $i++) 
            { 
              $produto = Produto::find($request->produtos[$i]);

              $pedido = new Pedido();
              $pedido->produto_id = $request->produtos[$i];
              $pedido->venda_id = $venda->getKey();
                        //$pedido->valor_unitario = $request->valor_unitario[$i];
              $pedido->quantidade = $request->quantidade[$i];

              if($this->isAssociado($request) && $this->isValido($request)){
                
                $pedido->valor_unitario = $produto->preco_socio;
                $pedido->valor_total_item = $produto->preco_socio*$request->quantidade[$i];
                $total += $request->quantidade[$i]*$produto->preco_socio;

              }else{
                $pedido->valor_unitario = $produto->preco_nao_socio;
                $pedido->valor_total_item = $produto->preco_nao_socio*$request->quantidade[$i];
                $total += $request->quantidade[$i]*$produto->preco_nao_socio;

              }
              
              if($produto->estoque<$pedido->quantidade){
                  throw new \Exception('Quantidade do produto não existe em estoque');
              }
              else{
                  $produto->estoque = $produto->estoque - $pedido->quantidade;
                  $produto->save();
              }

              $pedido->save();
            }
          return $total;
      } 


    /**
     * Função responsável por calcular valor total dos pedido referente aos serviço
     * e gerar os pedidos dos N serviços solicitados.
     *
     * @param  Request  $request 
     * @param  Venda    $venda 
     * @return int      $total 
     */

    private function processaServicos(Request $request, Venda $venda){
        $total = 0;

        for($i = 0; $i < count($request->servicos); $i++) 
          { 
           $servico = Servico::find($request->servicos[$i]);

           $pedido = new Pedido();
           $pedido->servico_id = $request->servicos[$i];
           $pedido->venda_id = $venda->getKey();
           $pedido->quantidade= 1;
           $pedido->valor_unitario = $servico->preco_sugerido;
           $pedido->valor_total_item = $servico->preco_sugerido;
           $pedido->save();

           $total += $servico->preco_sugerido;         

          }
          return $total;
      }

    /**
     * Função responsável por gerar parcelas
     *
     * @param  Request  $request 
     * @param  Venda    $venda 
     * 
     */

    private function criaParcelas(Request $request, Venda $venda){
      for ($i = 0; $i < $request->parcelas; $i++) 
          { 
            $parcela = New Parcela();
            $parcela->venda_id = $venda->getKey();
            $parcela->numero = $i+1;

            $restoDivisao = $venda->valor_total_venda % $request->parcelas;


              if($i==0){  
                  $parcela->data_pagamento = $request->data_pagamento;
                  $dateCont = $request->data_pagamento;
              }
              else if($i>0){
                  $parcela->data_pagamento = date('Y-m-d', strtotime("+1 month",strtotime($dateCont)));
                  $dateCont = $parcela->data_pagamento;
              }

              $restoDivisao = fmod($venda->valor_total_venda,$request->parcelas);

               if($i==$request->parcelas-1){
                   $parcela->valor_parcela = intdiv($venda->valor_total_venda,$request->parcelas) + $restoDivisao;
               }
               else{
                   $parcela->valor_parcela = intdiv($venda->valor_total_venda,$request->parcelas);
               }
             $parcela->save();
         }
    }

     /**
     * Verifica se é associado
     *
     * @param  Request  $request
     * @return true ou false
     */

    private function isAssociado(Request $request){
      
      if($request->associado!=null){
        $associado = Associado::find($request->associado);
          if($associado->count()==0)
            return false;
          else
            return true;
      }else 
        return false;
    }

    private function isValido(Request $request){

      if($request->associado!=null){
        $associado = Associado::find($request->associado);
          if($associado->data_termino<Carbon::now())
            return false;
          else
            return true;
      }else
        return false;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(Auth::check()){
            $venda = Venda::find($id);
            
            $produtos = DB::table('pedidos')
            ->join('produtos', 'pedidos.produto_id', '=', 'produtos.id')
            ->join('vendas', 'vendas.id', '=', 'pedidos.venda_id')
            ->where('vendas.id', '=', $id)
            ->get();

            $servicos = DB::table('pedidos')
            ->join('servicos', 'pedidos.servico_id', '=', 'servicos.id')
            ->join('vendas', 'vendas.id', '=', 'pedidos.venda_id')
            ->where('vendas.id', '=', $id)
            ->get();

            

            return view('venda.show')->with('venda', $venda)->with('produtos', $produtos)->with('servicos', $servicos);
        }else{
            return redirect()->route('login');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        DB::table('parcelas')
        ->where('id', $id)
        ->update(['status' => 'PAGO']);

        return redirect()->back();

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
