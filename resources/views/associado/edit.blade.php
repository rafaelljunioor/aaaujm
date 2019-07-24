@extends('layout.adm.app')

@section('conteudo')

<div class="card-header">
	<div class="card-title"> 
		<h1>Atualização de Associado: Identificação {{ $associado->id}}</h1>
	</div>
</div>

<div class="card-body">
	<form method="post" action="{{route('associado.update', $associado->id)}}">
		@csrf
		@method('PATCH')

		<div class="form-group">
			<p >Matricula: </p>
			<input  id="inputmatricula" 
					class="form-control {{$errors->has('matricula') ? 'is-invalid' : ''}}" 
					type="text" 
					name="matricula" 
					value="{{ $associado->pessoa->matricula }}">

				@if($errors->has('matricula'))
  					<div class="invalid-feedback">
  						{{$errors->first('matricula')}}
  					</div>
  				@endif
		</div>

		<div class="form-group">
			<p >Nome: </p>
			<input class="form-control {{$errors->has('nome') ? 'is-invalid' : ''}}" 
				   type="text" 
				   name="nome" 
				   value="{{ $associado->pessoa->nome }}">

				@if($errors->has('nome'))
  					<div class="invalid-feedback">
  						{{$errors->first('nome')}}
  					</div>
  				@endif
		</div>

		<div class="form-group">
			<p >Telefone: </p>
			<input class="form-control " 
				   type="text"
				   id="inputtelefone" 
				   name="telefone" 
				   value="{{ $associado->pessoa->telefone }}">

				@if($errors->has('telefone'))
  					<div class="invalid-feedback">
  						{{$errors->first('telefone')}}
  					</div>
  				@endif
		</div>

		<div class="form-group">
			<p >Email:</p> 
			<input  class="form-control {{$errors->has('email') ? 'is-invalid' : ''}}"  
					type="text" 
					name="email" 
					value="{{ $associado->pessoa->email }}">

		 		@if($errors->has('email'))
  					<div class="invalid-feedback">
  						{{$errors->first('email')}}
  					</div>
  				@endif
		</div>

		<div class="form-group">
		    <label for="cursos">Curso</label>
		    <select class="form-control {{$errors->has('curso') ? 'is-invalid' : ''}}" 
		    		id="cursos" 
		    		name="curso">
		    
        	
		        	@foreach($curso as $c)
		        		<option value="{{ $c->id }}"

		        			@if ( $c->id == $associado->pessoa->curso_id )
		        				selected="selected"
		        			@endif

		        			>{{ $c->nome }}
		        		</option>
		        	@endforeach
		    </select>
		    	@if($errors->has('curso'))
  					<div class="invalid-feedback">
  						{{$errors->first('curso')}}
  					</div>
  				@endif
		  </div>

		  <div class="form-group">
			<p >Data Inicio </p>
			<input type="date" 
				   class="form-control {{$errors->has('data_inicio') ? 'is-invalid' : ''}}" 
				   placeholder="18/09/2018" 
				   value="{{$associado->data_inicio}}" 
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
				   value="{{$associado->data_termino}}" 
				   class="form-control {{$errors->has('data_termino') ? 'is-invalid' : ''}}" 
				   name="data_termino"></p>

				   @if($errors->has('data_termino'))
  					<div class="invalid-feedback">
  						{{$errors->first('data_termino')}}
  					</div>
  				@endif
		</div>
		

	

		<button class="btn btn-primary btn-sm" type="submit" >Editar</button>
		<a class="btn btn-danger btn-sm" href="{{route('associado.show', $associado->id)}}">Cancelar</a>
	</form>
</div>
	

@endsection('conteudo')



@section('javascript')


<script type="text/javascript">
	
	
	$(document).ready(function(){
      $('#inputmatricula').mask('00.0.0000');
      $('#inputtelefone').mask('(00) 0 0000-0000');
      });

</script>


@endsection('javascript')