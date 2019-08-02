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
            <h1 class="card-title">Competições</h1>
            <h5 class="card-title text-left">{{$competicao->count()}} modalidades de {{$competicao->total()}} ({{$competicao->firstItem()}} a {{$competicao->lastItem()}})  </h5>
        </div>
    </div>

    <div class="card-body">
        <table class="table table-condensed table-hover table-striped table-responsive-sm table-responsive-md">

            <thead>
                <tr>
                    <th>Id da competição</th>
                    <th>Nome</th>
                    <th>local</th>
                    <th>Data Inicio</th>
                    <th>Data Término</th>
                    <th>Info</th>
                </tr>
            </thead>

            <tbody>

            @foreach($competicao as $c)
            
                <tr>
                    <td>{{$c->id}}</td>
                    <td>{{$c->nome}}</td>
                    <td>{{$c->local}}</td>
                    <td>{{ date( 'd/m/Y' , strtotime($c->data_inicio))}}</td>
                    <td>{{ date( 'd/m/Y' , strtotime($c->data_termino))}}</td>
                    <td ><a href="{{route('competicao.show', $c->id)}}" class="btn btn-info btn-sm">Info</a></td>
                </tr>
            @endforeach

        </tbody>

        </table>
    </div>

    <div class="card-footer">
        {{$competicao->links()}}
       <a class="btn btn-success btn-sm" href="{{route('competicao.create')}}">Cadastrar</a>
    </div>

@endsection('conteudo')