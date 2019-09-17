<?php

Use App\Pessoa;
Use App\Atleta;
Use App\Competicao;
Use App\Associado;
Use App\Atleta_Competicao;
Use App\Atleta_Modalidade;


/**
ROTAS ASSOCIADO
*/
Route::resource('associado','AssociadoController');
Route::get('associado/restore/{id}', 'AssociadoController@restore')->name('associado.restore');
Route::get('associados/debito', 'AssociadoController@buscaAssociadosDebito')->name('associado.index2');
Route::get('relatorio-associados', 'RelatorioController@gerarRelatorioAssociados')->name('relatorioAssociados');
Route::get('relatorio-associados-em-debito', 'RelatorioController@gerarRelatorioAssociadosEmDebito')->name('relatorioAssociadosEmDebito');
Route::get('buscaAssociados', 'AssociadoController@buscaAssociados')->name('buscaAssociados');

/**
ROTAS COMPETICAO
*/
Route::resource('competicao','CompeticaoController');

/**
ROTAS ATLETA
*/
Route::resource('atleta', 'AtletaController');
Route::get('relatorio-atletas', 'RelatorioController@gerarRelatorioAtletas')->name('relatorioAtletas');
Route::get('relatorio-atleta-em-modalidade/{id}', 'RelatorioController@gerarRelatorioAtletasEmModalidade')->name('relatorioAtletasEmModalidade');

Route::get('relatorio-atleta-em-competicao/{id}', 'RelatorioController@gerarRelatorioAtletasEmCompeticao')->name('relatorioAtletasEmCompeticao');

Route::get('buscaAtletas', 'AtletaController@buscaAtletas')->name('buscaAtletas');

/**
ROTAS MODALIDADE
*/
Route::resource('modalidade', 'ModalidadeController');

/**
ROTAS FORNECEDOR
*/
Route::resource('fornecedor','FornecedorController');
Route::get('fornecedor/restore/{id}', 'FornecedorController@restore')->name('fornecedor.restore');

/**
ROTAS VENDA
*/
Route::resource('venda','VendaController');
Route::get('buscaVendas', 'VendaController@buscaVendas')->name('buscaVendas');

/**
ROTAS PRODUTO
*/
Route::resource('produto', 'ProdutoController');
Route::get('produto/restore/{id}', 'ProdutoController@restore')->name('produto.restore');

/**
ROTAS SERVICO
*/
Route::resource('servico','ServicoController');
Route::get('servico/restore/{id}', 'ServicoController@restore')->name('servico.restore');

/**
ROTAS USER
*/
Route::resource('user','UserController');
Route::get('user/restore/{id}', 'UserController@restore')->name('user.restore');
Route::delete('user/excluir/{id}', 'UserController@forceDelete')->name('user.forceDelete');


/**
ROTA PARA CONTROLE DE ATLETAS EM MODALIDADES
*/
Route::get('atletaModalidade/{id}', 'AtletaModalidadeController@index')->name('atletaModalidade.index');
Route::get('atletaModalidade/create/{id}', 'AtletaModalidadeController@create')->name('atletaModalidade.create');
Route::post('atletaModalidade', 'AtletaModalidadeController@store')->name('atletaModalidade.store');
Route::delete('atletaModalidade/{modalidade_id}/atleta/{atleta_id}', 'AtletaModalidadeController@destroy')->name('atletaModalidade.destroy');

/**
ROTA PARA CONTROLE DE ATLETAS EM COMPETICOES
*/
Route::get('atletaCompeticao/{id}', 'AtletaCompeticaoController@index')->name('atletaCompeticao.index');
Route::get('atletaCompeticao/create/{id}', 'AtletaCompeticaoController@create')->name('atletaCompeticao.create');
Route::post('atletaCompeticao', 'AtletaCompeticaoController@store')->name('atletaCompeticao.store');
Route::delete('atletaCompeticao/{competicao_id}/atleta/{atleta_id}', 'AtletaCompeticaoController@destroy')->name('atletaCompeticao.destroy');

/**
ROTA PARA BUSCA DE DADOS POR MATRICULA 
*/
Route::get('/dadosatletapormatricula/{mat}', 'AtletaController@indexJson');
Route::get('/dadosassociadopormatricula/{mat}', 'AssociadoController@indexJson');
//Route::get('/quantidadeAssociados', 'AssociadoController@quantidadeJson');
//Route::get('/quantidadeAtletas', 'AtletaController@quantidadeJson');
//Route::get('/quantidadeProdutos', 'ProdutoController@quantidadeJson');


/**
ROTA PARA A PAGINA DASHBOARD
*/
Route::get('/dashboard', 'HomeController@dashboardJson');


/**
ROTA AUTH
*/

Route::post('login', 'Auth\LoginController@login')->name('login');
Auth::routes();

/**
ROTA AUTH
*/

Route::get('/', function () {

	if (Auth::check()) {
		return view('/home2');
	}else{
		return view('auth.login');
	}
    
});

Route::get('/home', 'HomeController@index')->name('home');
