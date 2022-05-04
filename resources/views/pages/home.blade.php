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
    <div class="entry-area">
        <section class="heading-register">
            <div class="heading-register-text">
                <span>Ainda não possui uma conta?</span>
            </div>
            <div class="btn-area">
                <a href="{{ route('register.account') }}" class="btn btn-primary">Criar uma conta</a>
            </div>
        </section>
        <section class="entry-box-area">
            <div class="content-area">
                <span>Entrar</span>
                <p>Utilize suas credenciais abaixo:</p>
                <form action="{{ route('admin.doLogin') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="email" class="form-label">E-mail</label>
                        <input type="text" name="email" placeholder="Digite seu e-mail" id="email" class="form-control">
                    </div>
                    <br/>
                    <div class="form-group">
                        <label for="senha" class="form-label">Senha</label>
                        <input type="password" name="password" placeholder="Digite sua senha" id="senha" class="form-control">
                    </div>  
                    <div class="btn-area">
                        <button type="submit" class="btn btn-light">Entrar</button>
                    </div>
                </form>
            </div>
        </section>
    </div>
@endsection