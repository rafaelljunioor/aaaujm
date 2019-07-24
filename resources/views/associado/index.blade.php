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
                <h1>Associados</h1>
                <h5 class="card-title text-left">{{$associado->count()}} associados de {{$associado->total()}} ({{$associado->firstItem()}} a {{$associado->lastItem()}})  </h5>
            </div>
        </div>

   
<div class="card-body">
    <form method="post" action="{{route('buscaAssociados')}}">

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
    <table class="table table-condensed table-hover table-striped table-responsive-sm table-responsive-md">

        <tr>
            <th>Id do associado</th>
            <th>Nome</th>
            <th>Matricula</th>
            <th>Telefone</th>
            <th>Curso</th>
            <th>Email</th>
            <th>Data Associação</th>
            <th>Data Validade</th>
            <th>Status</th>
            <th>Info</th>
            

        </tr>

        @foreach($associado as $a)
            @if(isset($a->pessoa))
                <tr>
                    <td>{{ $a->id }}</td>
                    <td>{{ $a->pessoa->nome}}</td>
                    <td>{{ $a->pessoa->matricula}}</td>
                    <td>{{ $a->pessoa->telefone}}</td>
                    <td>{{ $a->pessoa->curso->nome}}</td>
                    <td>{{ $a->pessoa->email }}</td>
                    <td>{{ date( 'd/m/Y' , strtotime($a->data_inicio))}}</td>
                    @if($a->data_termino < $now)
                        <td class="text-danger">{{ date( 'd/m/Y' , strtotime($a->data_termino))}}</td>
                    @else
                        <td class="text-success">{{ date( 'd/m/Y' , strtotime($a->data_termino))}}</td>
                    @endif
                    @if($a->deleted_at != NULL)
                        <td class="text text-danger"> Desativado</td>
                    @else
                        <td class="text text-success"> Ativado</td>
                    @endif
                    <td ><a class="btn btn-info btn-sm" href="{{route('associado.show', $a->id)}}">Info</a></td>  
                </tr>
            @endif
        @endforeach

    </table>

</div>

    <div class="card-footer">
         {{$associado->links()}}
        <a class="btn btn-success btn-sm" href="{{route('associado.create')}}">Cadastrar</a>
        <a class="btn btn-danger btn-sm" href="{{route('relatorioAssociados')}}">PDF</a>
    </div>
@endsection('conteudo')