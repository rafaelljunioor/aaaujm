@extends('layout.adm.app')

@section('conteudo')

@if(isset($error))
		<div class="alert alert-danger">
        {{ $error }}
		</div>
@endif

	<div class="card-header">
		<div class="card-title"> 
			<h1>Atualização de Atleta</h1>
		</div>
	</div>

	<div class="card-body">
		<form method="post" action="{{route('atleta.update', $atleta->id)}}">
			@csrf
			@method('PATCH')

			<div class="form-group">
				<p >Matricula: </p>
				<input  id="inputmatricula" 
						class="form-control {{$errors->has('matricula') ? 'is-invalid' : ''}}" 
						type="text" 
						name="matricula" 
						value="{{ $atleta->pessoa->matricula }}">

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
					   value="{{ $atleta->pessoa->nome }}">

				@if($errors->has('nome'))
	  					<div class="invalid-feedback">
	  						{{$errors->first('nome')}}
	  					</div>
	  			@endif
			</div>

			<div class="form-group">
				<p >Telefone: </p>
				<input id="inputtelefone" 
					    class="form-control" 
					    type="text"
					    name="telefone" 
					    value="{{ $atleta->pessoa->telefone }}">
			</div>

			<div class="form-group">
				<p >Email: </p>
				<input  class="form-control {{$errors->has('email') ? 'is-invalid' : ''}}"  
						type="text" 
						name="email" 
						value="{{ $atleta->pessoa->email }}">

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

			        			@if ( $c->id == $atleta->pessoa->curso_id )
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
			    <label for="uniformes">Tamanho Uniforme</label>
			    <select class="form-control {{$errors->has('tamanho_uniforme') ? 'is-invalid' : ''}}" 		  id="uniformes" 
			    		name="tamanho_uniforme">
				
				    	@foreach($tamanho as $t)
			        		<option value="{{ $t->id }}" 

			        			@if ( $t->id == $atleta->tamanho_id )
			        				selected="selected"
			        			@endif

			        			>{{ $t->nome }}
			        		</option>
			        	@endforeach
			    </select>

			    @if($errors->has('tamanho_uniforme'))
	  					<div class="invalid-feedback">
	  						{{$errors->first('tamanho_uniforme')}}
	  					</div>
	  			@endif
			  </div>

			  <div class="form-group">
				<p >Altura: </p>
				<input  id="inputaltura" 
						class="form-control {{$errors->has('altura') ? 'is-invalid' : ''}}"  
						type="number"
						name="altura" 
						step="0.01"
						value="{{ $atleta->altura}}">

				@if($errors->has('altura'))
	  					<div class="invalid-feedback">
	  						{{$errors->first('altura')}}
	  					</div>
	  			@endif
			</div>

			 <div class="form-group">
				<p >Peso: </p>
				<input 	id="inputpeso" 
						class="form-control {{$errors->has('peso') ? 'is-invalid' : ''}}"  
						type="number"
						name="peso" 
						step="0.01" 
						value="{{ $atleta->peso}}">

				@if($errors->has('peso'))
	  					<div class="invalid-feedback">
	  						{{$errors->first('peso')}}
	  					</div>
	  			@endif
			</div>

			<div class="form-group">
				<p>Descricao: </p>
				<textarea class="form-control {{$errors->has('descricao') ? 'is-invalid' : ''}}" 
					      name="descricao" >{{ $atleta->descricao }}</textarea>

				@if($errors->has('descricao'))
	  					<div class="invalid-feedback">
	  						{{$errors->first('descricao')}}
	  					</div>
	  			@endif
			</div>

			<button class="btn btn-primary btn-sm" type="submit" >Editar</button>
			<a class="btn btn-danger btn-sm" href="{{route('atleta.show', $atleta->id)}}">Cancelar</a>
		</form>
	</div>

	

@endsection('conteudo')

@section('javascript')


<script type="text/javascript">
	
	
	$(document).ready(function(){
      $('#inputmatricula').mask('00.0.0000');
      $('#inputtelefone').mask('(00) 0 0000-0000');
      $('#inputaltura').mask('0.00');
      $('#inputpeso').mask("#0.00", {reverse: true});
      });

</script>


@endsection('javascript')