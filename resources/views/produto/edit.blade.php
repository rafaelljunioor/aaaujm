@extends('layout.adm.app')

@section('conteudo')


	<div class="card-header">
		<div class="card-title">
			<h1>Editar Produto: Identificação {{$produto->id}}</h1>
		</div>
	</div>

<div class="card-body">
	<form method="post" action="{{route('produto.update', $produto)}}">
		
		@csrf
		@method('PATCH')

			<div class="form-group">
				<p >Nome:  </p>
				<input type="text" 
			    	   class="form-control {{$errors->has('nome') ? 'is-invalid' : ''}}" 
			    	   id="inputNome" 
			    	   placeholder="Insira o nome do produto" 
			    	   name="nome"
			    	   value="{{$produto->nome}}">

			    	@if($errors->has('nome'))
	  					<div class="invalid-feedback">
	  						{{$errors->first('nome')}}
	  					</div>
	  				@endif
			</div>

			<div class="form-group">
				<label for="inputlocal">Estoque</label>
			    <input type="number" 
			    	   class="form-control {{$errors->has('estoque') ? 'is-invalid' : ''}}" 
			    	   id="inputEstoque" 
			    	   placeholder="Insira a quantidade em estoque do produto" 
			    	   name="estoque"
			    	   value="{{$produto->estoque}}">

			    	@if($errors->has('estoque'))
	  					<div class="invalid-feedback">
	  						{{$errors->first('estoque')}}
	  					</div>
	  				@endif
			</div>

			<div class="form-group">
				<label for="tamanho">Tamanho</label>
			    <select class="form-control" 
			    		id="tamanho" 
			    		name="tamanho_id">

			        	@foreach($tamanhos as $t)
			        		<option value="{{ $t->id }}"

			        			@if ( $t->id == $produto->tamanho->id )
			        				selected="selected"
			        			@endif

			        			>{{ $t->nome }}
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
				<label for="inputPreco">Preço Sócio</label>
			    <input type="text" 
			    	   class="form-control {{$errors->has('preco_socio') ? 'is-invalid' : ''}}" 
			    	   id="inputPreco" 
			    	   placeholder="Valor sugerido" 
			    	   name="preco_socio" 
			    	   data-decimal=","
			    	   value="{{$produto->preco_socio}}">

			    	@if($errors->has('preco_socio'))
	  					<div class="invalid-feedback">
	  						{{$errors->first('preco_socio')}}
	  					</div>
	  				@endif
			</div>

			<div class="form-group">
				<label for="inputPreco">Preço Não Sócio</label>
			    <input type="text" 
			    	   class="form-control {{$errors->has('preco_nao_socio') ? 'is-invalid' : ''}}" 
			    	   id="inputPrecoNaoSocio" 
			    	   placeholder="Valor sugerido" 
			    	   name="preco_nao_socio" 
			    	   data-decimal=","
			    	   value="{{$produto->preco_nao_socio}}">

			    	@if($errors->has('preco_nao_socio'))
	  					<div class="invalid-feedback">
	  						{{$errors->first('preco_nao_socio')}}
	  					</div>
	  				@endif
			</div>

			<div class="form-group">
			    <label for="fornecedor">Fornecedor</label>
			    <select class="form-control" 
			    		id="fornecedor" 
			    		name="fornecedor_id">

			        	@foreach($fornecedores as $f)
			        		<option value="{{ $f->id }}"

			        			@if ( $f->id == $produto->fornecedor->id )
			        				selected="selected"
			        			@endif

			        			>{{ $f->nome }}
			        		</option>
			        	@endforeach
			    </select>

			    	@if($errors->has('fornecedor_id'))
	  					<div class="invalid-feedback">
	  						{{$errors->first('fornecedor_id')}}
	  					</div>
	  				@endif
			  </div>
			

		<button type="submit" class="btn btn-primary btn-sm">Editar</button>
		<a href="{{route('produto.show', $produto->id)}}" class="btn btn-danger btn-sm">Cancelar</a>
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
