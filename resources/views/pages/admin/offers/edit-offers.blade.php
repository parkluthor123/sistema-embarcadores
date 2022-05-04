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
                            <h5 class="card-title">Editar Oferta</h5>
                            <p class="card-text">
                                Edite as ofertas preenchendo os campos abaixo.
                            </p>
                        </div>
                    </div>
                    <form action="{{ url('/dashboard/editar-oferta/editar').'/'.$offers['id'] }}" method="post">
                        @csrf
                        <div class="form-group mt-2">
                            <label for="produto" class="form-label">Produto</label>
                            <input type="text" value="{{ $offers['product'] }}" placeholder="Digite o produto" name="produto" id="produto" class="form-control">
                        </div>
                        <div class="form-group mt-2">
                            <label for="qtd" class="form-label">Quantidade</label>
                            <input type="number" value="{{ $offers['qtd'] }}" placeholder="Digite a quantidade do produto" name="qtd" id="qtd" class="form-control">
                        </div>
                        <div class="form-group mt-2">
                            <label for="end_coleta" class="form-label">Endereço de coleta</label>
                            <input type="text" value="{{ $offers['collect_address'] }}" placeholder="Endereço de coleta" name="end_coleta" id="end_coleta" class="form-control">
                        </div>
                        <div class="form-group mt-2">
                            <label for="end_entrega" class="form-label">Endereço de entrega</label>
                            <input type="text" value="{{ $offers['delivery_address'] }}" placeholder="Endereço de entrega" name="end_entrega" id="end_entrega" class="form-control">
                        </div>
                        <div class="form-group d-flex justify-content-between mt-5">
                            <a href="{{ route('admin.dashboard.offers.show') }}" title="Voltar" class="btn btn-primary">
                                Voltar
                            </a>
                            <button type="submit" title="Salvar" class="btn btn-success">
                                Salvar
                            </button>
                        </div>
                    </form>
               </div>
            </div>
        </div>
    </div>
@endsection