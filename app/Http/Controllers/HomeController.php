<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Atleta;
use App\Produto;
use App\Associado;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home2');
    }

    public function dashboardJson(){
        $atletas = Atleta::count();
        $associados = Associado::count();
        $associadosDesativados = Associado::onlyTrashed()->count();
        $produtos = Produto::count();

        return json_encode(array('atletas' => $atletas, 'associados' => $associados, 'produtos' => $produtos, 'associadosDesativados' => $associadosDesativados));
    }
}
