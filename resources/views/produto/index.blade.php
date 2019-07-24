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
            <h1 class="card-title">Produtos</h1>
            <h5 class="card-title text-left">{{$produto->count()}} modalidades de {{$produto->total()}} ({{$produto->firstItem()}} a {{$produto->lastItem()}})  </h5>       
        </div>
    </div>
    <div class="card-body">
        <table class="table table-condensed table-hover table-striped table-responsive-sm table-responsive-md">

            <thead>
                <tr>
                    <th>Id do Produto</th>
                    <th>Nome</th>
                    <th>Estoque</th>
                    <th>Preço Sugerido</th>
                    <th>Tamanho</th>
                    <th>Nome Fornecedor</th>
                    <th>Status</th>
                    <th>Info</th>
                </tr>
            </thead>

            <tbody>

            @foreach($produto as $p)
            
                <tr>
                    <td>{{$p->id}}</td>
                    <td>{{$p->nome}}</td>
                    <td>{{$p->estoque}}</td>
                    <td>R$ {{$p->preco_sugerido}}</td>
                    @if(isset($p->tamanho->nome))
                        <td>{{$p->tamanho->nome}}</td>
                    @else
                        <td>Não Possui</td>
                    @endif
                    <td>{{$p->fornecedor->nome}}</td>

                    @if($p->deleted_at != NULL)
                        <td class="text text-danger"> Desativado</td>
                    @else
                        <td class="text text-success"> Ativado</td>
                    @endif
                        
                    
                    <td ><a href="{{route('produto.show', $p->id )}}" class="btn btn-info btn-sm">Info</a></td>
                </tr>
            @endforeach

        </tbody>

        </table>
    </div>

    <div class="card-footer">
        {{$produto->links()}}
       <a class="btn btn-success btn-sm" href="{{route('produto.create')}}">Cadastrar</a>
    </div>

@endsection('conteudo')