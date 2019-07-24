@extends('layout.adm.app')


@section('conteudo')



	<div class="card-header">
		<div class="card-title">
			<h1>Atletas da Modalidade:  {{$modalidadeDados->nome}}</h1>
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
			@foreach($modalidade as $m)
				@if(isset($m->atletas))
					@foreach($m->atletas as $a)

					<tr>
						<td>{{$a->id}}</td>
						<td>{{$a->pessoa->nome}}</td>
						<td>{{$a->pessoa->matricula}}</td>
						<td>{{$a->tamanho_uniforme}}</td>
						<td>{{$a->altura}}</td>
						<td>{{$a->peso}}</td>
						<td>{{$a->descricao}}</td>
						<td >
							<form method="post" onsubmit="return confirm('Confirma exclusão do Atleta?');" action="{{ route('atletaModalidade.destroy', [$m->id, $a->id]) }}">
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
		
		<a class="btn btn-secondary btn-sm" href="{{route('modalidade.index') }}">Cancelar</a>
		<a class="btn btn-success btn-sm" href="{{route('atletaModalidade.create', $modalidadeDados->id)}}">Alocar Atleta</a>
		<a class="btn btn-danger btn-sm" href="{{route('relatorioAtletasEmModalidade', $modalidadeDados->id)}}">PDF</a>
	</div>


   
@endsection('conteudo')