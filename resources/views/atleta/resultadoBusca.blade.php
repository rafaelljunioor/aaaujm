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
            <h5 class="card-title text-left">Resultado das buscas " {{$nome}} "</h5>
        </div>
    </div>

    <div class="card-body">
        <table class="table table-condensed table-striped table-hover table-responsive-sm table-responsive-md ">

            <tr>
                <th>Id Atleta</th>
                <th>Nome</th>
                <th>Matricula</th>
                <th>Telefone</th>
                <th>Curso</th>
                <th>Email</th>
                <th>Tamanho Uniforme</th>
                <th>Altura(m)</th>
                <th>Peso (Kg)</th>
                <th>Info</th>
               
            </tr>

            @foreach($pessoa as $p)
                @if(isset($p->atleta))
                        <tr>
                            
                            <td>{{ $p->atleta->id }}</td>
                            <td>{{ $p->nome}}</td>
                            <td>{{ $p->matricula}}</td>
                            <td>{{ $p->telefone}}</td>
                            <td>{{ $p->curso->nome}}</td>
                            <td>{{ $p->email }}</td>
                            <td>{{ $p->atleta->tamanho_uniforme}}</td>
                            <td>{{ $p->atleta->altura}}</td>
                            <td>{{ $p->atleta->peso}} </td>
                            <td ><a class="btn btn-info btn-sm" href="{{route('atleta.show', $p->atleta->id)}}">Info</a></td>

                        </tr>
                    @endif
            @endforeach

        </table>
    </div>

    <div class="card-footer">
        
        <a class="btn btn-danger btn-sm" href="{{route('atleta.index')}}">Cancelar</a>

    </div>

@endsection('conteudo')