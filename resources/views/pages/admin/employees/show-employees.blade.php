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
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <div class="card-wrapper">
                                <h5 class="card-title">Visualizar Funcionários</h5>
                                <p class="card-text">
                                    Listas de funcionários cadastradas.
                                </p>
                            </div>
                            <div class="btn-area">
                                <a href="{{ route('admin.dashboard.employees.create') }}" title="Cadastrar" class="btn btn-success">
                                    Cadastrar &nbsp; <i class="fa-solid fa-plus"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    @if(count($employees) < 1)
                        <div class="card mt-5 mb-5">
                            <div class="card-body">
                                <p class="card-text text-center">
                                    Nenhuma oferta cadastrada.
                                </p>
                            </div>
                        </div>
                    @else
                        <table class="table mt-5">
                            <thead>
                                <tr>
                                    <th scope="col">Nome</th>
                                    <th scope="col">E-mail</th>
                                    <th scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($employees as $employee)
                                    <tr>
                                        <td scope="row">{{ $employee['name'] }}</td>
                                        <td>{{ $employee['email'] }}</td>
                                        <td>
                                            @if($employee['is_admin'] == 1)
                                                <span class="btn btn-warning">Admin</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-area">
                                                @if($employee['is_admin'] != 1)
                                                    <a href="{{ url('/dashboard/apagar-funcionarios/delete').'/'.$employee['id'] }}" class="btn btn-danger"><i class="fa-solid fa-trash-can"></i></a>
                                                @endif
                                                <a href="{{ url('/dashboard/editar-funcionarios/')."/".$employee['id'] }}" class="btn btn-info"><i class="fa-solid fa-pen"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif
                    <div class="form-group d-flex justify-content-between mt-5">
                        <a href="{{ url('/dashboard') }}" title="Voltar" class="btn btn-primary">
                            Voltar
                        </a>
                    </div>
               </div>
            </div>
        </div>
    </div>

@endsection