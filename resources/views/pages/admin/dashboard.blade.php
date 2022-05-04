@extends('layouts.site')
@section('content')
    <section class="dashboard-area">
        <div class="container-fluid">
            <div class="container-custom">
                <div class="dashboard-wrapper">
                    <div class="dashboard-heading" data-role="{{ $role == "embarcadora" ? "Embarcadora: $company->name" : "Transportadora: $company->name"}}">
                        <h2>Bem vindo {{ $name }}</h2>
                        <p>Você pode cadastrar novos membros agora.</p>
                    </div>
                    <div class="dashboard-content">
                        @can('is_admin')
                            <div class="dashboard-items">
                                <span>Cadastre novos funcionários</span>
                                <div class="btn-area">
                                    <a href="{{ route('admin.dashboard.employees.show') }}" class="btn btn-light">Ver funcionários &nbsp; <i class="fa-solid fa-users"></i></a>
                                </div>
                            </div>
                        @endcan
                        @can('embarcadora')
                            <div class="dashboard-items">
                                <span>Veja suas ofertas cadastradas.</span>
                                <div class="btn-area">
                                    <a href="{{ route('admin.dashboard.offers.show') }}" class="btn btn-light">Ver ofertas &nbsp; <i class="fa-solid fa-truck-fast"></i></a>
                                </div>
                            </div>
                        @endcan
                    </div>
                    <div class="dashboard-content">
                        @can('embarcadora')
                            <div class="dashboard-items">
                                <span>Veja seus afiliados.</span>
                                <div class="btn-area">
                                    <a href="{{ route('admin.dashboard.affiliates') }}" class="btn btn-light">Ver afiliados &nbsp; <i class="fa-solid fa-hand-holding-hand"></i></a>
                                </div>
                            </div>
                        @endcan
                        @can('embarcadora')
                            <div class="dashboard-items">
                                <span>Veja os lances sobre as ofertas.</span>
                                <div class="btn-area">
                                    <a href="{{ route('admin.dashboard.bid.show') }}" class="btn btn-light">Ver lances &nbsp; <i class="fa-solid fa-money-bill-transfer"></i></a>
                                </div>
                            </div>
                        @endcan
                        @can('transportadora')
                            <div class="dashboard-items">
                                <span>Conheça nossas embarcadoras.</span>
                                <div class="btn-area">
                                    <a href="{{ route('admin.dashboard.shipper.show') }}" class="btn btn-light">Ver Embarcadoras &nbsp; <i class="fa-solid fa-hand-holding-hand"></i></a>
                                </div>
                            </div>
                        @endcan
                        @can('transportadora')
                            <div class="dashboard-items">
                                <span>Veja as ofertas de suas embarcadoras afiliadas</span>
                                <div class="btn-area">
                                    <a href="{{ route('admin.dashboard.shipper.see-offers') }}" class="btn btn-light">Ver Ofertas &nbsp; <i class="fa-solid fa-truck-fast"></i></a>
                                </div>
                            </div>
                        @endcan
                        @can('transportadora')
                            <div class="dashboard-items">
                                <span>Veja suas ofertas</span>
                                <div class="btn-area">
                                    <a href="{{ route('admin.dashboard.shipper.winnerOffers') }}" class="btn btn-light">Minhas Ofertas &nbsp; <i class="fa-solid fa-crown"></i></a>
                                </div>
                            </div>
                        @endcan
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection