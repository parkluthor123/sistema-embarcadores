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
               <div class="register-admin"  style="max-width: 992px;">
                    <div class="card mt-5">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <div class="card-wrapper">
                                <h5 class="card-title">Visualizar Lances</h5>
                                <p class="card-text">
                                    Listas de lances sobre as ofertas cadastradas.
                                </p>
                            </div>
                        </div>
                    </div>
                    @if(count($bids) < 1)
                        <div class="card mt-5 mb-5">
                            <div class="card-body">
                                <p class="card-text text-center">
                                    Nenhum lance disponível.
                                </p>
                            </div>
                        </div>
                    @else
                        <section class="list-offers-wrapper" style="{{ count($bids) > 3 ? 'justify-content: space-between; gap: 10px;' : 'justify-content: initial; gap: 15px;'}}">
                            @foreach($bids as $bid)
                                @if(is_null($bid->getWinner()->first()))
                                    <div class="card" style="width: 18rem;">
                                        <div class="card-body">
                                            <h5 class="card-title">{{$bid->getBids()->first()->product}}</h5>
                                            <h6 class="card-subtitle mb-3 mt-3 text-muted">Transportadora: {{$bid->getCompany()->first()->name}}</h6>
                                            <div class="card-text">
                                                <p>
                                                    <strong>Valor:</strong> R$ {{$bid['value']}}
                                                </p>
                                                <p>
                                                    <strong>Volume da transportadora:</strong> {{$bid['volume']}}
                                                </p>
                                                <p>
                                                    <strong>Quantidade:</strong> {{$bid->getBids()->first()->qtd}}
                                                </p>
                                            </div>
                                            <a href="{{ url('/dashboard/lances/definir-vencedor').'/'.$bid['id'] }}" class="btn btn-info">Definir vencedor</a>
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