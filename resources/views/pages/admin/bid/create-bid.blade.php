@extends('layouts.site')
@section('content')
    <div class="register-admin-area">
        <div class="container-fluid">
            <div class="container-custom">
                <div class="register-admin" style="max-width: 992px;">
                    <div class="card mt-5">
                        <div class="card-body d-flex justify-content-between align-items-center">
                            <div class="card-wrapper">
                                <h5 class="card-title">Adicionar um lance</h5>
                                <p class="card-text">
                                    Adicione um lance á essa oferta: <strong>{{ $currentOffer['product'] }}</strong>
                                </p>
                            </div>
                        </div>
                    </div>

                    <form action="{{ url('/dashboard/adicionar-lance/cadastrar').'/'.$currentOffer['id'] }}" method="post">
                        @csrf
                        <div class="form-group mt-2">
                            <div class="bid-range-wrapper">
                                <div class="bid-range-items">
                                    <span id="currentValue">0</span>
                                </div>
                                <div class="bid-range-items">
                                    <label for="rangeBid" class="form-label">Volume (quantidade):</label>
                                    <input type="range" step="1" name="rangeBid" class="form-range" id="rangeBid">
                                </div>
                            <div class="bid-range-items">{{ $currentOffer['qtd'] }}</div>
                            </div>
                        </div>
                        <div class="form-group mt-2">
                            <label for="val_bid" class="form-label">Valor:</label>
                            <input type="text" placeholder="Digite o valor do lance" name="val_bid" id="val_bid" class="form-control">
                        </div>
                        <div class="form-group d-flex justify-content-between mt-5">
                            <span></span>
                            <button type="submit" title="Cadastrar" class="btn btn-success">
                                Cadastrar
                            </button>
                        </div>
                    </form>

                    <div class="form-group d-flex justify-content-between mt-5">
                        <a href="{{ url('/dashboard') }}" title="Voltar" class="btn btn-primary">
                            Voltar
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script>
    const currentValue = document.querySelector("#currentValue");
    const range = document.querySelector("#rangeBid");
    range.max = "{{ $currentOffer['qtd'] }}";
    range.value = 0;
    range.addEventListener("change", (e)=>{
        currentValue.innerHTML = e.target.value;
    })
</script>
@endsection