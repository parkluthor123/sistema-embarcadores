@extends('layouts.site')
@section('content')
    @if($success = Session::get('success'))
        <div class="alert alert-success" role="alert">
            {{ $success }}
        </div>
    @endif
    @if($error = Session::get('error'))
        <div class="alert alert-danger" role="alert">
            {{ $error }}
        </div>
    @endif
    <div class="register-admin-area">
        <div class="container-fluid">
            <div class="container-custom">
            <div class="register-admin">
                    <div class="card mt-5">
                        <div class="card-body">
                            <h5 class="card-title">Cadastrar Funcionário</h5>
                            <p class="card-text">
                                Cadastre um novo funcionário preenchendo os campos abaixo.
                            </p>
                        </div>
                    </div>
                    <form action="{{ route('admin.dashboard.employees.store') }}" method="post">
                        @csrf
                        <div class="form-group mt-2">
                            <label for="name" class="form-label">Nome do funcionário</label>
                            <input type="text" placeholder="Digite o nome do funcionário" name="name" id="name" class="form-control">
                        </div>
                        <div class="form-group mt-2">
                            <label for="email" class="form-label">E-mail</label>
                            <input type="text" placeholder="Digite o E-mail" name="email" id="email" class="form-control">
                        </div>
                        <div class="form-group mt-2">
                            <label for="password" class="form-label">Senha:</label>
                            <input type="password" placeholder="Digite a senha" name="password" id="password" class="form-control">
                        </div>
                        <div class="form-group d-flex justify-content-between mt-5">
                            <a href="{{ route('admin.dashboard.employees.show') }}" title="Voltar" class="btn btn-primary">
                                Voltar
                            </a>
                            <button type="submit" title="Cadastrar" class="btn btn-success">
                                Cadastrar
                            </button>
                        </div>
                    </form>
            </div>
            </div>
        </div>
    </div>
@endsection