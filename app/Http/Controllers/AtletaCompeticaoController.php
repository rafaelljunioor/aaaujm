<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
Use App\Competicao;
Use App\Atleta;
use Illuminate\Support\Facades\DB;

class AtletaCompeticaoController extends Controller
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
    public function index($id)
    {
        if(Auth::check()){
            if(Auth::user()->type == 3 || Auth::user()->type == 1){
                $competicao = Competicao::where('id', '=', $id)->get();
                $competicaoDados = Competicao::find($id);
                return view('atletaCompeticao.index')->with('competicao', $competicao)->with('competicaoDados', $competicaoDados);
             }  else{
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
    public function create($id)
    {
         if(Auth::check()){
            if(Auth::user()->type == 3 || Auth::user()->type == 1){
                $competicao = Competicao::find($id);
                $todosAtletas = Atleta::all();

                $atleta = DB::select('Select a.id, p.nome from atletas as a 
                JOIN pessoas as p on p.id = a.pessoa_id
                WHERE NOT EXISTS (
                SELECT 1 FROM atleta_competicoes as ac 
                   where ac.competicao_id = '.$id.' and ac.atleta_id = a.id) order by p.nome ASC'
                );
                return view('atletaCompeticao.create')->with('atleta', $atleta)->with('todosAtletas', $todosAtletas)->with('competicao', $competicao);

            }else {
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
        $mensagens = ['atleta_id.required' => 'Selecionar um atleta é obrigatório',];

        $request->validate(['atleta_id'=>'required'], $mensagens);

        DB::table('atleta_competicoes')
                ->insert(['competicao_id'=>$request->competicao_id,
                          'atleta_id' => $request->atleta_id]);
        
        return redirect()->route('atletaCompeticao.index',$request->competicao_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($competicao_id, $atleta_id)
    {
        DB::table('atleta_competicoes')
        ->where('atleta_id', $atleta_id)
        ->where('competicao_id', $competicao_id)
        ->delete();
        return redirect()->route('atletaCompeticao.index',$competicao_id);
    }
}
