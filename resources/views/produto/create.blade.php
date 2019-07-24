@extends('layout.adm.app')

@section('conteudo')

	<div class="card-header">
		<div class="card-title">
			<h1>Inserção de Produto</h1>
		</div>
	</div>

	<div class="card-body">
		<form method="post" action="{{route('produto.store')}}">

			@csrf
			
			  <div class="form-group">
			    <label for="inputnome">Nome</label>
			    <input type="text" 
			    	   class="form-control {{$errors->has('nome') ? 'is-invalid' : ''}}" 
			    	   id="inputNome" 
			    	   placeholder="Insira o nome do produto" 
			    	   name="nome">

			    	@if($errors->has('nome'))
	  					<div class="invalid-feedback">
	  						{{$errors->first('nome')}}
	  					</div>
	  				@endif
			  </div>

			  <div class="form-group">
			  	
			    <label for="inputEstoque">Estoque</label>
			    <input type="number" 
			    	   class="form-control {{$errors->has('estoque') ? 'is-invalid' : ''}}" 
			    	   id="inputEstoque" 
			    	   placeholder="Insira a quantidade em estoque do produto" 
			    	   name="estoque">

			    	@if($errors->has('estoque'))
	  					<div class="invalid-feedback">
	  						{{$errors->first('estoque')}}
	  					</div>
	  				@endif
			  </div>

			  <div class="form-group">
			  	
			    <div class="form-group">
			    <label for="tamanho_id">Tamanho</label>
			    <select class="form-control" 
			    		id="tamanho" 
			    		name="tamanho_id">

			  	    <option value=""> Selecione: </option>
			        	@foreach($tamanhos as $t)

				        		<option value="{{ $t->id }}"> {{ $t->nome }}
				        		</option>
			        	@endforeach
			    </select>

			    	@if($errors->has('tamanho_id'))
	  					<div class="invalid-feedback">
	  						{{$errors->first('tamanho_id')}}
	  					</div>
	  				@endif
			  </div>

			  <div class="form-group">
			  	
			    <label for="inputPreco">Preço Sugerido</label>
			    <input type="text" 
			    	   class="form-control {{$errors->has('preco_sugerido') ? 'is-invalid' : ''}}" 
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
			    <label for="fornecedor">Fornecedor</label>
			    <select class="form-control" 
			    		id="fornecedor" 
			    		name="fornecedor_id">

			    <option value=""> Selecione: </option>
			        	@foreach($fornecedores as $f)

				        		<option value="{{ $f->id }}"> {{ $f->nome }}
				        		</option>
				        		
			        	@endforeach
			    </select>

			    	@if($errors->has('fornecedor_id'))
	  					<div class="invalid-feedback">
	  						{{$errors->first('fornecedor_id')}}
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
      $('#inputPreco').mask('#0.00', {reverse: true});;
      })


</script>



@endsection('javascript')

