@extends('layout.adm.app')

@section('conteudo')


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
                <th>Info</th>
               
            </tr>

            @foreach($pessoa as $p)
                @if(isset($p->associado))
                        <tr>
                            
                            <td>{{ $p->associado->id }}</td>
                            <td>{{ $p->nome}}</td>
                            <td>{{ $p->matricula}}</td>
                            <td>{{ $p->telefone}}</td>
                            <td>{{ $p->curso->nome}}</td>
                            <td>{{ $p->email }}</td>
                            
                            <td ><a class="btn btn-info btn-sm" href="{{route('associado.show', $p->associado->id)}}">Info</a></td>

                        </tr>
                    @endif
            @endforeach

        </table>
    </div>

    <div class="card-footer">
        
        <a class="btn btn-danger btn-sm" href="{{route('associado.index')}}">Cancelar</a>

    </div>
</div>
@endsection('conteudo')