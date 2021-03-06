@extends('layout.adm.app')

@section('conteudo')
<!--<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">-->
            <div class="card-header">
                <div class="card-title"> 
                    <h1>Cadastrar Usuário</h1>
                </div>
             </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('user.store') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">Nome</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="invalid-feedback" role="alert">
                                        {{ $errors->first('name') }}
                                    </span>
                                @endif
                            </div>
                        </div>
                         <div class="form-group row">
                            <label for="type" class="col-md-4 col-form-label text-md-right">Tipo do Usuário</label>

                            <div class="col-md-6">
                                <select class="form-control {{$errors->has('type') ? 'is-invalid' : ''}}"   id="types" 
                                        name="type">
                                         <option  value="">Selecione</option>
                                         <option  value="1">Administrador</option>
                                         <option  value="2">Usuário Loja</option>
                                         <option  value="3">Usuário Esportivo</option>
                                         <option  value="4">Usuário</option>
                                       
                                </select>

                                @if ($errors->has('type'))
                                    <span class="invalid-feedback" role="alert">
                                        {{ $errors->first('type') }}
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">Email</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        {{ $errors->first('email') }}
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">Senha</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        {{ $errors->first('password') }}
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Confirmar Senha</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                   Registrar
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
      <!--  </div>
    </div>
</div>-->
@endsection
