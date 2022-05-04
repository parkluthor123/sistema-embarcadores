@extends('layouts.site')
@section('content') 
    <div class="register-admin-area">
        <div class="container-fluid">
            <div class="container-custom">
            <div class="register-admin" style="max-width: 992px;">
                    <div class="card mt-5">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <div class="card-wrapper">
                                <h5 class="card-title">Visualizar afiliados</h5>
                                <p class="card-text">
                                    Listas de afiliados.
                                </p>
                            </div>
                        </div>
                    </div>
                    @if(count($affiliates) < 1)
                        <div class="card mt-5 mb-5">
                            <div class="card-body">
                                <p class="card-text text-center">
                                    Nenhum afiliado ainda.
                                </p>
                            </div>
                        </div>
                    @else
                        <table class="table mt-5">
                            <thead>
                                <tr>
                                    <th scope="col">Nome</th>
                                    <th scope="col">CNPJ</th>
                                    <th scope="col">Endereço</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($affiliates as $affiliate)
                                    <tr>
                                        <td scope="row">{{ $affiliate['name'] }}</td>
                                        <td>{{ $affiliate['cnpj'] }}</td>
                                        <td>{{ $affiliate['address'] }}</td>
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