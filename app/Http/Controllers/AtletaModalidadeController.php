<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Atleta;
use App\Modalidade;
use App\Atleta_Modalidade;
use Illuminate\Support\Facades\DB;

class AtletaModalidadeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   
    public function __construct()
    {
        // Nesse caso o middleware auth será aplicado a todos os métodos
        $this->middleware('auth');

        // mas, você pode fazer uso dos métodos fluentes: only e except
        // ex.: $this->middleware('auth')->only(['create', 'store']);
        // ex.: $this->middleware('auth')->except('index');
    }

    public function index($id)
    {   

        //$modalidade = Modalidade::with('atletas')->get()->toArray();
         if(Auth::check()){
            if(Auth::user()->type == 3 || Auth::user()->type == 1){
                $modalidade = Modalidade::where('id', '=', $id)->orderBy('id')->get();
                $modalidadeDados = Modalidade::find($id);
                return view('atletaModalidade.index')->with('modalidade', $modalidade)->with('modalidadeDados', $modalidadeDados);
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
    public function create($id)
    {
        if(Auth::check()){
            if(Auth::user()->type == 3 || Auth::user()->type == 1){
            $modalidade = Modalidade::find($id);
            $todosAtletas = Atleta::all();
            
            $atleta = DB::select('Select a.id, p.nome from atletas as a 
            JOIN pessoas as p on p.id = a.pessoa_id
            WHERE NOT EXISTS (
            SELECT 1 FROM atleta_modalidades as am 
               where am.modalidade_id = '.$id.' and am.atleta_id = a.id) order by p.nome ASC'
            );

            return view('atletaModalidade.create')->with('atleta', $atleta)->with('modalidade', $modalidade)->with('todosAtletas', $todosAtletas);
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
    	 $mensagens = ['atleta_id.required' => 'Selecionar um atleta é obrigatório',];

		 $request->validate(['atleta_id'=>'required'], $mensagens);

        DB::table('atleta_modalidades')
        ->insert(
        ['modalidade_id'=>$request->modalidade_id,
        'atleta_id' => $request->atleta_id]
        /*'descricao'=> $request->descricao]*/);
        return redirect()->route('atletaModalidade.index',$request->modalidade_id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //$atleta = Atleta::find($id);
        //$modalidade = Modalidade::find($id2);
       // return view('atletaModalidade.show')->with('atleta', $atleta)->with('modalidade', $modalidade);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($modalidade_id , $atleta_id )
    {

        DB::table('atleta_modalidades')
        ->where('atleta_id', $atleta_id)
        ->where('modalidade_id', $modalidade_id)
        ->delete();
        return redirect()->route('atletaModalidade.index',$modalidade_id);
        
    }

}
