@extends('layout.adm.app')

@section('conteudo')

	<div class="card-header">
		<div class="card-title">
			<h1>Inserção de Modalidade</h1>
		</div>
	</div>
	<div class="card-body">
		<form method="post" action="{{route('modalidade.store')}}">

			@csrf
				
				  <div class="form-group">
				    <label for="inputnome">Nome</label>
				    <input type="text" 
				    		class="form-control {{$errors->has('nome') ? 'is-invalid' : ''}}" 
				    		id="inputnome" 
				    		placeholder="Insira o nome da modalidade" 
				    		name="nome">

				    	@if($errors->has('nome'))
		  					<div class="invalid-feedback">
		  						{{$errors->first('nome')}}
		  					</div>
		  				@endif

				  </div>

				  <div class="form-group">
				    <label for="genero">Gênero</label>
				    <select class="form-control {{$errors->has('genero') ? 'is-invalid' : ''}}" id="genero" name="genero">
					     <option value="F">Feminino</option>
					     <option value="M">Masculino</option>
					</select>

						@if($errors->has('genero'))
		  					<div class="invalid-feedback">
		  						{{$errors->first('genero')}}
		  					</div>
		  				@endif
				  </div>
				
				<button class="btn btn-primary btn-sm" type="submit">Salvar</button>
				<a class="btn btn-danger btn-sm" href="{{route('modalidade.index')}}">Cancelar</a>
			</form>
		</div>
	


@endsection('conteudo')

