@extends('layout.adm.app')

@section('conteudo')

	<div class="card-header">
        <div class="card-title">
			<h1>Editar Servico: Identificação {{$servico->id}}</h1>
		</div>
	</div>

	<div class="card-body">
    
		<form method="post" action="{{route('servico.update', $servico)}}">
			
			@csrf
			@method('PATCH')

			<div class="form-group">
				<label for="inputNome">Nome</label>
				<input type="text" 
			    	   class="form-control {{$errors->has('nome') ? 'is-invalid' : ''}}" 
			    	   id="inputNome" 
			    	   placeholder="Insira o nome do servico" 
			    	   name="nome"
			    	   value="{{$servico->nome}}">

			    	@if($errors->has('nome'))
	  					<div class="invalid-feedback">
	  						{{$errors->first('nome')}}
	  					</div>
	  				@endif
			</div>

			<div class="form-group">
				<label for="inputDescricao">Descrição</label>
			    <textarea type="text" 
			    	   class="form-control {{$errors->has('descricao') ? 'is-invalid' : ''}}" 
			    	   id="inputDescricao" 
			    	   placeholder="Insira a quantidade em descricao do servico" 
			    	   name="descricao"
			    	  >{{$servico->descricao}}</textarea>

			    	@if($errors->has('descricao'))
	  					<div class="invalid-feedback">
	  						{{$errors->first('descricao')}}
	  					</div>
	  				@endif
			</div>

			

			<div class="form-group">
				<label for="inputPreco">Preço Sugerido</label>
			    <input type="text" 
			    	   class="form-control {{$errors->has('data_termino') ? 'is-invalid' : ''}}" 
			    	   id="inputPreco" 
			    	   placeholder="Valor sugerido" 
			    	   name="preco_sugerido" 
			    	   data-decimal=","
			    	   value="{{$servico->preco_sugerido}}">

			    	@if($errors->has('preco_sugerido'))
	  					<div class="invalid-feedback">
	  						{{$errors->first('preco_sugerido')}}
	  					</div>
	  				@endif
			</div>

			<button type="submit" class="btn btn-primary btn-sm">Editar</button>
			<a href="{{route('servico.show', $servico->id)}}" class="btn btn-danger btn-sm">Cancelar</a>
		</form>
	</div>


@endsection('conteudo')


@section('javascript')


<script type="text/javascript">
	
	
	$(function(){
      $('#inputPreco').mask('#0.00', {reverse: true});
      })


</script>



@endsection('javascript')
