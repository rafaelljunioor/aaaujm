<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Produto;
use App\Fornecedor;
use App\Tamanho;
use Illuminate\Support\Facades\DB;

class ProdutoController extends Controller
{

    
    public function __construct()
    {
        // Nesse caso o middleware auth será aplicado a todos os métodos
        $this->middleware('auth');

    }

    public function quantidadeJson(){

        //$number = DB::table('produtos')->count();
        $number = Produto::count();
        return json_encode($number);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::check()){
            if(Auth::user()->type == 2 || Auth::user()->type == 1){
                $produto = Produto::withTrashed()->paginate(15);
                return view ('produto.index')->with('produto', $produto);
            }else{
                return redirect()->back();
            }
        }else{
            return redirect()->back();
        }  
    }

    public function indexJson(){

        $produtos = DB::table('produtos')->get();

        return json_encode($produtos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth::check()){
            if(Auth::user()->type == 2 || Auth::user()->type == 1){
                $fornecedores = Fornecedor::all();
                $tamanhos = Tamanho::all();

                return view('produto.create')->with('fornecedores', $fornecedores)->with('tamanhos', $tamanhos);
            }else{
                return redirect()->back();
            }
        }else{
            return redirect()->back();
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

        $mensagens = ['nome.required' => 'O campo :attribute é obrigatório',
        'nome.max' => 'O campo :attribute deve possuir 191 caracteres',
        'tamanho_id.required' => 'O campo tamanho é obrigatório',
        'estoque.required' => 'O campo :attribute é obrigatório',
        'preco_sugerido.required' => 'O campo preço é obrigatório',
        'preco_sugerido.gt' => 'O campo :preço sugerido deve ser maior que 0',
        'fornecedor_id.required' => 'O campo fornecedor é obrigatório',
        'estoque.gt' => 'O campo :attribute deve ser maior que 0',
        'estoque.integer' => 'O campo :attribute deve ser inteiro',
    ];

    $request->validate([
        'nome'=>'required|max:191',
        'estoque'=>'required|gt:0',
        'preco_sugerido' => 'required|gt:0',
        'fornecedor_id' =>'required',
        'tamanho_id'=>'required'
    ] , $mensagens);

    Produto::create($request->all());
    $request->session()->flash('success', 'Produto inserido com Sucesso!');
    return redirect()->route('produto.index');
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
            if(Auth::user()->type == 2 || Auth::user()->type == 1){
               $produto = Produto::withTrashed()->find($id);
               return view('produto.show')->with('produto', $produto);
            }else{
                return redirect()->back();
            }
        }else{
            return redirect()->back();
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
        if(Auth::check()){
            if(Auth::user()->type == 2 || Auth::user()->type == 1){
               $produto = Produto::withTrashed()->find($id);
               $tamanhos = Tamanho::all();
               $fornecedores = Fornecedor::all();

               return view('produto.edit')->with('produto', $produto)->with('fornecedores', $fornecedores)->with('tamanhos', $tamanhos);
            }else{
                return redirect()->back();
            }
        }else{
            return redirect()->back();
        } 
   }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Produto $produto)
    {

        $mensagens = [
            'nome.required' => 'O campo :attribute é obrigatório',
            'nome.max' => 'O campo :attribute deve possuir 191 caracteres',
            'tamanho_id.required' => 'O campo tamanho é obrigatório',
            'estoque.required' => 'O campo :attribute é obrigatório',
            'preco_sugerido.required' => 'O campo preço é obrigatório',
            'preco_sugerido.gt' => 'O campo :preço sugerido deve ser maior que 0',
            'fornecedor_id.required' => 'O campo fornecedor é obrigatório',
            'estoque.gt' => 'O campo :attribute deve ser maior que 0',
            'estoque.integer' => 'O campo :attribute deve ser inteiro',
        ];

        $request->validate([
            'nome'=>'required|max:191',
            'estoque'=>'required|gt:0',
            'preco_sugerido' => 'required|gt:0',
            'fornecedor_id' =>'required',
            'tamanho_id'=>'required'
        ] , $mensagens);

            $produto->fill($request->all());
            $produto->save();
            session()->flash('success', 'Produto atualizado com sucesso!');

        return redirect()->route('produto.show', $produto->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Produto $produto)
    {
        $produto->delete();
        session()->flash('success', 'Produto deletado com sucesso!');

        return redirect()->route('produto.index');
    }


    public function restore($id)
    {  

        Produto::onlyTrashed()->where('id', $id)->restore();
        session()->flash('success', 'Produto ativado com sucesso!');

        return redirect()->route('produto.index');
    }
}
