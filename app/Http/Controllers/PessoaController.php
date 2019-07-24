<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Pessoa;
use App\Atleta;
use App\Associado;
use Illuminate\Support\Facades\DB;
class PessoaController extends Controller
{

    
    public function __construct()
    {
        // Nesse caso o middleware auth será aplicado a todos os métodos
        $this->middleware('auth');

    }

    /**
    @param $mat recebe matricula e busca dados ja cadastrados na table pessoas.
    */
    public function indexJson($mat){
    	$pessoas = DB::table('pessoas')->where('matricula',$mat)->get();
    	
        
    	return json_encode($pessoas);

    	/*$atletas = DB::table('atletas') 
        ->join('pessoas', 'pessoas.id', '=', 'atletas.pessoa_id')->orderBy('nome')->get();
        $atletas->toArray();*/
    }

}
