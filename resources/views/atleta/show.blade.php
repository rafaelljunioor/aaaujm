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
	@elseif(isset($error))
		<div class="alert alert-danger">
	            {{ $error }}
	    </div>
    @endif

     <div class="card-header">
        <div class="card-title">
			<h1>Dados do Atleta</h1>
		</div>
	</div>


	<div class="card-body">
		<table class="table table-condensed table-hover table-striped table-responsive-sm table-responsive">
			<thead>
				<th> Atributos</th>
				<th> Valores </th>

			</thead>
		
			<tbody>
				<tr>
					<td>ID</td>
					<td>{{ $atleta->id }}</td>

				</tr>

				<tr>
					<td>Nome</td>
					<td>{{ $atleta->pessoa->nome }}</td>

				</tr>

				<tr>
					<td>Matrícula</td>
					<td>{{ $atleta->pessoa->matricula }}</td>

				</tr>

				<tr>
					<td>Telefone</td>
					<td>{{ $atleta->pessoa->telefone }}</td>

				</tr>

				<tr>
					<td>Email</td>
					<td>{{ $atleta->pessoa->email }}</td>

				</tr>

				<tr>
					<td>Curso do Atleta</td>
					<td>{{ $atleta->pessoa->curso->nome }}</td>

				</tr>

				<tr>
					<td>Tamanho do Uniforme</td>
					<td>{{ $atleta->tamanho->nome}}</td>

				</tr>

				<tr>
					<td>Peso do Atleta</td>
					<td>{{ $atleta->peso}}</td>

				</tr>

				<tr>
					<td>Altura do Atleta</td>
					<td>{{ $atleta->altura}}</td>

				</tr>

				<tr>
					<td>Descrição do Atleta</td>
					<td>{{ $atleta->descricao }}</td>

				</tr>
			</tbody>

		</table>

		<br>
		
		<h5 class="text-title">Competições</h5>
		<table class="table table-condensed table-hover table-striped table-responsive-sm table-responsive-md">

			<thead>
				<th> Nome</th>
				<th> Data da Competição </th>

			</thead>
		
			<tbody>
				@foreach($atleta->competicoes as $c)
				<tr>
					
					<td>{{$c->nome}}</td>
					<td>{{ date( 'd/m/Y' , strtotime($c->data_inicio))}}</td>
				</tr>
				@endforeach
			</tbody>

		</table>

		<br>

		<h5 class="text-title">Modalidades</h5>
		<table class="table table-condensed table-hover table-striped table-responsive-sm table-responsive-md">

			<thead>
				<th> Nome</th>
				<th> Gênero </th>

			</thead>
		
			<tbody>
				@foreach($atleta->modalidades as $m)
				<tr>
					
					<td>{{$m->nome}}</td>
					<td>{{$m->genero}}</td>
				</tr>
				@endforeach
			</tbody>

		</table>

	</div>
	<div class="card-footer">
		<a class="btn btn-primary btn-sm" href="{{route('atleta.index')}}">Voltar</a>
		<a class="btn btn-success btn-sm" href="{{ route('atleta.edit', $atleta->id) }}">Editar</a>

		<form method="post" onsubmit="return confirm('Confirma exclusão do Atleta?');" action="{{ route('atleta.destroy', $atleta->id) }}">

	  		@csrf
	  		@method('DELETE')
	  		<br>
	  		<input class="btn btn-danger btn-sm" type="submit" value="Excluir">

		</form>
	</div>
	
@endsection('conteudo')