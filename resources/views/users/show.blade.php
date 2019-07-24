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
					<td>{{ $user->id }}</td>

				</tr>

				<tr>
					<td>Nome</td>
					<td>{{ $user->name }}</td>

				</tr>

				<tr>
					<td>Email</td>
					<td>{{$user->email}}</td>
	                   

				</tr>

				<tr>
					<td>Classificação Usuário</td>
					 <td>{{$user->role->nome}}</td>

				</tr>

			</tbody>

		</table>

	</div>
	<div class="card-footer">

		<a class="btn btn-primary btn-sm" href="{{ route('user.index') }}">Voltar</a>
		<a class="btn btn-success btn-sm" href="{{ route('user.edit', $user->id) }}">Editar</a>
		<a class="btn btn-success btn-sm" href="{{ route('password.reset') }}">Recuperar Senha</a>

		<form method="post" onsubmit="return confirm('Se você excluir o usuário ao invés de desativá-lo, todos os dados de venda e registros realizados pelo usuário serão perdidos. Confirma Exclusão do Usuário ?');" action="{{route('user.forceDelete', $user->id)}}">

	  		@csrf
	  		@method('DELETE')
	  		<br>
	  		<input class="btn btn-danger btn-sm" type="submit" value="Excluir">

		</form>
	</div>

@endsection('conteudo')