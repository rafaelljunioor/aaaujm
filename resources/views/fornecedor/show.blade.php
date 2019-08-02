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
			<h1>Dados do Fornecedor</h1>
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
					<td>{{ $fornecedor->id }}</td>

				</tr>

				<tr>
					<td>Nome</td>
					<td>{{ $fornecedor->nome }}</td>

				</tr>

				<tr>
					<td>CNPJ</td>
					<td>{{ $fornecedor->cnpj }}</td>

				</tr>

				<tr>
					<td>Email</td>
					<td>{{$fornecedor->email}}</td>
	                   

				</tr>

				<tr>
					<td>Telefone</td>
					 <td>{{$fornecedor->telefone}}</td>

				</tr>

				<tr>
					<td>Descrição</td>
					 <td>{{$fornecedor->descricao}}</td>

				</tr>

			</tbody>

		</table>
	</div>

	<div class="card-footer">
		<a class="btn btn-primary btn-sm" href="{{ route('fornecedor.index') }}">Voltar</a>
		<a class="btn btn-success btn-sm" href="{{ route('fornecedor.edit', $fornecedor->id) }}">Editar</a>
		

		<form method="post" onsubmit="return confirm('Confirma exclusão do Fornecedor?');" action="{{ route('fornecedor.destroy', $fornecedor) }}">

	  		@csrf
	  		@method('DELETE')
	  		<br>
	  		<input class="btn btn-danger btn-sm" type="submit" value="Excluir">

		</form>
	</div>

@endsection('conteudo')