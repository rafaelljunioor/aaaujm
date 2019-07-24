@extends('layout.adm.app')

@section('conteudo')

	<div class="card-header">
		<div class="card-title">
			<h1>Editar Competição: Identificação {{$competicao->id}}</h1>
		</div>
	</div>

<div class="card-body">
	<form method="post" action="{{route('competicao.update', $competicao)}}">
		
		@csrf
		@method('PATCH')

			<div class="form-group">
				<p >Nome:  </p>
				<input type="text" 
					   class="form-control {{$errors->has('nome') ? 'is-invalid' : ''}}" 
					   placeholder="Insira o nome da competicao" 
					   value="{{$competicao->nome}}" 
					   name="nome">

					@if($errors->has('nome'))
	  					<div class="invalid-feedback">
	  						{{$errors->first('nome')}}
	  					</div>
	  				@endif
			</div>

			<div class="form-group">
				<p >local: </p>
				<input type="text" 
					   class="form-control {{$errors->has('local') ? 'is-invalid' : ''}}" 
					   placeholder="Insira o nome da cidade" 
					   value="{{$competicao->local}}" 
					   name="local">

				    @if($errors->has('local'))
	  					<div class="invalid-feedback">
	  						{{$errors->first('local')}}
	  					</div>
	  				@endif
			</div>

			<div class="form-group">
				<p >Data Inicio </p>
				<input type="date" 
					   class="form-control {{$errors->has('data_inicio') ? 'is-invalid' : ''}}" 
					   placeholder="18/09/2018" 
					   value="{{$competicao->data_inicio}}" 
					   name="data_inicio">

					@if($errors->has('data_inicio'))
	  					<div class="invalid-feedback">
	  						{{$errors->first('data_inicio')}}
	  					</div>
	  				@endif
			</div>

			<div class="form-group">
				<p >Data Término </p>
				<input type="date" 
					   value="{{$competicao->data_termino}}" 
					   class="form-control {{$errors->has('data_termino') ? 'is-invalid' : ''}}" 
					   name="data_termino"></p>

					   @if($errors->has('data_termino'))
	  					<div class="invalid-feedback">
	  						{{$errors->first('data_termino')}}
	  					</div>
	  				@endif
			</div>

		<button type="submit" class="btn btn-primary btn-sm">Editar</button>
		<a href="{{route('competicao.show', $competicao->id)}}route" class="btn btn-danger btn-sm">Cancelar</a>

	</form>
</div>

@endsection('conteudo')