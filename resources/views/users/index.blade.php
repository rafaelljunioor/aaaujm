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
                <h1>Usuários</h1>
                <h5 class="card-title text-left">{{$user->count()}} usuários de {{$user->total()}} ({{$user->firstItem()}} a {{$user->lastItem()}})  </h5>
            </div>
        </div>

   
<div class="card-body">
    
    <table class="table table-condensed table-hover table-striped table-responsive-sm table-responsive-md">

        <tr>
            <th>Id do Usuario</th>
            <th>Nome</th>
            <th>Email</th>
            <th>Tipo</th>
            <th>Status</th>
            <th>Ativar/Desativar</th>
            <th>Info</th>
            

        </tr>
        @foreach($user as $u)
            
                <tr>
                    <td>{{ $u->id }}</td>
                    <td>{{ $u->name}}</td>
                    <td>{{ $u->email}}</td>
                    <td>{{ $u->role->nome}}</td>
                    @if($u->deleted_at != NULL)
                        <td class="text text-danger"> Desativado</td>
                    @else
                        <td class="text text-success"> Ativado</td>
                    @endif

                    @if($u->deleted_at == NULL)
                        <td><form method="post" onsubmit="return confirm('Desativar Usuário?');" action="{{ route('user.destroy', $u) }}">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm" type="submit">Desativar</button>
                        </form></td>
                    @else
                       <td> <a class="btn btn-success btn-sm" href="{{ route('user.restore', $u->id) }}">Ativar</a></td>
                    @endif
                    
                    <td ><a class="btn btn-info btn-sm" href="{{ route('user.show', $u->id) }}">Info</a></td>  
                </tr>
        @endforeach

    </table>

</div>

    <div class="card-footer">
         {{$user->links()}}
        <a class="btn btn-success btn-sm"  href="{{ route('user.create') }}">Cadastrar</a>
    </div>
@endsection('conteudo')