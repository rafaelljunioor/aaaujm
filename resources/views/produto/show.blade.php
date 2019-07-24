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
			<h1>Dados do Produto</h1>
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
					<td>{{ $produto->id }}</td>

				</tr>

				<tr>
					<td>Nome</td>
					<td>{{ $produto->nome }}</td>

				</tr>

				<tr>
					<td>Quantidade em Estoque</td>
					<td>{{ $produto->estoque }}</td>

				</tr>

				<tr>
					<td>Valor Sugerido</td>
					<td>R$ {{$produto->preco_sugerido}}</td>
	                   

				</tr>

				<tr>
					<td>Tamanho</td>

					 @if(isset($produto->tamanho))
	                        <td>{{$produto->tamanho->nome}}</td>
	                 @else
	                        <td>Não Possui</td>
	                 @endif

				</tr>

			</tbody>

		</table>
	</div>

	<div class="card-footer">
		<a class="btn btn-primary btn-sm" href="{{ route('produto.index') }}">Voltar</a>
		<a class="btn btn-success btn-sm" href="{{ route('produto.edit', $produto->id) }}">Editar</a>
		<a class="btn btn-secondary btn-sm" href="{{ route('produto.restore', $produto->id) }}">Ativar</a>

		<form method="post" onsubmit="return confirm('Confirma exclusão do Associado?');" action="{{ route('produto.destroy', $produto) }}">

	  		@csrf
	  		@method('DELETE')
	  		<br>
	  		<input class="btn btn-danger btn-sm" type="submit" value="Excluir">

		</form>
	</div>
</div>

@endsection('conteudo')