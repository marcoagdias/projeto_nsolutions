@extends('layouts.app')

@section('content')
@include('users.modals.view')

@if (Auth::user())
    <div style="position: fixed; top: 10px; right: 10px;">
        <span>Bem-vindo, {{ Auth::user()->nome_completo }}</span>
          <form method="POST" action="{{ route('logout') }}" style="display: inline;">
          @csrf
            <button type="submit" class="btn btn-link p-0 m-0 align-baseline">Logout</button>
          </form>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </div>
@endif

@if(session('status'))
  <div class='alert alert-sucess'>{{ session('status') }}</div>
@endif

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="mb-3">
                <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#createModal">Adicionar Novo Usuário</button>
                <input type="text" id="search" class="form-control d-inline-block" style="width: calc(50% - 60px);" placeholder="Buscar...">
            </div>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>CPF</th>
                        <th>Idade</th>
                        <th>Email</th>
                        <th>Telefone</th>
                        <th>Status</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td>{{ $user->nome_completo }}</td>
                        <td>{{ $user->cpf }}</td>
                        <td>{{ $user->idade }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->telefone }}</td>
                        <td>{{ $user->status_usuario }}</td>
                        <td>
                            <button type="button" value="{{$user->id}}" class="btn btn-info viewbtn btn-sm" data-bs-toggle="modal" data-bs-target="#viewModal">Ver</button>
                            <button type="button" value="{{$user->id}}" class="btn btn-primary editbtn btn-sm" data-bs-toggle="modal" data-bs-target="#editModal">Editar</button>
                            <button type="button" value="{{$user->id}}" class="btn btn-warning deletebtn btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal">Deletar</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            
        </div>
    </div>
</div>

