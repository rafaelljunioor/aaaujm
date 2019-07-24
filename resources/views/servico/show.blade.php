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
			<h1>Dados do Servico</h1>
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
					<td>{{ $servico->id }}</td>

				</tr>

				<tr>
					<td>Nome</td>
					<td>{{ $servico->nome }}</td>

				</tr>

				<tr>
					<td>Valor Sugerido</td>
					<td>R$ {{$servico->preco_sugerido}}</td>
	                   

				</tr>

				<tr>
					<td>Descrição</td>
					 <td>{{$servico->descricao}}</td>

				</tr>

			</tbody>

		</table>

	</div>
	<div class="card-footer">

		<a class="btn btn-primary btn-sm" href="{{ route('servico.index') }}">Voltar</a>
		<a class="btn btn-success btn-sm" href="{{ route('servico.edit', $servico) }}">Editar</a>
		<a class="btn btn-secondary btn-sm" href="{{ route('servico.restore', $servico->id) }}">Ativar</a>

		<form method="post" onsubmit="return confirm('Confirma exclusão do Serviço?');" action="{{ route('servico.destroy', $servico) }}">

	  		@csrf
	  		@method('DELETE')
	  		<br>
	  		<input class="btn btn-danger btn-sm" type="submit" value="Excluir">

		</form>
	</div>

@endsection('conteudo')