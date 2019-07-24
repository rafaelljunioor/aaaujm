@extends('layout.adm.app')

@section('conteudo')


	<div class="card-header">
		<div class="card-title">
			<h1>Alocar atleta em {{$modalidade->nome}}</h1>
		</div>
	</div>

	<div class="card-body">
		<form method="post" action="{{route('atletaModalidade.store')}}">

			@csrf

			<div class="form-group">
			    <label for="cursos">Atleta</label>
			    <select class="form-control" id="cursos" name="atleta_id">
			    
	        	
			        	@foreach($atleta as $a)

			        		@foreach($todosAtletas as $todos)
			        			@if($todos->id == $a->id)
				        		<option value="{{ $a->id }}"> {{ $todos->pessoa->nome }}
				        		</option>
				        		@endif
			        		@endforeach
			        	@endforeach
			    </select>
			 </div>

			  <!--<div class="form-group" ">
			  	
			    <label for="inputtelefone">Descricao</label>
			    <textarea class="form-control" id="inputnome" placeholder="Insira a descricao do atleta na modalidade" name="descricao"></textarea> 
			  </div>-->

			  <input type="hidden" name="modalidade_id" value="{{ $modalidade->id}}">


			 
			
			<button class="btn btn-primary btn-sm" type="submit" href="">Salvar</button>
			<a class="btn btn-danger btn-sm" href="{{route('atletaModalidade.index',$modalidade->id)}}">Cancelar</a>
		</form>
	</div>

	

@endsection('conteudo')