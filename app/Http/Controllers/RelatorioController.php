<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use PDF;
use App\Atleta;
use App\Associado;
use App\Modalidade;
use App\Competicao;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class RelatorioController extends Controller
{

    public function __construct()
    {
        // Nesse caso o middleware auth será aplicado a todos os métodos
        $this->middleware('auth');

    }
   
   public function gerarRelatorioAtletas(){
        if(Auth::user()->type == 2 || Auth::user()->type == 3){
            $atleta = Atleta::all();
            
            return PDF::loadView('relatorios.relatorioAtletas', array('atleta' => $atleta))->download('relatorio-atletas.pdf');
        }else{
            return redirect()->back();
        }
    }

    public function gerarRelatorioAssociados(){
        
            $associado = Associado::all();
            
            return PDF::loadView('relatorios.relatorioAssociados', array('associado' => $associado))->download('relatorio-associados.pdf');
        
    }

    public function gerarRelatorioAssociadosEmDebito(){
       
        $associado = Associado::whereDate('data_termino','<=',Carbon::now())->get();
        
        return PDF::loadView('relatorios.relatorioAssociados', array('associado' => $associado))->download('relatorio-associados.pdf');
    }


    public function gerarRelatorioAtletasEmModalidade($id){
       
       if(Auth::user()->type == 2 || Auth::user()->type == 3){
           $modalidade = Modalidade::where('id', '=', $id)->get();
           //$dados =  DB::table('modalidades')->where('id','=',$id)->get();
           $dados = Modalidade::find($id);
           
           
            return PDF::loadView('relatorios.relatorioAtletasEmModalidade',
            array('modalidade' => $modalidade, 'titulo'=>$dados->nome))->download('atleta-em-modalidade.pdf');
        }else{
            return redirect()->back();
        }
    }


    public function gerarRelatorioAtletasEmCompeticao($id){
       if(Auth::user()->type == 2 || Auth::user()->type == 3){
           $competicao = Competicao::where('id', '=', $id)->get();
            $dados = Competicao::find($id);

            return PDF::loadView('relatorios.relatorioAtletasEmCompeticao', array('competicao' => $competicao, 'titulo'=>$dados->nome))->download('atleta-em-competicao.pdf');
        }else{
            return redirect()->back();
        }
    }


}
