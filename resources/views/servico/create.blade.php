@extends('layout.adm.app')

@section('conteudo')

	<div class="card-header">
        <div class="card-title">
			<h1>Inserção de Serviço</h1>
		</div>
	</div>

	<div class="card-body">
		<form method="post" action="{{route('servico.store')}}">
			@csrf
			  <div class="form-group">
			    <label for="inputnome">Nome</label>
			    <input type="text" 
			    	   class="form-control {{$errors->has('nome') ? 'is-invalid' : ''}}" 
			    	   id="inputNome" 
			    	   placeholder="Insira o nome do serviço" 
			    	   name="nome">

			    	@if($errors->has('nome'))
	  					<div class="invalid-feedback">
	  						{{$errors->first('nome')}}
	  					</div>
	  				@endif
			  </div>

			  <div class="form-group">
			  	
			    <label for="inputPreco">Preço Sugerido </label>
			    <input type="text" 
			    	   class="form-control {{$errors->has('data_termino') ? 'is-invalid' : ''}}" 
			    	   id="inputPreco" 
			    	   placeholder="Valor sugerido" 
			    	   name="preco_sugerido" 
			    	   data-decimal=",">

			    	@if($errors->has('preco_sugerido'))
	  					<div class="invalid-feedback">
	  						{{$errors->first('preco_sugerido')}}
	  					</div>
	  				@endif
			  </div>

			  <div class="form-group">
			  	
			    <label for="inputDescricao">Descrição</label>
			    <input type="text" 
			    	   class="form-control {{$errors->has('descricao') ? 'is-invalid' : ''}}" 
			    	   id="inputPreco" 
			    	   placeholder="Descrição do serviço" 
			    	   name="descricao" 
			    	   >

			    	@if($errors->has('descricao'))
	  					<div class="invalid-feedback">
	  						{{$errors->first('descricao')}}
	  					</div>
	  				@endif
			  </div>

			<button class="btn btn-primary btn-sm" type="submit">Salvar</button>
			<a class="btn btn-danger btn-sm" href="{{route('produto.index')}}">Cancelar</a>
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
