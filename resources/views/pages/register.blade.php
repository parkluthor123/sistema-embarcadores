@extends('layouts.site')
@section('content')
    <div class="register-area">
        <div class="container-custom">
            <div class="card mt-5">
                <div class="card-body">
                  <h5 class="card-title">Cadastrar</h5>
                  <p class="card-text">
                      Cadastre sua empresa preenchendo os campos abaixo.
                  </p>
                </div>
              </div>
            <div class="register-wrapper">
                <div class="container-custom">
                    <div class="form-register">
                        <form action="{{ route('register.account.do') }}" method="POST">
                            @csrf
                            <div class="form-group mt-2">
                                <label for="name" class="form-label">Nome da empresa</label>
                                <input type="text" placeholder="Digite o nome da empresa" name="name" id="name" class="form-control" required>
                            </div>
                            <div class="form-group mt-2">
                                <label for="cnpj" class="form-label">CNPJ</label>
                                <input type="text" placeholder="Digite seu CNPJ" name="cnpj" id="cnpj" class="form-control" required>
                            </div>
                            <div class="form-group mt-2">
                                <label for="address" class="form-label">Endereço</label>
                                <input type="text" placeholder="Digite seu Endereço" name="address" id="address" class="form-control" required>
                            </div>
                            <div class="form-group mt-2">
                                <label for="address" class="form-label">Minha empresa é:</label>
                                <select name="role" id="role" class="form-select" required>
                                    <option value="embarcadora">Embarcadora</option>
                                    <option value="transportadora">Transportadora</option>
                                </select>
                            </div>
                            <br/>
                            <hr>
                            <br/>
                            <p style="text-align: center; font-weight: bold;">Crie um novo usuario</p>
                            <div class="create-user-area">
                                <div class="form-group mt-2">
                                    <label for="username" class="form-label">Nome</label>
                                    <input type="text" name="username" id="username" placeholder="Digite seu nome" class="form-control" required>
                                </div>
                                <div class="form-group mt-2">
                                    <label for="email" class="form-label">E-mail</label>
                                    <input type="email" name="email" id="email" placeholder="Digite um email" class="form-control" required>
                                </div>
                                <div class="form-group mt-2">
                                    <label for="email" class="form-label">Crie uma senha</label>
                                    <input type="password" name="password" id="password" placeholder="Crie uma nova senha" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group d-flex justify-content-between mt-5">
                                <a href="{{ url('/') }}" title="Voltar" class="btn btn-primary">
                                    Voltar
                                </a>
                                <button type="submit" title="Cadastrar" class="btn btn-success">
                                    Cadastrar
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        const cnpj = document.querySelector("#cnpj")
        cnpj.maxLength = 17;
        cnpj.addEventListener("keyup", function(){
            cnpj.value = formatMask(cnpj.value, "CNPJ")
        })
    </script>
@endsection