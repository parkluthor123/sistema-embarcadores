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
                <div class="register-admin" style="max-width: 992px;">
                    <div class="card mt-5">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <div class="card-wrapper">
                                <h5 class="card-title">Visualizar Embarcadoras</h5>
                                <p class="card-text">
                                    Listas de embarcadoras disponíveis para afiliação.
                                </p>
                            </div>
                        </div>
                    </div>
                    @if(count($shippers) < 1)
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
                                @foreach ($shippers as $shipper)
                                    <tr>
                                        <td scope="row">{{ $shipper['name'] }}</td>
                                        <td>{{ $shipper['cnpj'] }}</td>
                                        <td>{{ $shipper['address'] }}</td>
                                        <td>
                                            <div class="btn-area">
                                                @if($shipper->shipperAffiliate()->where('companys_id', $userId)->first())
                                                    <a href="{{ url('/dashboard/embarcadoras/afiliar/delete').'/'.$shipper['id'] }}" class="btn btn-danger">Desfazer afiliação</a>
                                                @else
                                                    <a href="{{ url('/dashboard/embarcadoras/afiliar')."/".$shipper['id'] }}" class="btn btn-primary">Afiliar-se</a>
                                                @endif
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