<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Servico;
class ServicoController extends Controller
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
                $servico = Servico::withTrashed()->paginate(10);
                return view('servico.index')->with('servico', $servico);
            }else{
                return redirect()->back();
                }
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
            if(Auth::user()->type == 2 || Auth::user()->type == 1){
                return view('servico.create');
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

        $mensagens = [
            'nome.required' => 'O campo :attribute é obrigatório',
            'nome.max' => 'O campo :attribute deve possuir 191 caracteres',
            'preco_sugerido.required' => 'O campo :attribute é obrigatório',
            'preco_sugerido.gt' => 'O campo :attribute deve ser maior que 0',
        ];

        $request->validate([
            'nome'=>'required|max:191',
            'preco_sugerido' => 'required|gt:0',
        ] , $mensagens);

        Servico::create($request->all());
        $request->session()->flash('success', 'Servico inserido com Sucesso!');
        return redirect()->route('servico.index');
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
                $servico = Servico::withTrashed()->find($id);
                return view('servico.show')->with('servico', $servico);
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
                $servico = Servico::withTrashed()->find($id);
                return view('servico.edit')->with('servico', $servico);
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
    public function update(Request $request, Servico $servico)
    {

        $mensagens = [
            'nome.required' => 'O campo :attribute é obrigatório',
            'nome.max' => 'O campo :attribute deve possuir 191 caracteres',
            'preco_sugerido.required' => 'O campo :attribute é obrigatório',
            'preco_sugerido.gt' => 'O campo :attribute deve ser maior que 0',
        ];

        $request->validate([
            'nome'=>'required|max:191',
            'preco_sugerido' => 'required|gt:0',
        ] , $mensagens);

        $servico->fill($request->all());
        $servico->save();
        return redirect()->route('servico.show', $servico->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Servico $servico)
    {
        $servico->delete();
        return redirect()->route('servico.index');
    }

    public function restore($id)
    {
        Servico::onlyTrashed()->where('id', $id)->restore();
        session()->flash('success', 'Produto ativado com sucesso!');
        return redirect()->route('servico.index');
    }


}
