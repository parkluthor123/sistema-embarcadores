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
                <div class="register-admin" style="max-width: none;">
                    <div class="card mt-5">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <div class="card-wrapper">
                                <h5 class="card-title">Visualizar ofertas disponíveis</h5>
                                <p class="card-text">
                                    veja a lista de ofertas disponíveis.
                                </p>
                            </div>
                        </div>
                    </div>
                    @if(count($offers) < 1)
                        <div class="card mt-5 mb-5">
                            <div class="card-body">
                                <p class="card-text text-center">
                                    Nenhum afiliado ainda.
                                </p>
                            </div>
                        </div>
                    @else
                        <section class="list-offers-wrapper" style="{{ count($offers) > 3 ? 'justify-content: space-between; gap: 10px;' : 'justify-content: initial; gap: 15px;'}}">
                            @foreach ($offers as $offer)
                                @if($offer['qtd'] != 0)
                                    <div class="card" style="width: 18rem;">
                                        <div class="card-body">
                                            <h5 class="card-title">{{$offer['product']}}</h5>
                                            <h6 class="card-subtitle mb-3 mt-3 text-muted">Quantidade: {{$offer['qtd']}}</h6>
                                            <div class="card-text">
                                                <p>
                                                    <strong>Origem:</strong> {{$offer['collect_address']}}
                                                </p>
                                                <p>
                                                    <strong>Destino:</strong> {{$offer['delivery_address']}}
                                                </p>
                                            </div>
                                            @if(is_null($offer->getBid()->where('companys_id', $user->companys_id)->first()))
                                                <a href="{{ url('/dashboard/adicionar-lance').'/'.$offer['id'] }}" class="card-link">Dar lance</a>
                                            @else
                                                <span style="color: #ccc; font-weight: bold;">Lance efetuado anteriormente.</span>
                                            @endif
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </section>
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