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
            <h5 class="card-title text-left">Resultado das buscas das Vendas.</h5>
        </div>
    </div>

    <div class="card-body">
       <table class="table table-condensed table-hover table-striped table-responsive-sm table-responsive-md">

            <thead>
                <tr>
                    <th>Id da Venda</th>
                    <th>Associado</th>
                    <th>Valor</th> 
                    <th>Desconto</th>
                    <th>Usuario</th>
                    <th>Forma de Pagamento</th>
                    <th>Data</th>
                    <th>Info</th>
                </tr>
            </thead>

            <tbody>

                @foreach($venda as $v)
                
                <tr>
                    <td>{{$v->id}}</td>
                    @if(isset($v->associado))
                    <td>{{$v->associado->pessoa->nome}}</td>
                    @else
                    <td>NÃO INFORMADO</td>
                    @endif

                    <td>R$ {{$v->valor_total_venda}}</td>
                    <td> {{$v->desconto}} %</td>
                    <td>{{$v->user_id}}</td>
                    <td>{{$v->pagamento->nome}}</td>
        
                    <td>{{ date( 'd/m/Y' , strtotime($v->created_at))}}</td>
                    
                    <td ><a href="{{route('venda.show', $v->id)}}" class="btn btn-info btn-sm">Info</a></td>
                    
                </tr>
                @endforeach
                
            </tbody>

        </table>

            @if(!count($venda))
                <h5 class="card-title text-center">Sem dados para exibição</h5>
            @endif
    </div>

    <div class="card-footer">
      
        <a class="btn btn-danger btn-sm" href="{{route('venda.index')}}">Cancelar</a>

    </div>
</div>
@endsection('conteudo')