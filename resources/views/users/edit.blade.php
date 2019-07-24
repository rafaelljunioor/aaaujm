@extends('layout.adm.app')

@section('conteudo')

	<div class="card-header">
        <div class="card-title">
			<h1>Editar Usuário: Identificação {{$user->id}}</h1>
		</div>
	</div>

	<div class="card-body">
    
		<form method="post" action="{{route('user.update', $user)}}">
			
			@csrf
			@method('PATCH')

			<div class="form-group">
				<label for="inputNome">Nome</label>
				<input type="text" 
			    	   class="form-control {{$errors->has('name') ? 'is-invalid' : ''}}" 
			    	   id="inputNome" 
			    	   placeholder="Insira o nome do Usuário" 
			    	   name="name"
			    	   value="{{$user->name}}">

			    	@if($errors->has('name'))
	  					<div class="invalid-feedback">
	  						{{$errors->first('name')}}
	  					</div>
	  				@endif
			</div>

			<div class="form-group">
				<p >Email: </p>
				<input  class="form-control {{$errors->has('email') ? 'is-invalid' : ''}}"  
						type="text" 
						name="email" 
						value="{{ $user->email }}">

				@if($errors->has('email'))
	  					<div class="invalid-feedback">
	  						{{$errors->first('email')}}
	  					</div>
	  			@endif
			</div>

			

			<div class="form-group">
			    <label for="cursos">Curso</label>
			    <select class="form-control {{$errors->has('type') ? 'is-invalid' : ''}}" 
			    		id="type_user" 
			    		name="type">
			   
			        	@foreach($role as $r)
			        		<option value="{{ $r->id }}"

			        			@if ( $r->id == $user->type )
			        				selected="selected"
			        			@endif

			        			>{{ $r->nome }}
			        		</option>
			        	@endforeach
			    </select>

			    @if($errors->has('type'))
	  					<div class="invalid-feedback">
	  						{{$errors->first('type')}}
	  					</div>
	  			@endif
			  </div>

			<button type="submit" class="btn btn-primary btn-sm">Editar</button>
			<a href="{{route('user.show', $user->id)}}" class="btn btn-danger btn-sm">Cancelar</a>
		</form>
	</div>


@endsection('conteudo')

