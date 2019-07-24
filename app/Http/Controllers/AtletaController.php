<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Atleta;
use App\Pessoa;
use App\Curso;
use App\Tamanho;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class AtletaController extends Controller
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
         return $pessoas->toJson();

         Log::info($pessoas);

         return $pessoas->toJson();
    }

    public function quantidadeJson(){

        $number = Atleta::count();
        return json_encode($number);
    }

   /**
    
   */
   public function buscaAtletas(Request $request){
        
        if(Auth::check()){
            if(Auth::user()->type == 3 || Auth::user()->type == 1){
               $pessoa = Pessoa::where('nome','like','%'.$request->nome.'%')->orderBy('nome')->get();
               return view('atleta.resultadoBusca')->with('pessoa', $pessoa)->with('nome', $request->nome);
            }else {
                return redirect()->route('login');
            }
            
        }else {
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


       /* $atletas = DB::table('atletas') 
        ->join('pessoas', 'pessoas.id', '=', 'atletas.pessoa_id')->orderBy('nome')->get();
        $atletas->toArray();

        return view('atleta.index', compact('atletas'));*/
        if(Auth::check()){

            if(Auth::user()->type == 3 || Auth::user()->type == 1){
                $atleta = Atleta::paginate(10);

                return view('atleta.index')->with('atleta', $atleta);
            }else {
                return redirect()->route('login');
                //return response('Unauthorized.', 401);
            }
            
        }else {
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
                 $cursos = Curso::all();
                 $tamanhos = Tamanho::all();
                 return view('atleta.create')->with('cursos', $cursos)->with('tamanhos', $tamanhos);
             }
             else{
             return redirect()->route('login');
             }
        }else {
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
        $mensagens = ['matricula.required' => 'O campo matricula é obrigatório',
        'nome.required' => 'O campo nome é obrigatório',
        'email.required' => 'O campo email é obrigatório',
        'curso.required' => 'O campo curso é obrigatório',
        'tamanho_uniforme.required' => 'O campo tamanho de uniforme é obrigatório',
        'altura.required' => 'O campo altura é obrigatório',
        'peso.required' => 'O campo peso é obrigatório',
        'email.unique' => 'Esse :attribute ja foi cadastrado',
    ];


        //Verifica se já existe essa pessoa, caso contrário será cadastrada.
    $pessoa = DB::table('pessoas')
    ->where('matricula', $request->matricula)
    ->get(); 

    if($pessoa->count() == 0)
    {   

        $request->validate([
            'matricula'=>'required',
            'nome'=>'required',
            'email'=>'required|email|unique:pessoas',
            'curso'=>'required',
            'tamanho_uniforme'=>'required',
            'altura'=>'required',
            'peso'=>'required',
            'descricao' => 'max:191'

        ], $mensagens);

                //Adiciona pessoa

        $pessoa = new Pessoa();
        $pessoa->matricula = $request->matricula;
        $pessoa->curso_id = $request->curso;
        $pessoa->nome = $request->nome;
        $pessoa->email = $request->email;
        $pessoa->telefone = $request->telefone;

        $pessoa->save();

                /*DB::table('pessoas')
                ->insert(['matricula' => $request->matricula,'curso_id' => $request->curso, 'nome' => $request->nome , 'email' => $request->email, 'telefone' => $request->telefone]);*/
                //Adiciona o Atleta

                $pessoa = DB::table('pessoas')
                ->where('matricula', $request->matricula)
                ->first();

                $atleta = new Atleta();
                $atleta->pessoa_id = $pessoa->id;
                $atleta->tamanho_id = $request->tamanho_uniforme;
                $atleta->descricao = $request->descricao;
                $atleta->peso = $request->peso;
                $atleta->altura = $request->altura;

                $atleta->save();


                /*DB::table('atletas')
                ->insert(['pessoa_id' => $pessoa->id, 'tamanho_id'=>$request->tamanho_uniforme, 'descricao'=>$request->descricao , 'peso'=>$request->peso, 'altura'=>$request->altura] );*/
                
                

                $request->session()->flash('success', 'Atleta Inserido com Sucesso!');
                return redirect()->route('atleta.index');

            }else
            {

                $pessoa = DB::table('pessoas')
                ->where('matricula', $request->matricula)
                ->first();
                $atleta = DB::table('atletas')
                ->where('pessoa_id', $pessoa->id)
                ->first();

                // Se já existir o registro de um associado mas o mesmo não é atleta, apenas cadastrá-lo como atleta.
                if(!isset($atleta))
                {

                    $request->validate([
                        'matricula'=>'required',
                        'nome'=>'required',
                        'email'=>'required|email',
                        'curso'=>'required',
                        'tamanho_uniforme'=>'required',
                        'altura'=>'required',
                        'peso'=>'required',
                        'descricao' => 'max:191'

                    ], $mensagens);

                    $atleta = new Atleta();
                    $atleta->pessoa_id = $pessoa->id;
                    $atleta->tamanho_id = $request->tamanho_uniforme;
                    $atleta->descricao = $request->descricao;
                    $atleta->peso = $request->peso;
                    $atleta->altura = $request->altura;

                    $atleta->save();

                   /* DB::table('atletas')
                   ->insert(['pessoa_id' => $pessoa->id, 'tamanho_id'=>$request->tamanho_uniforme, 'descricao'=>$request->descricao , 'peso'=>$request->peso, 'altura'=>$request->altura] );*/

                   $request->session()->flash('success', 'Registro encontrado em nossa base de dados. Atleta Inserido!');

                   return redirect()->route('atleta.index');

               }else
               {

                $request->session()->flash('error', 'A matricula informada já se encontra em nossa base de dados!');

                return redirect()->route('atleta.index');
            }

        }

         //return redirect()->route('atleta.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $atleta = Atleta::find($id);
        
        if(Auth::check()){
            if(Auth::user()->type == 3 || Auth::user()->type == 1){
                return view('atleta.show')->with('atleta', $atleta);
            }else{
                return redirect()->route('login');
            }
           
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

            if(Auth::user()->type == 3 || Auth::user()->type == 1){
                $atleta = Atleta::find($id);
                $curso = Curso::all();
                $tamanho = Tamanho::all();
           
                 return view('atleta.edit')->with('atleta', $atleta)->with('curso',$curso)->with('tamanho',$tamanho);
            }else{
                return redirect()->route('login');
            }
        }else
        {
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
        'tamanho_uniforme.required' => 'O campo tamanho de uniforme é obrigatório',
        'altura.required' => 'O campo :attribute é obrigatório',
        'peso.required' => 'O campo :attribute é obrigatório',
        'descricao.max'=>'O campo :attribute deve ter no máximo 191 caracteres',
        'email.unique' => 'Esse :attribute ja foi cadastrado',
    ];

    $request->validate([
        'matricula'=>'required',
        'nome'=>'required',
        'email'=>'required|email',
        'curso'=>'required',
        'tamanho_uniforme'=>'required',
        'altura'=>'required',
        'peso'=>'required',
        'descricao' => 'max:191'

    ], $mensagens);

    $atleta = Atleta::find($id);

    if($atleta->count()>0)
        {// 

            if($atleta->pessoa->email != $request->email){
                $request->validate([

                    'email'=>'required|email|unique:pessoas',


                ], $mensagens);
            }

            if($atleta->pessoa->matricula != $request->matricula){
                $request->validate([

                    'matricula'=>'required|unique:pessoas',


                ], $mensagens);
            }


            $pessoa = Pessoa::find($atleta->pessoa_id);

            $pessoa->matricula = $request->matricula;
            $pessoa->curso_id = $request->curso;
            $pessoa->nome = $request->nome;
            $pessoa->email = $request->email;
            $pessoa->telefone = $request->telefone;
            $pessoa->update();


            $atleta = Atleta::find($atleta->id);
            $atleta->tamanho_id = $request->tamanho_uniforme;
            $atleta->descricao = $request->descricao;
            $atleta->peso = $request->peso;
            $atleta->altura = $request->altura;

            $atleta->update();

            $request->session()->flash('success', 'Os dados foram atualizados!');

        }else
        {

           $request->session()->flash('error', 'Problema ao atualizar os dados!');

       }
         // busca o atleta com dados atualizados
       $atleta = Atleta::find($id);

        return view('atleta.show')->with('atleta', $atleta);   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   

        /*Log::info('destroy=>atleta_id: '.$id);
        */

        $atleta = Atleta::find($id);

        $associado = DB::table('associados')->where('pessoa_id', $atleta->pessoa_id)->get();

        if($associado->count() == 0){

            $atleta->modalidades()->detach();
            $atleta->competicoes()->detach();
            $atleta->pessoa()->delete();
            $atleta->delete();
            
            return redirect()->route('atleta.index')->with('success', 'Exclusão realizada com sucesso!');
        }else if($associado->count() > 0){

            $atleta->modalidades()->detach();
            $atleta->competicoes()->detach();
            $atleta->delete();
            
            return redirect()->route('atleta.index')->with('success', 'Exclusão realizada com sucesso!');
        }else{


           return redirect()->route('atleta.index')->with('error', 'Erro Durante a exclusão!');
       }



   }
}
