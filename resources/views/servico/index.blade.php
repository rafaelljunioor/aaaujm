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
            <h1 class="card-title">Serviços</h1>
            <h5 class="card-title text-left">{{$servico->count()}} modalidades de {{$servico->total()}} ({{$servico->firstItem()}} a {{$servico->lastItem()}})  </h5>
        </div>
    </div>

    <div class="card-body">
        <table class="table table-condensed table-hover table-striped table-responsive-sm table-responsive-md">

            <thead>
                <tr>
                    <th>Id do servico</th>
                    <th>Nome</th>
                    <th>Preço Sugerido</th>
                    <th>Descrição</th>
                    <th>Status</th>
                    <th>Info</th>
                </tr>
            </thead>

            <tbody>

            @foreach($servico as $s)
            
                <tr>
                    <td>{{$s->id}}</td>
                    <td>{{$s->nome}}</td>
                    <td>R$ {{$s->preco_sugerido}}</td>
                    <td>{{$s->descricao}}</td>

                    @if($s->deleted_at != NULL)
                        <td class="text text-danger"> Desativado</td>
                    @else
                        <td class="text text-success"> Ativado</td>
                    @endif
                        
                    
                    <td ><a href="{{route('servico.show', $s->id )}}" class="btn btn-info btn-sm">Info</a></td>
                </tr>
            @endforeach

        </tbody>

        </table>
    </div>

    <div class="card-footer">
        {{$servico->links()}}
       <a class="btn btn-success btn-sm" href="{{route('servico.create')}}">Cadastrar</a>
    </div>

@endsection('conteudo')