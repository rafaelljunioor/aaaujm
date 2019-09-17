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
            <h1 class="card-title">Fornecedores</h1>
            <h5 class="card-title text-left">{{$fornecedores->count()}} modalidades de {{$fornecedores->total()}} ({{$fornecedores->firstItem()}} a {{$fornecedores->lastItem()}})  </h5>
        </div>
    </div>

    <div class="card-body">
        <table class="table table-condensed table-hover table-striped table-responsive-sm table-responsive-md">

            <thead>
                <tr>
                    <th>Id do Fornecedor</th>
                    <th>Nome</th>
                    <th>CNPJ</th>
                    <th>Email</th>
                    <th>Telefone</th>
                    <th>Descrição</th>
                    <th>Status</th>
                    <th>Info</th>
                </tr>
            </thead>

            <tbody>

            @foreach($fornecedores as $f)
            
                <tr>
                    <td>{{$f->id}}</td>
                    <td>{{$f->nome}}</td>
                    <td>{{$f->cnpj}}</td>
                    <td>{{$f->email}}</td>
                    <td>{{$f->telefone}}</td>
                    <td>{{$f->descricao}}</td>
                    @if($f->deleted_at != NULL)
                        <td class="text text-danger"> Desativado</td>
                    @else
                        <td class="text text-success"> Ativado</td>
                    @endif
                    <td ><a href="{{route('fornecedor.show', $f->id )}}" class="btn btn-info btn-sm">Info</a></td>
                </tr>
            @endforeach

        </tbody>

        </table>
    </div>

    <div class="card-footer">
        {{$fornecedores->links()}}
       <a class="btn btn-success btn-sm" href="{{route('fornecedor.create')}}">Cadastrar</a>
    </div>

@endsection('conteudo')