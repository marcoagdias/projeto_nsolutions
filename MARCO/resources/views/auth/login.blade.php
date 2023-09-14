@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('authenticate') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="cpf" class="col-md-4 col-form-label text-md-right">{{ __('CPF') }}</label>

                            <div class="col-md-6">
                                <input id="cpf" type="text" class="input-espacado form-control @error('cpf') is-invalid @enderror" name="cpf" value="{{ old('cpf') }}" required autocomplete="cpf" autofocus>

                                @error('cpf')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="input-espacado form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>
                                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#createModal">
                                    {{ __('Cadastrar') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal Create -->
<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="createModalLabel">Criar Novo Usuário</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="{{ route('users.store') }}" method="POST">
        @csrf
        <div class="modal-body">
          <div class="mb-3">
            <label for="nome_completo" class="form-label">Nome Completo</label>
            <input type="text" class="form-control" id="nome_completo" name="nome_completo" required>
          </div>
          <div class="mb-3">
            <label for="cpf" class="form-label">CPF</label>
            <input type="text" name="cpf" id="cpf_create" class="form-control" required>
            <div class="error-message" id="cpf-error-message-login"></div>
          </div>
          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" id="email_create" class="form-control" required>
            <div class="error-message" id="email-error-message-login"></div>
          </div>
          <div class="mb-3">
            <label for="telefone" class="form-label">Telefone</label>
            <input type="text" class="form-control" id="telefone" name="telefone" required>
          </div>
          <div class="mb-3">
            <label for="cep" class="form-label">CEP</label>
            <input type="text" class="form-control" id="cep" name="cep" required>
          </div>
          <div class="mb-3">
            <label for="endereco" class="form-label">Endereço</label>
            <input type="text" class="form-control" id="endereco" name="endereco" required>
          </div>
          <div class="mb-3">
            <label for="numero_casa" class="form-label">Número</label>
            <input type="text" class="form-control" id="numero_casa" name="numero_casa" required>
          </div>
          <div class="mb-3">
            <label for="complemento" class="form-label">Complemento</label>
            <input type="text" class="form-control" id="complemento" name="complemento" required>
          </div>
          <div class="mb-3">
            <label for="bairro" class="form-label">Bairro</label>
            <input type="text" class="form-control" id="bairro" name="bairro" required>
          </div>
          <div class="mb-3">
            <label for="cidade" class="form-label">Cidade</label>
            <input type="text" class="form-control" id="cidade" name="cidade" required>
          </div>
          <div class="mb-3">
            <label for="estado" class="form-label">Estado</label>
            <input type="text" class="form-control" id="estado" name="estado" required>
          </div>
          <div class="mb-3">
            <label for="data_nascimento" class="form-label">Data de Nascimento</label>
            <input type="date" class="form-control" id="data_nascimento" name="data_nascimento" required>
          </div>
          <div class="mb-3">
            <label for="senha" class="form-label">Senha</label>
            <input type="password" class="form-control" id="senha" name="senha" required>
          </div>
          <div class="mb-3">
            <label for="status_usuario" class="form-label">Status</label>
            <select class="form-control" id="status_usuario" name="status_usuario" required>
                <option value="ativo" selected>Ativo</option>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Voltar</button>
          <button type="submit" class="btn btn-primary salvaruserbtn">Salvar</button>
        </div>
      </form>
    </div>
  </div>
</div>

@push('scripts')
<script>
    $(document).ready(function(){
      $(document).on('click', '.salvaruserbtn', function(e) {

      var cpf = $('#cpf_create').val();
      var email = $('#email_create').val();

        if (!validarCPF(cpf)) {
          // Se o e-mail não for válido, mostre uma mensagem de erro e pare aqui
          $('#cpf-error-message-login').text('Por favor, insira um CPF válido.');
          e.preventDefault();
          return;
        }

        if (!validarEmail(email)) {
          // Se o e-mail não for válido, mostre uma mensagem de erro e pare aqui
          $('#email-error-message-login').text('Por favor, insira um endereço de e-mail válido.');
          e.preventDefault();
          return;
        }
        
      });

      var emailInputCreate = document.getElementById('email_create');
      var errorMessageEmailCreate = document.getElementById('email-error-message-login');

      emailInputCreate.addEventListener('input', function() {
        if (validarEmail(emailInputCreate.value)) {
            emailInputCreate.classList.remove('invalid');
            emailInputCreate.classList.add('valid');
            errorMessageEmailCreate.textContent = '';
        } else {
            emailInputCreate.classList.remove('valid');
            emailInputCreate.classList.add('invalid');
            errorMessageEmailCreate.textContent = 'Por favor, insira um endereço de e-mail válido.';
        }
      });

      var cpfInputCreate = document.getElementById('cpf_create');
      var errorMessageCpfCreate = document.getElementById('cpf-error-message-login');

      cpfInputCreate.addEventListener('input', function() {
        if (validarCPF(cpfInputCreate.value)) {
            cpfInputCreate.classList.remove('invalid');
            cpfInputCreate.classList.add('valid');
            errorMessageCpfCreate.textContent = '';
        } else {
            cpfInputCreate.classList.remove('valid');
            cpfInputCreate.classList.add('invalid');
            errorMessageCpfCreate.textContent = 'Por favor, insira um CPF válido.';
        }
      });

    });

    function validarEmail(email) {
      var re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      return re.test(email);
    }

    function validarCPF(cpf) {
      if (typeof cpf !== "string") return false;

      cpf = cpf.replace(/[\s.-]*/gim, "");
      
      if (
          !cpf ||
          cpf.length != 11 ||
          cpf == "00000000000" ||
          cpf == "11111111111" ||
          cpf == "22222222222" ||
          cpf == "33333333333" ||
          cpf == "44444444444" ||
          cpf == "55555555555" ||
          cpf == "66666666666" ||
          cpf == "77777777777" ||
          cpf == "88888888888" ||
          cpf == "99999999999"
      )return false;

      var soma = 0;
      var resto;

      for (var i = 1; i <= 9; i++)
          soma = soma + parseInt(cpf.substring(i - 1, i)) * (11 - i);
          resto = (soma * 10) % 11;

      if (resto == 10 || resto == 11) resto = 0;

      if (resto != parseInt(cpf.substring(9, 10))) return false;
          soma = 0;

      for (var i = 1; i <= 10; i++)
          soma = soma + parseInt(cpf.substring(i - 1, i)) * (12 - i);
          resto = (soma * 10) % 11;

      if (resto == 10 || resto == 11) resto = 0;

      if (resto != parseInt(cpf.substring(10, 11))) return false;
      return true;
    }

</script>
@endpush
@endsection