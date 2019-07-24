
@extends('layout.adm.app')

@section('conteudo')

	<div class="card-header">
		<div class="card-title"> 
			<h1>Inserção de Atletas</h1>
		</div>
	</div>


	<div class="card-body">
		<form method="post" action="{{route('atleta.store')}}">

			@csrf
			
			  <div class="form-group" ">
			  	
				    <label for="inputtelefone">Matricula</label>
				    <div class="input-group mb-3">
			  			<input  type="text" 
			  					class="form-control {{$errors->has('matricula') ? 'is-invalid' : ''}}" 
			  					id="inputmatricula" 
			  					name="matricula" 
			  					onFocus='limpa()'
			  					placeholder="Insira sua matricula" 
			  					aria-label="Recipient's username" 
			  					aria-describedby="basic-addon2">
					    
					     <div class="input-group-append">
			    				<button class="btn btn-outline-secondary " 
			    						onClick='pesquisaPessoa(inputmatricula.value)' 
			    						type="button">
			    						Pesquisar
			    				</button>
			  			</div>

			  		@if($errors->has('matricula'))
	  					<div class="invalid-feedback">
	  						{{$errors->first('matricula')}}
	  					</div>
	  				@endif
	  				</div>
	  				
			  </div>
			  <div class="form-group" ">
			  	
			    <label for="inputnome">Nome</label>
			    <input type="text" 
			    	   class="form-control {{$errors->has('nome') ? 'is-invalid' : ''}}" 
			    	   id="inputnome" 
			    	   placeholder="Insira Seu telefone" 
			    	   name="nome">

			    @if($errors->has('nome'))
	  					<div class="invalid-feedback">
	  						{{$errors->first('nome')}}
	  					</div>
	  			@endif
			  </div>
			  <div class="form-group">
			  	
			    <label for="inputemail">Email</label>
			    <input type="email" 
			    	   class="form-control {{$errors->has('email') ? 'is-invalid' : ''}}" 
			    	   id="inputemail" 
			    	   placeholder="nome@example.com" name="email">
			    @if($errors->has('email'))
	  				<div class="invalid-feedback">
	  					{{$errors->first('email')}}
	  				</div>
	  			@endif
			  </div>

			  <div class="form-group">
			  	
			    <label for="inputtelefone">Telefone</label>
			    <input type="text" 
			    	   class="form-control" 
			    	   id="inputtelefone" 
			    	   placeholder="(00) 0 0000-0000" 
			    	   name="telefone">
			  </div>

			  <div class="form-group">
			    <label for="cursos">Curso</label>
			    <select class="form-control {{$errors->has('curso') ? 'is-invalid' : ''}}" 
			    		id="cursos" 
			    		name="curso">
			    		 <option  value="">Selecione:</option>
				    		@foreach($cursos as $c)
			        			
				        		<option value="{{ $c->id }}"> {{ $c->nome }}
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
			    <label for="tamanho_uniforme">Tamanho Uniforme</label>
			    <select class="form-control {{$errors->has('tamanho_uniforme') ? 'is-invalid' : ''}}" 
			    		id="uniformes" 
			    		name="tamanho_uniforme">
			    		 <option  value="">Selecione:</option>
				    		@foreach($tamanhos as $t)
			        			
				        		<option value="{{ $t->id }}"> {{ $t->nome }}
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
			  	
			    <label for="inputdescricao">Descrição do Atleta</label>
			    <textarea type="text" 
			    		  class="form-control" 
			    		  id="inputdescricao" 
			    		  name="descricao"></textarea>
			  </div>

			  <div class="form-group" ">
			  	
			    <label for="inputaltura">Altura</label>
			    <input type="number" 
			    	   class="form-control {{$errors->has('altura') ? 'is-invalid' : ''}}" 
			    	   id="inputaltura" 
			    	   placeholder="Altura em metros"
			    	   step="0.01" 
			    	   name="altura">

			    @if($errors->has('altura'))
	  				<div class="invalid-feedback">
	  						{{$errors->first('altura')}}
	  				</div>
	  			@endif
			  </div>

			  <div class="form-group" ">
			  	
			    <label for="inputpeso">Peso</label>
			    <input type="number" 
			    	   class="form-control {{$errors->has('peso') ? 'is-invalid' : ''}}" 
			    	   id="inputpeso" 
			    	   placeholder="Peso em Kg"
			    	   step="0.01" 
			    	   name="peso">

			    @if($errors->has('peso'))
	  				<div class="invalid-feedback">
	  						{{$errors->first('peso')}}
	  				</div>
	  			@endif
			  </div>
			
			<button class="btn btn-primary btn-sm" onClick='habilita()' type="submit">Salvar</button>
			<a class="btn btn-danger btn-sm" href="{{route('atleta.index')}}">Cancelar</a>
		</form>

		<!--@if($errors->any())
			<div class="card-footer">
				
				@foreach($errors->all() as $error)
					<div class="alert alert-danger" role="alert">
						{{$error}}
					</div>
				@endforeach

			</div>
		@endif-->


		<!--@if(isset($errors))
		{{var_dump($errors)}}
		@endif-->

	
	</div> <!--FINAL CARD-BODY-->

@endsection('conteudo')


@section('javascript')


<script type="text/javascript">
	
	

	function pesquisaPessoa(mat)
	{	//alterado para public pois eh o caminho do host 
		$.getJSON('/public/dadosatletapormatricula/'+mat, function(data)
		//$.getJSON('/dadosatletapormatricula/'+mat, function(data)
		{
			console.log(data);

				
				if (data.lenght != 0) 
				{
					$('#inputmatricula').val(data[0].matricula);
		            $('#inputemail').val(data[0].email);
		            $('#inputnome').val(data[0].nome);
		            $('#inputtelefone').val(data[0].telefone);
		            $('#cursos').val(data[0].curso_id);
		            $('#inputaltura').val(data[0].altura);

		            $("#inputemail").prop("disabled", true);
		            $("#inputnome").prop("disabled", true); 
		            $("#inputtelefone").prop("disabled", true); 
		            $("#cursos").prop("disabled", true); 
		            
		            alert("Atleta encontrado!");
		   
		            
				}else{
					alert("Atleta não encontrado!");
				}
				
				
			
		})
	}
	
	$(document).ready(function(){
      $('#inputmatricula').mask('00.0.0000');
      $('#inputtelefone').mask('(00) 0 0000-0000');
      $('#inputaltura').mask('0.00');
      $('#inputpeso').mask("#0.00", {reverse: true});


      
      });

	function habilita(){
	 $("#inputemail").prop("disabled", false); 
	 $("#inputnome").prop("disabled", false); 
     $("#inputtelefone").prop("disabled", false); 
	 $("#cursos").prop("disabled", false);
	 
    
	}

	//ao alterar matricula os dados sao limpos
	function limpa(){
	 $("#inputemail").prop("disabled", false); 
	 $("#inputnome").prop("disabled", false); 
     $("#inputtelefone").prop("disabled", false); 
	 $("#cursos").prop("disabled", false);	

	 $('#inputemail').val('');
	 $('#inputnome').val('');
	 $('#inputtelefone').val('');
	 $('#cursos').val('');
	}


</script>


@endsection('javascript')