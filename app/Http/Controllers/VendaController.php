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
            $venda = Venda::paginate(10); 
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
            return view('venda.create')->with('produtos', $produtos)->with('servicos', $servicos)->with('associados', $associados)->with('pagamentos', $pagamentos);
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
        'desconto.between' => 'O :attribute é de 0% a 100%',
        'desconto.integer' => 'O :attribute deve ser um valor inteiro',
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
        'valor_unitario.required' => 'O valor unitário é obrigatorio',
        'valor_unitario.*.required' => 'O valor unitário é obrigatorio',
        'valor_unitario.*.gt' => 'O valor unitario do produto deve ser maior que 0',
        'valor_unitario_servicos.required' => 'O valor unitário é obrigatorio',
        'valor_unitario_servicos.*.required' => 'O valor unitário é obrigatorio',
        'valor_unitario_servicos.*.gt' => 'O valor unitário do serviço deve ser maior que 0',
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
            'desconto'=>'required|integer|between:0,100',
            'data_pagamento'=>'required|date|after:yesterday',
            'parcelas'=>'required|integer|min:1'], 
            $mensagens);

        if ($request->produtos!=null) {
            $request->validate([
                'produtos.*'  => 'distinct|required|integer',
                'quantidade'   => 'required|array',
                'quantidade.*'  => 'required|integer|gt:0',
                'valor_unitario'   => 'required|array',
                'valor_unitario.*'  => 'required|gt:0',
                //'preco_total'   => 'required|array',
                //'preco_total.*'  => 'required|gt:0',

            ], $mensagens);
        }

        if ($request->servicos!=null) {
            $request->validate([
                'servicos.*'  => 'distinct|required|integer',
                'valor_unitario_servicos'   => 'required|array',
                'valor_unitario_servicos.*'  => 'required|gt:0',
                //'preco_total_servicos'   => 'required|array',
                //'preco_total_servicos.*'  => 'required|gt:0',

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


                for ($i = 0; $i < count($request->produtos); $i++) 
                { 

                    $produto = Produto::find($request->produtos[$i]);

                    $pedido = new Pedido();
                    $pedido->produto_id = $request->produtos[$i];
                    $pedido->venda_id = $venda->getKey();
                    $pedido->valor_unitario = $request->valor_unitario[$i];
                    $pedido->quantidade = $request->quantidade[$i];
                    $pedido->valor_total_item = $request->valor_unitario[$i]*$request->quantidade[$i];//$request->preco_total[$i];

                    if($produto->estoque<$pedido->quantidade){
                        throw new \Exception('Quantidade do produto não existe em estoque');
                    }
                    else{
                        $produto->estoque = $produto->estoque - $pedido->quantidade;
                        $produto->save();
                    }

                    $pedido->save();

                    $total += $request->quantidade[$i]*$request->valor_unitario[$i];
                }
            } 

            //validação do form e venda dos servicos. 
            if ($request->servicos!=null) {
                for ($i = 0; $i < count($request->servicos); $i++) 
                { 

                    $pedido = new Pedido();
                    $pedido->servico_id = $request->servicos[$i];
                    $pedido->venda_id = $venda->getKey();
                    $pedido->quantidade= 1;
                    $pedido->valor_unitario = $request->valor_unitario_servicos[$i];
                    $pedido->valor_total_item = $request->valor_unitario_servicos[$i];
                    $pedido->save();

                    $total += 1*$request->valor_unitario_servicos[$i];         

                }

            }

            //Atualiza o valor da venda.
            $venda->valor_total_venda = $total - ($request->desconto/100)*$total; 
            $venda->valor_total_venda_sem_desconto =$total;
            $venda->update();

            //Divide as parcelas, suas datas e valores. 
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
