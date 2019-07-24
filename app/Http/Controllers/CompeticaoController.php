<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Competicao;

class CompeticaoController extends Controller
{

    
    public function __construct()
    {
        // Nesse caso o middleware auth será aplicado a todos os métodos
        $this->middleware('auth');

        // mas, você pode fazer uso dos métodos fluentes: only e except
        // ex.: $this->middleware('auth')->only(['create', 'store']);
        // ex.: $this->middleware('auth')->except('index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::check()){
            if(Auth::user()->type == 3 || Auth::user()->type == 1){
                $competicao = Competicao::paginate(10);
                return view('competicao.index')->with('competicao', $competicao);
            }else{
                return redirect()->route('login');
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
            if(Auth::user()->type == 3 || Auth::user()->type == 1){
                return view('competicao.create');
            }else{
                return redirect()->route('login');
            }
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


        $mensagens = ['nome.required' => 'O campo :attribute é obrigatório',
                      'local.required' => 'O campo :attribute é obrigatório',
                      'data_inicio.required' => 'O campo data início é obrigatório',
                      'data_termino.required' => 'O campo data término é obrigatório',
                      
        ];

        $request->validate([
            'nome'=>'required',
            'local'=>'required',
            'data_inicio'=>'required',
            'data_termino'=>'required',

        ], $mensagens);

        Competicao::create($request->all());


        $request->session()->flash('success', 'Competicao inserida com Sucesso!');
                return redirect()->route('competicao.index');
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
            if(Auth::user()->type == 3 || Auth::user()->type == 1){
                $competicao = Competicao::find($id);
                return view('competicao.show')->with('competicao', $competicao);
            }else{
                return redirect()->route('login');
            }
         }else {
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

        if(Auth::check()){
            if(Auth::user()->type == 3 || Auth::user()->type == 1){
                $competicao = Competicao::find($id);
                return view('competicao.edit')->with('competicao', $competicao);
        }else{
                return redirect()->route('login');
            }
         }else {
            return redirect()->route('login');
         }  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Competicao $competicao)
    {

        /*$competicao = Competicao::find($id);
       
        DB::table('competicoes')
        ->where('id', $competicao->id)
        ->update(['nome'=>$request->nome, 'local'=>$request->local, 'data_inicio'=>$request->data_inicio, 'data_termino'=>$request->data_termino]);
       
         $competicao = Competicao::find($id);*/

         $mensagens = ['nome.required' => 'O campo :attribute é obrigatório',
                      'local.required' => 'O campo :attribute é obrigatório',
                      'data_inicio.required' => 'O campo data início é obrigatório',
                      'data_termino.required' => 'O campo data término é obrigatório',
                      
        ];

        $request->validate([
            'nome'=>'required',
            'local'=>'required',
            'data_inicio'=>'required',
            'data_termino'=>'required',

        ], $mensagens);

         $competicao->fill($request->all());
         $competicao->save();
         
       $request->session()->flash('success', 'Competicao editada com Sucesso!');
       return view('competicao.show')->with('competicao', $competicao); 
        //return redirect()->route('competicao.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Competicao $competicao)
    {

        //DB::table('atleta_competicoes')->where('competicao_id', $competicao->id)->delete();
        $competicao->atletas()->detach();
        $competicao->delete();
        return redirect()->route('competicao.index');
    }
}
