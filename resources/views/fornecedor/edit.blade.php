@extends('layout.adm.app')

@section('conteudo')

	<div class="card-header">
		<div class="card-title">
			<h1>Editar Fornecedor: Identificação {{$fornecedor->id}}</h1>
		</div>
	</div>

	<div class="card-body">
		<form method="post" action="{{route('fornecedor.update', $fornecedor)}}">
	
			@csrf
			@method('PATCH')

				<div class="form-group">
					<p >Nome:  </p>
					<input type="text" 
				    	   class="form-control {{$errors->has('nome') ? 'is-invalid' : ''}}" 
				    	   id="inputNome" 
				    	   placeholder="Insira o nome do produto" 
				    	   name="nome"
				    	   value="{{$fornecedor->nome}}">

				    	@if($errors->has('nome'))
		  					<div class="invalid-feedback">
		  						{{$errors->first('nome')}}
		  					</div>
		  				@endif
				</div>

				<div class="form-group">
					<label for="inputlocal">CNPJ</label>
				    <input type="text" 
				    	   class="form-control {{$errors->has('cnpj') ? 'is-invalid' : ''}}" 
				    	   id="inputCnpj" 
				    	   placeholder="Informe o CNPJ do fornecedor" 
				    	   name="cnpj"
				    	   value="{{$fornecedor->cnpj}}">

				    	@if($errors->has('cnpj'))
		  					<div class="invalid-feedback">
		  						{{$errors->first('cnpj')}}
		  					</div>
		  				@endif
				</div>

				<div class="form-group">
					<label for="inputlocal">Email</label>
					<input  class="form-control {{$errors->has('email') ? 'is-invalid' : ''}}"  
							type="text" 
							name="email" 
							value="{{ $fornecedor->email }}">

					@if($errors->has('email'))
		  					<div class="invalid-feedback">
		  						{{$errors->first('email')}}
		  					</div>
		  			@endif
				</div>

				<div class="form-group">
					<label for="inputTelefone">Telefone</label>
				    <input type="text" 
				    	   class="form-control {{$errors->has('telefone') ? 'is-invalid' : ''}}" 
				    	   id="inputTelefone" 
				    	   placeholder="Informe o contato" 
				    	   name="telefone" 
				    	   value="{{$fornecedor->telefone}}">

				    	@if($errors->has('telefone'))
		  					<div class="invalid-feedback">
		  						{{$errors->first('teleofone')}}
		  					</div>
		  				@endif
				</div>

				<div class="form-group">
					<label for="inputDescricao">Descricao</label>
				    <input type="text" 
				    	   class="form-control {{$errors->has('descricao') ? 'is-invalid' : ''}}" 
				    	   id="inputDescricao" 
				    	   placeholder="Informe o contato" 
				    	   name="descricao" 
				    	   value="{{$fornecedor->descricao}}">

				    	@if($errors->has('descricao'))
		  					<div class="invalid-feedback">
		  						{{$errors->first('descricao')}}
		  					</div>
		  				@endif
				</div>
				

				<button type="submit" class="btn btn-primary btn-sm">Editar</button>
				<a href="{{route('fornecedor.show', $fornecedor->id)}}route" class="btn btn-danger btn-sm">Cancelar</a>
			</form>
		</div>



@endsection('conteudo')


@section('javascript')


<script type="text/javascript">
	
	
	$(function(){
      $('#inputCnpj').mask('99.999.999/9999-99');
      $('#inputTelefone').mask('(00) 0 0000-0000');
      })


</script>



@endsection('javascript')
