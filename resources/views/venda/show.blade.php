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
			<h1>Dados da Venda : {{$venda->id}}</h1>
		</div>
	</div>
	
	<div class="card-body">
		<table class="table table-condensed table-hover table-striped table-responsive-sm table-responsive-md">

			<thead>
				<th>Produtos</th>
				<th>Valor Unitario</th>
				<th>Quantidade</th>
				<th>Valor Total</th>
			</thead>
			<tbody>


				<!--evita erro -->

				@foreach($produtos as $p)
				<tr>
					<td>{{ $p->nome}}</td>
					<td>R$ {{ $p->valor_unitario }}</td>
					<td>{{ $p->quantidade}}</td>
					<td>R$ {{ $p->valor_total_item }}</td>

				</tr>
				@endforeach

				@foreach($servicos as $s)
				<tr>
					<td>{{ $s->nome}}</td>

					<td>R$ {{ $s->valor_unitario }}</td>
					<td>{{ $s->quantidade}}</td>
					<td>R$ {{ $s->valor_total_item }}</td>

				</tr>
				@endforeach

				<tr class="table-light table-bordered">
					<td colspan="3"><strong>Valor Total</strong></td>
					<td colspan="1"><strong> R$ {{$venda->valor_total_venda_sem_desconto}}</strong></td>
				</tr>
				<tr class="table-light table-bordered">
					<td colspan="3"><strong>Valor Total com Desconto</strong></td>
					<td colspan="1"><strong> R$ {{$venda->valor_total_venda}}</strong></td>
				</tr>
				<tr class="table-light table-bordered">
					<td colspan="3"><strong>Desconto</strong></td>
					<td colspan="1"><strong>R$ {{$venda->desconto}}</strong></td>
				</tr>
				
			</tbody>

		</table>

	<br>

		<h5 class="text-title">Detalhes Pagamentos</h5>

		<table class="table table-condensed table-hover table-striped table-responsive-sm table-responsive-md">
			<thead>
				<th>Parcela</th>
				<th>Status</th>
				<th>Data Prevista de Pagamento</th>
				<th>Valor Parcela</th>
				<th>Atualização</th>
				<th></th>
			</thead>
			<tbody>
				@foreach($venda->parcelas as $p)
				<tr>
					<td>{{ $p->numero }}</td>
					@if($p->status=='PENDENTE')
					<td class="text text-warning">{{ $p->status}}</td>
					@else
					<td class="text text-success">{{ $p->status}}</td>
					@endif
					<td>{{ date( 'd/m/Y' , strtotime($p->data_pagamento))}}</td>
					<td>R$ {{$p->valor_parcela}}</td>
					<td>{{$p->updated_at}}</td>
					@if($p->status=='PENDENTE')
					<td>
						<form method="post" action="{{route('venda.update', $p->id)}}">
							@csrf @method('PATCH')
							<button type="submit" class="btn btn-success btn-sm">Confirmar Pagamento</button>
						</form>
					</td>

					@else
					<td></td>
					@endif
				</tr>
				@endforeach


			</tbody>

		</table>
	</div>

	<div class="card-footer">
		<a class="btn btn-primary btn-sm" href="{{ route('venda.index') }}">Voltar</a>
	</div>

@endsection('conteudo')