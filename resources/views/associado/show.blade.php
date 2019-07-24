@extends('layout.adm.app')

@section('conteudo')

    @if (session()->has('success'))
     
    <div class="alert alert-success">
            {{ session('success') }}
    </div>
    @elseif (session()->has('error'))
    <div class="alert alert-danger">
            {{ session('error') }}
    </div>

    @endif

    <div class="card-header">
        <div class="card-title">
			<h1>Dados do Associados</h1>
		</div>
	</div>	

	<div class="card-body">
		<table class="table table-condensed table-hover table-striped table-responsive-sm table-responsive-md">
			<thead>
				<th> Atributos</th>
				<th> Valores </th>

			</thead>
			<tbody>
				<tr>
					<td>ID</td>
					<td>{{ $associado->id }}</td>

				</tr>

				<tr>
					<td>Nome</td>
					<td>{{ $associado->pessoa->nome }}</td>

				</tr>

				<tr>
					<td>Matricula</td>
					<td>{{ $associado->pessoa->matricula }}</td>

				</tr>

				<tr>
					<td>Telefone</td>
					<td>{{ $associado->pessoa->telefone }}</td>

				</tr>

				<tr>
					<td>Email</td>
					<td>{{ $associado->pessoa->email }}</td>

				</tr>

				<tr>
					<td>Curso do Atleta</td>
					<td>{{ $associado->pessoa->curso->nome }}</td>

				</tr>

				<tr>
					<td>Data Início</td>
					<td>{{ date( 'd/m/Y' , strtotime($associado->data_inicio))}}</td>
	                   

				</tr>

				<tr>
					<td>Data Término</td>
					<td>{{ date( 'd/m/Y' , strtotime($associado->data_termino))}}</td>

				</tr>

			</tbody>

		</table>
	

	<br>
	<h5 class="text-title">Compras do Associado</h5>
	
		<table class="table table-condensed table-hover table-striped table-responsive-sm table-responsive-md">

	        <thead>
	            <tr>
	                <th>Id da Venda</th>
	                <th>Valor</th>     
	                <th>Desconto</th>
	                <th>Usuario</th>
	                <th>Forma de Pagamento</th>
	                <th>Data</th>
	                <th>Info</th>
	            </tr>
	        </thead>

	        <tbody>
	        @if(isset($associado->vendas))
	            @foreach($associado->vendas as $v)
	            
	            <tr>
	                <td>{{$v->id}}</td>
	                <td>R$ {{$v->valor_total_venda}}</td>
	                <td> {{$v->desconto}} %</td>
	                <td>{{$v->user_id}}</td>
	                <td>{{$v->pagamento->nome}}</td>
	    
	                <td>{{ date( 'd/m/Y' , strtotime($v->created_at))}}</td>
	                
	                <td ><a href="{{route('venda.show', $v->id)}}" class="btn btn-info btn-sm">Info</a></td>
	                
	            </tr>
	            @endforeach
	          @endif  
	        </tbody>

	    </table>
	</div>
	<div class="card-footer">
		<a class="btn btn-primary btn-sm" href="{{ route('associado.index') }}">Voltar</a>
		<a class="btn btn-success btn-sm" href="{{ route('associado.edit', $associado->id) }}">
		Editar</a>
		<a class="btn btn-secondary btn-sm" href="{{ route('associado.restore', $associado->id) }}">Ativar</a>
		<form method="post" onsubmit="return confirm('Confirma exclusão do Atleta?');" action="{{ route('associado.destroy', $associado->id) }}">

	  		@csrf
	  		@method('DELETE')
	  		<br>
	  		<input class="btn btn-danger btn-sm" type="submit" value="Excluir">

		</form>
	</div>
</div>

@endsection('conteudo')