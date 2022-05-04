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
                            <h5 class="card-title">Editar Funcionário</h5>
                            <p class="card-text">
                                Edite um funcionário existente preenchendo os campos abaixo.
                            </p>
                        </div>
                    </div>
                    <form action="{{ url('/dashboard/editar-funcionarios/editar').'/'.$employees['id'] }}" method="post">
                        @csrf
                        <div class="form-group mt-2">
                            <label for="name" class="form-label">Nome do funcionário</label>
                            <input type="text" value="{{ $employees['name'] }}" placeholder="Digite o nome do funcionário" name="name" id="name" class="form-control">
                        </div>
                        <div class="form-group mt-2">
                            <label for="email" class="form-label">E-mail</label>
                            <input type="text" value="{{ $employees['email'] }}" placeholder="Digite o E-mail" name="email" id="email" class="form-control">
                        </div>
                        <div class="form-group mt-2">
                            <label for="password" class="form-label">Senha:</label>
                            <input type="password" placeholder="Digite a senha" name="password" id="password" class="form-control">
                            <small style="color: #b22;">*Caso não queira editar a senha, deixe em branco</small>
                        </div>
                        <div class="form-group d-flex justify-content-between mt-5">
                            <a href="{{ route('admin.dashboard.employees.show') }}" title="Voltar" class="btn btn-primary">
                                Voltar
                            </a>
                            <button type="submit" title="Cadastrar" class="btn btn-success">
                                Salvar
                            </button>
                        </div>
                    </form>
            </div>
            </div>
        </div>
    </div>
@endsection