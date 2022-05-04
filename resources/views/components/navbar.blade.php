<nav class="navbar navbar-light bg-dark">
    <div class="container-fluid">
        <div class="navbar-wrapper">
            <span class="navbar-brand span-navbar">Sistema de Embarcadores</span>
            <div class="navbar-items">
                @can('is_authenticated')
                    @can('is_admin')
                        <span class="btn btn-info admin-top">
                            Administrador
                        </span>
                    @endcan
                @endcan
                @can('is_authenticated')
                    <a href="{{ route('admin.logout') }}" title="Sair" class="btn btn-light">
                        <i class="fa-solid fa-door-open"></i>
                    </a>
                @endcan
            </div>
        </div>
    </div>
</nav>