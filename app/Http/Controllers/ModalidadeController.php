<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Modalidade;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;

class ModalidadeController extends Controller
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

    public function indexAtletasModalidades($id)
    {
        if(Auth::check()){
            if(Auth::user()->type == 3 || Auth::user()->type == 1){
                $modalidade = Modalidade::where('id', '=', $id)->get();        
                $modalidadeDados = Modalidade::find($id);
                return view('atletaModalidade.index')->with('modalidade', $modalidade)->with('modalidadeDados', $modalidadeDados);

            }else{
                return redirect()->route('login');
            }
         }else {
            return redirect()->route('login');
         }  
    }

    public function index()
    {
        if(Auth::check()){
             if(Auth::user()->type == 3 || Auth::user()->type == 1){
                //$modalidade = Modalidade::orderBy('id')->get();
                $modalidade = Modalidade::paginate(10);
                return view('modalidade.index')->with('modalidade', $modalidade);
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
                   return view('modalidade.create');
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
            'genero.required' => 'O campo :attribute é obrigatório',


        ];

        $request->validate([
            'nome'=>'required',
            'genero'=>'required',

        ], $mensagens);

        Modalidade::create($request->all());

        $request->session()->flash('success', 'Modalidade inserida com Sucesso!');

        return redirect()->route('modalidade.index');
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
                $modalidade = Modalidade::findOrFail($id);
                return view('modalidade.show')->with('modalidade', $modalidade);
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
                $modalidade = Modalidade::find($id);
                return view('modalidade.edit')->with('modalidade', $modalidade);
            }else{
                return redirect()->route('login');
            }
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
        public function update(Request $request,Modalidade $modalidade)
        {
            $mensagens = ['nome.required' => 'O campo :attribute é obrigatório',
            'genero.required' => 'O campo :attribute é obrigatório',


        ];

        $request->validate([
            'nome'=>'required',
            'genero'=>'required',

        ], $mensagens);

        $modalidade->fill($request->all());
        $modalidade->save();

        $request->session()->flash('success', 'Modalidade editada com sucesso!');

        return view('modalidade.show')->with('modalidade', $modalidade);

    }

        /**
         * Remove the specified resource from storage.
         *
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function destroy(Modalidade $modalidade)
        {


            //exclusao das dependências
            //DB::table('atleta_modalidades')->where(['modalidade_id' => $modalidade->id])->delete();

            //$modalidade->atletas()->detach();
            $modalidade->delete();
            
            return redirect()->route('modalidade.index');
        }
    }
