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
                                <h5 class="card-title">Visualizar ofertas vencedoras</h5>
                                <p class="card-text">
                                    veja a lista de ofertas.
                                </p>
                            </div>
                        </div>
                    </div>
                    @if(count($offers) < 1)
                        <div class="card mt-5 mb-5">
                            <div class="card-body">
                                <p class="card-text text-center">
                                    Nenhum alance ainda.
                                </p>
                            </div>
                        </div>
                    @else
                        <section class="list-offers-wrapper" style="{{ count($offers) > 3 ? 'justify-content: space-between; gap: 10px;' : 'justify-content: initial; gap: 15px;'}}">
                            @foreach ($offers as $offer)
                                <div class="card" style="width: 18rem; position: relative;">
                                    <i class="fa-solid fa-crown" style="position: absolute; right: 10px; top: 10px;"></i>
                                    <div class="card-body mt-4">
                                        <h5 class="card-title">{{$offer->getBids()->first()->product}}</h5>
                                        <div class="card-text">
                                            <p>
                                                <strong>Origem:</strong> {{$offer->getBids()->first()->collect_address}}
                                            </p>
                                            <p>
                                                <strong>Destino:</strong> {{ $offer->getBids()->first()->delivery_address }}
                                            </p>
                                        </div>
                                    </div>
                                </div>
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