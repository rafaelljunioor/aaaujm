@extends('layout.adm.app')

@section('conteudo')

	<div class="card-header">
		<div class="card-title">
			<h1>Editar Modalidade: Identificação {{$modalidade->id}}</h1>
		</div>
	</div>

	<div class="card-body">
	
		<form method="post" action="{{route('modalidade.update', $modalidade)}}">
		
			@csrf
			@method('PATCH')

			<div class="form-group">
				<p >Nome: </p>
				<input type="text" 
						class="form-control {{$errors->has('nome') ? 'is-invalid' : ''}}" 
						placeholder="Insira o nome da modalidade" 
						value="{{$modalidade->nome}}" 
						name="nome">

					@if($errors->has('nome'))
	  					<div class="invalid-feedback">
	  						{{$errors->first('nome')}}
	  					</div>
	  				@endif
			</div>

			<div class="form-group">
			    <label for="genero">Gênero</label>
			    <select class="form-control {{$errors->has('nome') ? 'is-invalid' : ''}}" id="genero" name="genero">
				     <option value="{{ $modalidade->genero }}">{{ $modalidade->genero }}</option>
				     <option value="F">Feminino</option>
				     <option value="M">Masculino</option>

			    </select>

			    	@if($errors->has('genero'))
	  					<div class="invalid-feedback">
	  						{{$errors->first('genero')}}
	  					</div>
	  				@endif
			  </div>

			<button type="submit" class="btn btn-primary btn-sm">Editar</button>
			<a href="{{route('modalidade.show', $modalidade->id)}}route" class="btn btn-danger btn-sm">Cancelar</a>
		</form>
	</div>



@endsection('conteudo')