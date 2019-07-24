@extends('layout.adm.app')

@section('conteudo')



    @if (session()->has('success'))
     
    <div class="alert alert-success">
            {{ session('success') }}
    </div>
    @elseif (session()->has('error'))
    <div class="alert alert-danger">
            {{ session('error') }}
    </div>

    @endif

    <div class="card-header">
		<div class="card-title">
			<h1>Dados da Competição</h1>
		</div>
	</div>

	<div class="card-body">
		<table class="table table-condensed table-hover table-striped table-responsive-sm table-responsive-md">
			<thead>
				<th> Atributos</th>
				<th> Valores </th>

			</thead>
			<tbody>
				<tr>
					<td>ID</td>
					<td>{{ $competicao->id }}</td>

				</tr>

				<tr>
					<td>Nome</td>
					<td>{{ $competicao->nome }}</td>

				</tr>

				<tr>
					<td>Local</td>
					<td>{{ $competicao->local }}</td>

				</tr>

				<tr>
					<td>Data Início</td>
					<td>{{ date( 'd/m/Y' , strtotime($competicao->data_inicio))}}</td>
	                   

				</tr>

				<tr>
					<td>Data Término</td>
					<td>{{ date( 'd/m/Y' , strtotime($competicao->data_termino))}}</td>

				</tr>

			</tbody>

		</table>
	</div>
	
	<div class="card-footer">

		<a class="btn btn-primary btn-sm" href="{{ route('competicao.index') }}">Voltar</a>
		<a class="btn btn-success btn-sm" href="{{ route('competicao.edit',$competicao->id) }}">Editar</a>
		<a class="btn btn-secondary btn-sm" href="{{route('atletaCompeticao.index',$competicao->id) }}">Atletas da Competição</a>

		<form method="post" onsubmit="return confirm('Confirma exclusão do Associado?');" action="{{ route('competicao.destroy', $competicao) }}">

	  		@csrf
	  		@method('DELETE')
	  		<br>
	  		<input class="btn btn-danger btn-sm" type="submit" value="Excluir">
		</form>
	</div>

@endsection('conteudo')