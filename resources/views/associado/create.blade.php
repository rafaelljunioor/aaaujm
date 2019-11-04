@extends('layout.adm.app')

@section('conteudo')

<div class="card-header">
	
	<div class="card-title"> 
		<h1>Inserção de Associados</h1>
	</div>
</div>

<div class="card-body">
	<form method="post" action="{{route('associado.store')}}">

		@csrf
			
			  <div class="form-group" ">
			  	
				    <label for="inputmatricula">Matricula</label>
				    <div class="input-group mb-3">
			  			<input type="text" 
			  				   class="form-control {{$errors->has('matricula') ? 'is-invalid' : ''}}" 
			  				   id="inputmatricula" 
			  				   name="matricula"
			  				   onFocus='limpa()' 
			  				   placeholder="Insira sua matricula" 
			  				   aria-label="Recipient's username" 
			  				   aria-describedby="basic-addon2">
					    
					     <div class="input-group-append">
			    				<button class="btn btn-outline-secondary btn-sm" onClick='pesquisaPessoa(inputmatricula.value)' type="button">Pesquisar</button>
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
			    	   placeholder="Insira o nome do associado" 
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
			    	   placeholder="nome@example.com" 
			    	   name="email">

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
		  	
		    <label for="inputDataInicio">Data Inicio</label>
		    <input type="date" 
		    	   class="form-control {{$errors->has('data_inicio') ? 'is-invalid' : ''}}" 
		    	   id="inputDataInicio" 
		    	   placeholder="18/09/2018" 
		    	   name="data_inicio">

		    	@if($errors->has('data_inicio'))
  					<div class="invalid-feedback">
  						{{$errors->first('data_inicio')}}
  					</div>
  				@endif
		  </div>

		  <div class="form-group">
		  	
		    <label for="inputDataTermino">Data Termino</label>
		    <input type="date" 
		    	   class="form-control {{$errors->has('data_termino') ? 'is-invalid' : ''}}" 
		    	   id="inputDataTermino" 
		    	   name="data_termino">

		    	@if($errors->has('data_termino'))
  					<div class="invalid-feedback">
  						{{$errors->first('data_termino')}}
  					</div>
  				@endif
		  </div>
			
			<button class="btn btn-primary btn-sm" onClick= 'habilita()' type="submit">Salvar</button>
			<a class="btn btn-danger btn-sm" href="{{route('associado.index')}}">Cancelar</a>
		</form>

	
</div>

@endsection('conteudo')


@section('javascript')


<script type="text/javascript">
	
	

	function pesquisaPessoa(mat)
	{
		$.getJSON('/public/dadosassociadopormatricula/'+mat, function(data)
		//$.getJSON('/dadosassociadopormatricula/'+mat, function(data)
		{
			console.log(data);

				
				if (data.length != 0) 
				{
					$('#inputmatricula').val(data[0].matricula);
		            $('#inputemail').val(data[0].email);
		            $('#inputnome').val(data[0].nome);
		            $('#inputtelefone').val(data[0].telefone);
		            $('#cursos').val(data[0].curso_id);
		            $("#inputemail").prop("disabled", true);
		            $("#inputnome").prop("disabled", true); 
		            $("#inputtelefone").prop("disabled", true); 
		            $("#cursos").prop("disabled", true); 
		           
		            alert("Associado Encontrado!");
				}else{
					alert("Associado não encontrado!");
				}
				
		})
	}
	
	$(document).ready(function(){
      $('#inputmatricula').mask('00.0.0000');
      $('#inputtelefone').mask('(00) 0 0000-0000');
      });

	//habilita para enviar os dados e passar por validação
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