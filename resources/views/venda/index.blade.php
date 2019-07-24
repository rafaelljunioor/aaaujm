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

    @if(isset($error))
    <div class="alert alert-danger">
        {{ $error }}
    </div>
    @endif


    
    <div class="card-header">
        <div class="card-title">
            <h1 class="card-title">Vendas</h1>
            <h5 class="form-text text-muted text-left">{{$venda->count()}} vendas de {{$venda->total()}} ({{$venda->firstItem()}} a {{$venda->lastItem()}})  </h5>
        </div>
    </div>
    <div class="card-body">
        <form class="form-group" method="post" action="{{route('buscaVendas')}}">
            
            @csrf
            @method('GET')
            <div class="form-row">
                <div class="col-md-4 mb-3">
                
                    <label for="inputDataInicio">Data Inicio</label>
                    <input  type="date" 
                            class="form-control" 
                            id="inputDataInicio" 
                            placeholder="18/09/2018" 
                            name="data_inicio">
                </div>      
                <div class="col-md-4 mb-3">

                    <label for="inputDataTermino">Data Termino</label>
                    <input  type="date" 
                            class="form-control" 
                            id="inputDataTermino" 
                            placeholder="18/09/2018" 
                            name="data_termino">
                </div>
                <div class="col-md-4 mb-3">

                    <label  for="inputIdVenda">Venda ID</label>
                    <input  type="text" 
                            class="form-control"
                            id="inputIdVenda" 
                            name="id_venda" >
                </div>

                
            </div>
            <button class="btn btn-primary btn-sm" type="submit">Pesquisar</button>
        </form>

    <br>

        <table class="table table-condensed table-hover table-striped table-responsive-sm table-responsive-md">

            <thead>
                <tr>
                    <th>Venda ID</th>
                    <th>Associado</th>
                    <th>Valor</th> 
                    <th>Desconto</th>
                    <th>Usuario/Vendedor</th>
                    <th>Id Vendedor</th>
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
                    <td>{{$v->user->name}}</td>
                    <td>{{$v->user_id}}</td>
                    <td>{{$v->pagamento->nome}}</td>
        
                    <td>{{ date( 'd/m/Y' , strtotime($v->created_at))}}</td>
                    
                    <td ><a href="{{route('venda.show', $v->id)}}" class="btn btn-info btn-sm">Info</a></td>
                    
                </tr>
                @endforeach
                
            </tbody>

        </table>
    </div>

    <div class="card-footer">
        {{$venda->links()}}
        <a class="btn btn-success btn-sm" href="{{route('venda.create')}}">Vender Produto/Serviço</a>
    </div>

@endsection('conteudo')