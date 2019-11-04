<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Fornecedor;

class FornecedorController extends Controller
{

    
    public function __construct()
    {
        // Nesse caso o middleware auth será aplicado a todos os métodos
        $this->middleware('auth');

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
                $fornecedores = Fornecedor::orderBy('nome')->withTrashed()->paginate(10);
                return view('fornecedor.index')->with('fornecedores', $fornecedores);
            }else{
                return redirect()->back();
            }
        }else{
            return redirect()->back();
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
            if(Auth::user()->type == 2 || Auth::user()->type == 1){
                return view('fornecedor.create');
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
         if(Auth::check()){
            if(Auth::user()->type == 2 || Auth::user()->type == 1){

                 $mensagens = ['nome.required' => 'O campo :attribute é obrigatório',
                'email.required' => 'O campo :attribute é obrigatório',
                'telefone.required' => 'O campo :attribute é obrigatório',
                'descricao.required' => 'O campo :attribute é obrigatório',
                'cnpj.required' => 'Esse :attribute já foi cadastrado',
                'cnpj.unique' => 'Esse :attribute já foi cadastrado',
                ];
                $request->validate([
                    'descricao'=>'required',
                    'nome'=>'required',
                    'email'=>'required|email',
                    'telefone'=>'required',
                    'cnpj'=>'required|unique:fornecedores',
                ], $mensagens);

                Fornecedor::create($request->all());
                $request->session()->flash('success', 'Fornecedor inserido com Sucesso!');
                 return redirect()->route('fornecedor.index');

            }else{
                return redirect()->back();
            }  
        }else{
            return redirect()->back();
            } 
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
                $fornecedor = Fornecedor::withTrashed()->find($id);
                return view('fornecedor.show')->with('fornecedor', $fornecedor);
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
                $fornecedor = Fornecedor::withTrashed()->find($id);
                return view('fornecedor.edit')->with('fornecedor', $fornecedor);
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
    public function update(Request $request, Fornecedor $fornecedor)
    { 

        if(Auth::check()){
            if(Auth::user()->type == 2 || Auth::user()->type == 1){

            $mensagens = ['nome.required' => 'O campo :attribute é obrigatório',
            'email.required' => 'O campo :attribute é obrigatório',
            'telefone.required' => 'O campo :attribute é obrigatório',
            'descricao.required' => 'O campo :attribute é obrigatório',
            'cnpj.required' => 'Esse :attribute já foi cadastrado',
            'cnpj.unique' => 'Esse :attribute já foi cadastrado',
            ];
            $request->validate([
                'descricao'=>'required',
                'nome'=>'required',
                'email'=>'required|email',
                'telefone'=>'required',
                'cnpj'=>'required|unique:fornecedores',
            ], $mensagens);

            $fornecedor->fill($request->all());
            $fornecedor->save();
            session()->flash('success', 'Fornecedor atualizado com sucesso!');
            return redirect()->route('fornecedor.show', $fornecedor->id);
            }else{
                return redirect()->back();
                }
       
        } else{
            return redirect()->back();
            } 
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Fornecedor $fornecedor)
    {
        if(Auth::check()){
            if(Auth::user()->type == 2 || Auth::user()->type == 1){
                $fornecedor->delete();
                session()->flash('success', 'Fornecedor deletado com sucesso!');
                return redirect()->route('fornecedor.index');
            }else{
                return redirect()->back();
                }
        }else{
            return redirect()->back();
            } 
    }

    public function restore($id)
    {  
        if(Auth::check()){
            if(Auth::user()->type == 2 || Auth::user()->type == 1){

                Fornecedor::onlyTrashed()->where('id', $id)->restore();
                session()->flash('success', 'Fornecedor ativado com sucesso!');
                return redirect()->route('fornecedor.index');

            }else{
                return redirect()->back();
                }
        }else{
            return redirect()->back();
        } 
    }
}
