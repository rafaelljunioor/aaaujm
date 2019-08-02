@extends('layout.adm.app')


@section('conteudo')



	<div class="card-header">
		<div class="card-title">
			<h1 class="card-title">Atletas na Competicao:  {{$competicaoDados->nome}}</h1>
		</div>
	</div>

	<div class="card-body">
		<table class="table table-condensed table-hover table-striped table-responsive-sm table-responsive-md">
			<thead>
				<tr> 
					 
					 <th>Id Atleta</th>
		             <th>Nome do Atleta</th>
		             <th>Matricula</th>
		             <th>Tamanho Uniforme</th>
		             <th>Altura</th>
		             <th>Peso</th>
		             <th>Descricao</th>
		             <th>Info</th>

		        </tr>

			</thead>

			<tbody>
			@foreach($competicao as $c)
				@if(isset($c->atletas))
					@foreach($c->atletas as $a)

					<tr>
						<td>{{$a->id}}</td>
						<td>{{$a->pessoa->nome}}</td>
						<td>{{$a->pessoa->matricula}}</td>
						<td>{{$a->tamanho->nome}}</td>
						<td>{{$a->altura}}</td>
						<td>{{$a->peso}}</td>
						<td>{{$a->descricao}}</td>
						<td >
							<form method="post" onsubmit="return confirm('Confirma exclusão do Atleta?');" action="{{ route('atletaCompeticao.destroy', [$c->id, $a->id]) }}">
						  		@csrf
						  		@method('DELETE')
						  		<button class="btn btn-danger btn-sm" type="submit">Excluir</button>
							</form>
						</td>

					</tr>
					@endforeach
				@endif	
			@endforeach
			</tbody>
		</table>
	</div>

	<div class="card-footer">

		<a class="btn btn-secondary btn-sm" href="{{route('competicao.index') }}">Cancelar</a>
		<a class="btn btn-success btn-sm" href="{{route('atletaCompeticao.create', $competicaoDados->id)}}">Alocar Atleta</a>
		<a class="btn btn-danger btn-sm" href="{{route('relatorioAtletasEmCompeticao', $competicaoDados->id)}}">PDF</a>

	</div>


   
@endsection('conteudo')