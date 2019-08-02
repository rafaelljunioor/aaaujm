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
            <h1>Atletas</h1>
            <h5 class="card-title text-left">{{$atleta->count()}} modalidades de {{$atleta->total()}} ({{$atleta->firstItem()}} a {{$atleta->lastItem()}})  </h5>
        </div>
    </div>

    <div class="card-body">
        <form method="post" action="{{route('buscaAtletas')}}">

                @csrf
                @method('GET')
                <div class="form-group" ">
                
                    <!--<label for="inputtelefone">Matricula</label>-->
                    <div class="input-group mb-3">
                        <input  type="text" 
                                class="form-control" 
                                id="inputmatricula" 
                                name="nome" 
                                placeholder="Pesquisar por nome" 
                                aria-label="Recipient's username" 
                                aria-describedby="basic-addon2">
                        
                         <div class="input-group-append">
                                <button class="btn btn-outline-secondary " 
                             
                                        type="submit">
                                        Pesquisar
                                </button>
                        </div>

                    </div>
                    
              </div>

        </form>

        <table class="table table-condensed table-striped table-hover table-responsive-sm table-responsive-md ">
        
            <tr>
                <th>Id Atleta</th>
                <th>Nome</th>
                <th>Matrícula</th>
                <th>Telefone</th>
                <th>Curso</th>
                <th>Email</th>
                <th>Tamanho Uniforme</th>
                <th>Altura(m)</th>
                <th>Peso (Kg)</th>
                <th>Info</th>
               
            </tr>

            @foreach($atleta as $a)
            
                <tr>
                    <td>{{ $a->id }}</td>
                    <td>{{ $a->pessoa->nome}}</td>
                    <td>{{ $a->pessoa->matricula}}</td>
                    <td>{{ $a->pessoa->telefone}}</td>
                    <td>{{ $a->pessoa->curso->nome}}</td>
                    <td>{{ $a->pessoa->email }}</td>
                    <td>{{ $a->tamanho->nome}}</td>
                    <td>{{ $a->altura}}</td>
                    <td>{{ $a->peso}} </td>


                   <!--<td>Competicoes
                            /*@if(isset($a->competicoes)){

                                <ul>
                                    @foreach($a->competicoes as $c)

                                        <li>{{$c->local}}</li>
                                        <li>{{$c->nome}}</li>
                                    @endforeach
                                </ul>
                            @endif*/
                        }
                    </td>-->

                    <td ><a class="btn btn-info btn-sm" href="{{route('atleta.show', $a->id)}}">Info</a></td>
                </tr>
            @endforeach

        </table>
    </div>

    <div class="card-footer">
        {{$atleta->links()}}
        <a class="btn btn-success btn-sm" href="{{route('atleta.create')}}">Cadastrar</a>
        <a class="btn btn-danger btn-sm" href="{{route('relatorioAtletas')}}">PDF</a>

    </div>

@endsection('conteudo')