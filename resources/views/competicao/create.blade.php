@extends('layout.adm.app')

@section('conteudo')

	<div class="card-header">
		<div class="card-title">
			<h1>Inserção de Competição</h1>
		</diV>
	</div>

	<div class="card-body">
		<form method="post" action="{{route('competicao.store')}}">

			@csrf
			
			<div class="form-group">
			    <label for="inputnome">Nome</label>
			    <input type="text" 
			    	   class="form-control {{$errors->has('nome') ? 'is-invalid' : ''}}" 
			    	   id="inputnome" 
			    	   placeholder="Insira o nome da competição" 
			    	   name="nome">

			    	@if($errors->has('nome'))
	  					<div class="invalid-feedback">
	  						{{$errors->first('nome')}}
	  					</div>
	  				@endif
			</div>

			  <div class="form-group">
			  	
			    <label for="inputlocal">Local</label>
			    <input type="text" 
			    	   class="form-control {{$errors->has('local') ? 'is-invalid' : ''}}" 
			    	   id="inputemail" 
			    	   placeholder="Insira o nome da cidade" 
			    	   name="local">

			    	@if($errors->has('local'))
	  					<div class="invalid-feedback">
	  						{{$errors->first('local')}}
	  					</div>
	  				@endif
			  </div>

			  <div class="form-group">
			  	
			    <label for="inputDataInicio">Data Inicio</label>
			    <input type="date" 
			    	   class="form-control {{$errors->has('data_inicio') ? 'is-invalid' : ''}}" 
			    	   id="inputDataInicio" 
			    	   placeholder="18/09/2018" 
			    	   name="data_inicio">

			    	@if($errors->has('data_inicio'))
	  					<div class="invalid-feedback">
	  						{{$errors->first('data_inicio')}}
	  					</div>
	  				@endif
			  </div>

			  <div class="form-group">
			  	
			    <label for="inputDataTermino">Data Término</label>
			    <input type="date" 
			    	   class="form-control {{$errors->has('data_termino') ? 'is-invalid' : ''}}" 
			    	   id="inputDataTermino" 
			    	   name="data_termino">

			    	@if($errors->has('data_termino'))
	  					<div class="invalid-feedback">
	  						{{$errors->first('data_termino')}}
	  					</div>
	  				@endif
			  </div>
			
			<button class="btn btn-primary btn-sm" type="submit">Salvar</button>
			<a class="btn btn-danger btn-sm" href="{{route('competicao.index')}}">Cancelar</a>
		</form>
	</div>
	


@endsection('conteudo')

