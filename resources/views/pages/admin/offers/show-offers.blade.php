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
                                <h5 class="card-title">Visualizar Oferta</h5>
                                <p class="card-text">
                                    Listas de ofertas cadastradas.
                                </p>
                            </div>
                            <div class="btn-area">
                                <a href="{{ route('admin.dashboard.offers.create') }}" title="Cadastrar" class="btn btn-success">
                                    Cadastrar &nbsp; <i class="fa-solid fa-plus"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    @if(count($offers) < 1)
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
                                    <th scope="col">Produto</th>
                                    <th scope="col">Quantidade</th>
                                    <th scope="col">End. Coleta</th>
                                    <th scope="col">End. Entrega</th>
                                    <th scope="col">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($offers as $offer)
                                    <tr>
                                        <td scope="row">{{ $offer['product'] }}</td>
                                        <td>{{ $offer['qtd'] }}</td>
                                        <td>{{ $offer['collect_address'] }}</td>
                                        <td>{{ $offer['delivery_address'] }}</td>
                                        <td>
                                            @if($offer['status'] == 1)
                                                <button type="button" class="btn btn-primary">Em aberto</button>
                                            @else 
                                                <button type="button" class="btn btn-warning">Encerrado</button>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="btn-area">
                                                <a href="{{ url('/dashboard/apagar-oferta/delete').'/'.$offer['id'] }}" class="btn btn-danger"><i class="fa-solid fa-trash-can"></i></a>
                                                <a href="{{ url('/dashboard/editar-oferta')."/".$offer['id'] }}" class="btn btn-info"><i class="fa-solid fa-pen"></i></a>
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