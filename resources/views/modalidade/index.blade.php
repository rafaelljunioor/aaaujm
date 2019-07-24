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
            <h1 class="card-title">Modalidades</h1>
            <h5 class="card-title text-left">{{$modalidade->count()}} modalidades de {{$modalidade->total()}} ({{$modalidade->firstItem()}} a {{$modalidade->lastItem()}})  </h5>
        </div>
    </div>

    <div class="card-body">
        <div class="table-responsive-lg">

            <table class="table table-condensed table-hover table-striped table-responsive-sm table-responsive-md">

                <thead>
                    <tr>
                        <th>Id da modalidade</th>
                        <th>Nome</th>
                        <th>Genero</th>
                        <th>Info</th>
                    </tr>
                </thead>

                <tbody>

                @foreach($modalidade as $m)
                
                    <tr>
                        <td>{{$m->id}}</td>
                        <td>{{$m->nome}}</td>
                        <td>{{$m->genero}}</td>
              
                        <td ><a href="{{route('modalidade.show', $m->id)}}" class="btn btn-info btn-sm">Info</a></td>
                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>
    </div>

    <div class="card-footer">
       {{$modalidade->links()}}

    <a class="btn btn-success btn-sm" href="{{route('modalidade.create')}}">Cadastrar</a>
    </div>



   
@endsection('conteudo')