<!-- Modal Edit -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">Editar Usuário</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="editForm" action="{{ route('users.update') }}" method="POST">
        @csrf
        @method('PUT')

        <div class="modal-body">
          <div class="mb-3">
            <label for="nome_completo_edit" class="form-label">Nome Completo</label>
            <input type="text" class="form-control" id="nome_completo_edit" name="nome_completo" required>
          </div>
          <div class="mb-3">
            <label for="cpf_edit" class="form-label">CPF</label>
            <input type="text" class="form-control" id="cpf_edit" name="cpf" required>
            <div class="error-message" id="cpf_edit-error-message"></div>
          </div>
          <div class="mb-3">
            <label for="email_edit" class="form-label">Email</label>
            <input type="text" class="form-control" id="email_edit" name="email" required>
            <div class="error-message" id="email_edit-error-message"></div>
          </div>
          <div class="mb-3">
            <label for="telefone_edit" class="form-label">Telefone</label>
            <input type="text" class="form-control" id="telefone_edit" name="telefone" required>
          </div>
          <div class="mb-3">
            <label for="cep_edit" class="form-label">CEP</label>
            <input type="text" class="form-control" id="cep_edit" name="cep" required>
          </div>
          <div class="mb-3">
            <label for="endereco_edit" class="form-label">Endereço</label>
            <input type="text" class="form-control" id="endereco_edit" name="endereco" required>
          </div>
          <div class="mb-3">
            <label for="numero_casa_edit" class="form-label">Número</label>
            <input type="text" class="form-control" id="numero_casa_edit" name="numero_casa" required>
          </div>
          <div class="mb-3">
            <label for="complemento_edit" class="form-label">Complemento</label>
            <input type="text" class="form-control" id="complemento_edit" name="complemento" required>
          </div>
          <div class="mb-3">
            <label for="bairro_edit" class="form-label">Bairro</label>
            <input type="text" class="form-control" id="bairro_edit" name="bairro" required>
          </div>
          <div class="mb-3">
            <label for="cidade_edit" class="form-label">Cidade</label>
            <input type="text" class="form-control" id="cidade_edit" name="cidade" required>
          </div>
          <div class="mb-3">
            <label for="estado_edit" class="form-label">Estado</label>
            <input type="text" class="form-control" id="estado_edit" name="estado" required>
          </div>
          <div class="mb-3">
            <label for="data_nascimento_edit" class="form-label">Data de Nascimento</label>
            <input type="date" class="form-control" id="data_nascimento_edit" name="data_nascimento" required pattern="\d{4}-\d{2}-\d{2}">
          </div>
          <div class="mb-3">
            <label for="senha_edit" class="form-label">Senha</label>
            <input type="password" class="form-control" id="senha_edit" name="senha">
          </div>
          <div class="mb-3">
            <label for="status_usuario_edit" class="form-label">Status</label>
            <select class="form-control" id="status_usuario_edit" name="status_usuario" required>
              <option value="ativo">Ativo</option>
              <option value="inativo">Inativo</option>
            </select>
          </div>
          <div style="display: none;" class="mb-3">
            <label for="id_edit" class="form-label"></label>
            <input type="text" class="form-control" id="id_edit" name="id_edit" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Voltar</button>
          <button type="submit" class="btn salvarbtn btn-primary">Salvar</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal Edit -->
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editModalLabel">Editar Usuário</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="editForm" action="{{ route('users.update') }}" method="POST">
        @csrf
        @method('PUT')

        <div class="modal-body">
          <div class="mb-3">
            <label for="nome_completo_edit" class="form-label">Nome Completo</label>
            <input type="text" class="form-control" id="nome_completo_edit" name="nome_completo" required>
          </div>
          <div class="mb-3">
            <label for="cpf_edit" class="form-label">CPF</label>
            <input type="text" class="form-control" id="cpf_edit" name="cpf" required>
            <div class="error-message" id="cpf_edit-error-message"></div>
          </div>
          <div class="mb-3">
            <label for="email_edit" class="form-label">Email</label>
            <input type="text" class="form-control" id="email_edit" name="email" required>
            <div class="error-message" id="email_edit-error-message"></div>
          </div>
          <div class="mb-3">
            <label for="telefone_edit" class="form-label">Telefone</label>
            <input type="text" class="form-control" id="telefone_edit" name="telefone" required>
          </div>
          <div class="mb-3">
            <label for="cep_edit" class="form-label">CEP</label>
            <input type="text" class="form-control" id="cep_edit" name="cep" required>
          </div>
          <div class="mb-3">
            <label for="endereco_edit" class="form-label">Endereço</label>
            <input type="text" class="form-control" id="endereco_edit" name="endereco" required>
          </div>
          <div class="mb-3">
            <label for="numero_casa_edit" class="form-label">Número</label>
            <input type="text" class="form-control" id="numero_casa_edit" name="numero_casa" required>
          </div>
          <div class="mb-3">
            <label for="complemento_edit" class="form-label">Complemento</label>
            <input type="text" class="form-control" id="complemento_edit" name="complemento" required>
          </div>
          <div class="mb-3">
            <label for="bairro_edit" class="form-label">Bairro</label>
            <input type="text" class="form-control" id="bairro_edit" name="bairro" required>
          </div>
          <div class="mb-3">
            <label for="cidade_edit" class="form-label">Cidade</label>
            <input type="text" class="form-control" id="cidade_edit" name="cidade" required>
          </div>
          <div class="mb-3">
            <label for="estado_edit" class="form-label">Estado</label>
            <input type="text" class="form-control" id="estado_edit" name="estado" required>
          </div>
          <div class="mb-3">
            <label for="data_nascimento_edit" class="form-label">Data de Nascimento</label>
            <input type="date" class="form-control" id="data_nascimento_edit" name="data_nascimento" required pattern="\d{4}-\d{2}-\d{2}">
          </div>
          <div class="mb-3">
            <label for="senha_edit" class="form-label">Senha</label>
            <input type="password" class="form-control" id="senha_edit" name="senha">
          </div>
          <div class="mb-3">
            <label for="status_usuario_edit" class="form-label">Status</label>
            <select class="form-control" id="status_usuario_edit" name="status_usuario" required>
              <option value="ativo">Ativo</option>
              <option value="inativo">Inativo</option>
            </select>
          </div>
          <div style="display: none;" class="mb-3">
            <label for="id_edit" class="form-label"></label>
            <input type="text" class="form-control" id="id_edit" name="id_edit" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Voltar</button>
          <button type="submit" class="btn salvarbtn btn-primary">Salvar</button>
        </div>
      </form>
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
            <input type="text" class="form-control" id="cpf" name="cpf" required>
            <div class="error-message" id="cpf-error-message"></div>
          </div>
          <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="text" class="form-control" id="email" name="email" required>
            <div class="error-message" id="email-error-message"></div>
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

