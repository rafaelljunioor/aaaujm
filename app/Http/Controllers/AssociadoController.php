<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Pessoa;
use App\Associado;
use App\Curso;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;



class AssociadoController extends Controller
{

    public function __construct()
    {
        // Nesse caso o middleware auth será aplicado a todos os métodos
        $this->middleware('auth');

        // mas, você pode fazer uso dos métodos fluentes: only e except
        // ex.: $this->middleware('auth')->only(['create', 'store']);
        // ex.: $this->middleware('auth')->except('index');
    }

	public function indexJson($mat){

        $pessoas = DB::table('pessoas')->where('matricula',$mat)->get();
        return json_encode($pessoas);
    }

    public function quantidadeJson(){

        $number = Associado::count();
        return json_encode($number);
    }

    public function buscaAssociados(Request $request){

       if(Auth::check()){
           $pessoa = Pessoa::where('nome','like','%'.$request->nome.'%')->orderBy('nome')->get();
           return view('associado.resultadoBusca')->with('pessoa', $pessoa)->with('nome', $request->nome);
        }else{
            return redirect()->route('login');
        }
   }

   public function index(){  

        if(Auth::check()){
            $associado = Associado::withTrashed()->paginate(10);

            return view('associado.index')->with('associado', $associado)->with('now', Carbon::now());
        }else{
            return redirect()->route('login');
        }    
    }



    public function buscaAssociadosDebito(){  
        if(Auth::check()){
            $associado = Associado::withTrashed()->whereDate('data_termino','<=',Carbon::now())->paginate(15);

            return view('associado.indexDebito')->with('associado', $associado);
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
        	$pessoas = Pessoa::all();
            $cursos = Curso::all();
            return view('associado.create')->with('pessoas', $pessoas)->with('cursos', $cursos);

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


        $mensagens = ['matricula.required' => 'O campo :attribute é obrigatório',
        'nome.required' => 'O campo :attribute é obrigatório',
        'email.required' => 'O campo :attribute é obrigatório',
        'curso.required' => 'O campo :attribute é obrigatório',
        'email.unique' => 'Esse :attribute já foi cadastrado',
    ];




    $pessoa = DB::table('pessoas')
    ->where('matricula', $request->matricula)
    ->get(); 
    if($pessoa->count() == 0)
    {   
                //Adiciona pessoa

        $request->validate([
            'matricula'=>'required',
            'nome'=>'required',
            'email'=>'required|email',
            'curso'=>'required',
        ], $mensagens);

        $pessoa = new Pessoa();
        $pessoa->matricula = $request->matricula;
        $pessoa->nome = $request->nome;
        $pessoa->email = $request->email;
        $pessoa->curso_id = $request->curso;
        $pessoa->telefone = $request->telefone;

        $pessoa->save();

               /*DB::table('pessoas')->insert(
               ['matricula' => $request->matricula,'curso_id' => $request->curso, 'nome' => $request->nome , 'email' => $request->email, 'telefone' => $request->telefone]);*/
                //Adiciona o Associado

                $pessoa = DB::table('pessoas')->where('matricula', $request->matricula)->first();//

                $associado = new Associado();
                $associado->pessoa_id = $pessoa->id;
                $associado->data_termino= $request->data_termino;
                $associado->data_inicio= $request->data_inicio;

                $associado->save();

                //DB::table('associados')->insert(['pessoa_id' => $pessoa->id]);
                
                $request->session()->flash('success', 'Associado Inserido com Sucesso!');
                return redirect()->route('associado.index');

            }else
            {

                $pessoa = DB::table('pessoas')
                ->where('matricula', $request->matricula)
                ->first();
                $associado = DB::table('associados')
                ->where('pessoa_id', $pessoa->id)
                ->first();

                // Se já existir o registro de um atleta mas o mesmo não é associado, apenas cadastrá-lo como associado.
                if(!isset($associado))
                {
                    $request->validate([
                        'matricula'=>'required',
                        'nome'=>'required',
                        'email'=>'required|email',
                        'curso'=>'required',
                    ], $mensagens);

                   // DB::table('associados')->insert(['pessoa_id' => $pessoa->id] );

                    $associado = new Associado();
                    $associado->pessoa_id = $pessoa->id;
                    $associado->data_termino= $request->data_termino;
                    $associado->data_inicio= $request->data_inicio;
                    $associado->save();

                    $request->session()->flash('success', 'Registro encontrado em nossa base de dados. Associado Inserido!');

                    return redirect()->route('associado.index');

                }else
                {

                    $request->session()->flash('error', 'A matricula informada já consta em nossa base de dados! ');

                    return redirect()->route('associado.index');
                }

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
            $associado = Associado::withTrashed()->find($id);
            return view('associado.show')->with('associado', $associado);
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
        if(Auth::check()){
            $associado = Associado::find($id);
            $curso = Curso::all();
            return view('associado.edit')->with('associado', $associado)->with('curso',$curso);
        }else{
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
    public function update(Request $request, $id)
    {

        $mensagens = ['matricula.required' => 'O campo :attribute é obrigatório',
        'matricula.unique' => 'A matricula informada já está cadastrada',
        'nome.required' => 'O campo :attribute é obrigatório',
        'email.required' => 'O campo :attribute é obrigatório',
        'curso.required' => 'O campo :attribute é obrigatório',
        'email.unique' => 'Esse :attribute já foi cadastrado',
    ];



    $associado = Associado::find($id);


    if($associado->count()>0)
    {   
        if($associado->pessoa->email != $request->email){
            $request->validate(['email'=>'required|email|unique:pessoas'], $mensagens);
        }

        if($associado->pessoa->matricula != $request->matricula){
            $request->validate(['matricula'=>'required|unique:pessoas'], $mensagens);
        }


            $pessoa = Pessoa::find($associado->pessoa_id);
            $pessoa->matricula = $request->matricula;
            $pessoa->nome = $request->nome;
            $pessoa->email = $request->email;
            $pessoa->curso_id = $request->curso;
            $pessoa->telefone = $request->telefone;

            $pessoa->update();

            $associado->data_inicio = $request->data_inicio;
            $associado->data_termino = $request->data_termino;

            $associado->save();

            $request->session()->flash('success', 'Os dados foram atualizados!');
            

        }else
        {
           $request->session()->flash('error', 'Problema ao atualizar os dados!');
           return redirect()->back(); 
       }


       $associado = Associado::find($id);


       return view('associado.show')->with('associado', $associado); 
      
   }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {


        $associado = Associado::find($id);
        $associado->delete();
        return redirect()->route('associado.index')->with('success', 'Exclusão realizada com sucesso!');
        
        /*$atleta = DB::table('atletas')->where('pessoa_id', $associado->pessoa_id)->get();


        if($atleta->count() == 0){ // se nao for atleta excluir tb a pessoa
            //$associado->pessoa()->forceDelete();
            $associado->forceDelete();

            return redirect()->route('associado.index')->with('success', 'Exclusão realizada com sucesso!');
        }else if($atleta->count() > 0){

            $associado->forceDelete();
            return redirect()->route('associado.index')->with('success', 'Exclusão realizada com sucesso!');
        }else{

            return redirect()->route('associado.index')->with('error', 'Problema Durante a Exclusão do Atleta');
        }*/

    }

    public function restore($id)
    {  

        Associado::onlyTrashed()->where('id', $id)->restore();
        session()->flash('success', 'Produto ativado com sucesso!');

        return redirect()->route('associado.index');
    }
}
