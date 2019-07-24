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
			<h1 class="card-title">Dados da modalidade</h1>
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
					<td>{{ $modalidade->id }}</td>

				</tr>

				<tr>
					<td>Nome</td>
					<td>{{ $modalidade->nome }}</td>

				</tr>

				<tr>
					<td>Genero</td>
					<td>{{ $modalidade->genero }}</td>

				</tr>
			</tbody>

		</table>
	</div>
	<div class="card-footer">
		<a class="btn btn-primary btn-sm" href="{{ route('modalidade.index') }}">Voltar</a>
		<a class="btn btn-success btn-sm" href="{{ route('modalidade.edit', $modalidade->id) }}">Editar</a>
		<a class="btn btn-secondary btn-sm" href="{{route('atletaModalidade.index', $modalidade->id) }}">Atletas na Modalidade</a>

		<form method="post" onsubmit="return confirm('Confirma exclusão da Modalidade?');" action="{{ route('modalidade.destroy', $modalidade) }}">

	  		@csrf
	  		@method('DELETE')
	  		<br>
	  		<input class="btn btn-danger btn-sm" type="submit" value="Excluir">

		</form>
	
	</div>


@endsection('conteudo')