<!-- Modal Delete -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteModalLabel">Excluir Usuário</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        Tem certeza que deseja excluir este usuário?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
        <form action="{{ route('users.destroy') }}" method="POST" style="display:inline;">
          @csrf
          @method('DELETE')
          <input type="hidden" id="deletando_usuario" name="del_usuario_id">
          <button type="submit" class="btn btn-danger">Excluir</button>
        </form>
      </div>
    </div>
  </div>
</div>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', () => {
        const search = document.getElementById('search');
        search.addEventListener('input', () => {
            const query = search.value.toLowerCase();
            document.querySelectorAll('tbody tr').forEach(row => {
                const text = row.textContent.toLowerCase();
                row.style.display = text.includes(query) ? '' : 'none';
            });
        });
    });
</script>
<script>
  $(document).ready(function () {
    
    $(document).on('click', '.viewbtn', function() {

        var usuario_id = $(this).val();
        //alert(usuario_id);
        $('#viewModal').modal('show');

        $.ajax({
          type: "GET",
          url: "/users/show/" + usuario_id,
          success: function (response) {
            console.log(response.nome_completo);
            $('#nome_completo_view').val(response.nome_completo);
            $('#cpf_view').val(response.cpf);
            $('#email_view').val(response.email);
            $('#telefone_view').val(response.telefone);
            $('#cep_view').val(response.cep);
            $('#endereco_view').val(response.endereco);
            $('#numero_casa_view').val(response.numero_casa);
            $('#complemento_view').val(response.complemento);
            $('#bairro_view').val(response.bairro);
            $('#cidade_view').val(response.cidade);
            $('#estado_view').val(response.estado);
            $('#data_nascimento_view').val(response.data_nascimento);
            $('#status_usuario_view').val(response.status_usuario);
          }
        });
    });
    
    $(document).on('click', '.editbtn', function() {

        var usuario_id = $(this).val();
        //alert(usuario_id);
        $('#editModal').modal('show');
        
        $.ajax({
          type: "GET",
          url: "/users/edit/" + usuario_id,
          success: function (response) {
            console.log(response.nome_completo);
            $('#nome_completo_edit').val(response.nome_completo);
            $('#cpf_edit').val(response.cpf);
            $('#email_edit').val(response.email);
            $('#telefone_edit').val(response.telefone);
            $('#cep_edit').val(response.cep);
            $('#endereco_edit').val(response.endereco);
            $('#numero_casa_edit').val(response.numero_casa);
            $('#complemento_edit').val(response.complemento);
            $('#bairro_edit').val(response.bairro);
            $('#cidade_edit').val(response.cidade);
            $('#estado_edit').val(response.estado);
            $('#data_nascimento_edit').val(response.data_nascimento);
            $('#status_usuario_edit').val(response.status_usuario);
            $('#senha_edit').val(response.senha);
            $('#id_edit').val(response.id);
          }

        });
      
    });

    $(document).on('click', '.deletebtn', function() {

      var usuario_id = $(this).val();
      //alert(usuario_id);
      $('#deleteModal').modal('show');
      $('#deletando_usuario').val(usuario_id);

    });

    $(document).on('click', '.salvaruserbtn', function(e) {

      var cpf = $('#cpf').val();
      var email = $('#email').val();
      
        if (!validarCPF(cpf)) {
          // Se o e-mail não for válido, mostre uma mensagem de erro e pare aqui
          $('#cpf-error-message').text('Por favor, insira um CPF válido.');
          e.preventDefault();
          return;
        }

        if (!validarEmail(email)) {
          // Se o e-mail não for válido, mostre uma mensagem de erro e pare aqui
          $('#email-error-message').text('Por favor, insira um endereço de e-mail válido.');
          e.preventDefault();
          return;
        }    
        
    });
    
      function validarEmail(email) {
            var re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return re.test(email);
      }

      var emailInput = document.getElementById('email');
      var errorMessageEmail = document.getElementById('email-error-message');

      emailInput.addEventListener('input', function() {
        if (validarEmail(emailInput.value)) {
            emailInput.classList.remove('invalid');
            emailInput.classList.add('valid');
            errorMessageEmail.textContent = '';
        } else {
            emailInput.classList.remove('valid');
            emailInput.classList.add('invalid');
            errorMessageEmail.textContent = 'Por favor, insira um endereço de e-mail válido.';
        }
      });

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

      //Pega os valores do campo CPF na modal de cadastro para validação
      var cpfInput = document.getElementById('cpf');
      var errorMessageCpf = document.getElementById('cpf-error-message');
  
      //Mostra Mensagem CPF inválido modal cadastro
      cpfInput.addEventListener('input', function() {
        if (validarCPF(cpfInput.value)) {
          cpfInput.classList.remove('invalid');
          cpfInput.classList.add('valid');
          errorMessageCpf.textContent = '';
        } else {
          cpfInput.classList.remove('valid');
          cpfInput.classList.add('invalid');
          errorMessageCpf.textContent = 'Por favor, insira um CPF válido.';
        }
      });

      //Pega os valores do campo CPF na modal de edição para validação
      var cpfInput_edit = document.getElementById('cpf_edit');
      var errorMessageCpf_edit = document.getElementById('cpf_edit-error-message');

      //Mostra Mensagem CPF inválido modal cadastro
      cpfInput_edit.addEventListener('input', function() {
            if (validarCPF(cpfInput_edit.value)) {
              cpfInput_edit.classList.remove('invalid');
              cpfInput_edit.classList.add('valid');
              errorMessageCpf_edit.textContent = '';
            } else {
              cpfInput_edit.classList.remove('valid');
              cpfInput_edit.classList.add('invalid');
              errorMessageCpf_edit.textContent = 'Por favor, insira um CPF válido.';
            }
          });
  
  var emailInput_edit = document.getElementById('email_edit');
  var errorMessageEmail_edit = document.getElementById('email_edit-error-message');

  emailInput_edit.addEventListener('input', function() {
        if (validarEmail(emailInput_edit.value)) {
          emailInput_edit.classList.remove('invalid');
          emailInput_edit.classList.add('valid');
          errorMessageEmail_edit.textContent = '';
        } else {
          emailInput_edit.classList.remove('valid');
          emailInput_edit.classList.add('invalid');
          errorMessageEmail_edit.textContent = 'Por favor, insira um endereço de e-mail válido.';
        }
      });

    $(document).on('click', '.salvarbtn', function(e) {

      var cpf = $('#cpf_edit').val();
      var email = $('#email_edit').val();
      
      if (!validarCPF(cpf)) {
        // Se o e-mail não for válido, mostre uma mensagem de erro e pare aqui
        $('#cpf-error-message').text('Por favor, insira um CPF válido.');
        e.preventDefault();
        return;
      }

      if (!validarEmail(email)) {
        // Se o e-mail não for válido, mostre uma mensagem de erro e pare aqui
        $('#email-error-message').text('Por favor, insira um endereço de e-mail válido.');
        e.preventDefault();
        return;
      }       
    });

  });
</script>
@endpush