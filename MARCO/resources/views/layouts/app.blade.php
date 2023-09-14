<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <title>Listar Usuarios</title>

    <!-- Bootstrap CSS (via CDN) -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Additional CSS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"></script>
    
    <style>
    .input-espacado {
        margin-bottom: 8px;
    }
    .valid {
        border: 2px solid green;
    }

    .invalid {
        border: 2px solid red;
    }

    .error-message {
        color: red;
        font-size: 12px;
    }

    table {
        width: 100%; /* Defina a largura da tabela como 100% para ocupar toda a largura disponível */
        border-collapse: collapse; /* Remove espaços entre as bordas das células */
        border-radius: 10px; /* Adiciona bordas arredondadas nos cantos da tabela */
        overflow: hidden; /* Esconde o conteúdo que excede os limites da tabela (necessário para ver o efeito das bordas arredondadas) */
    }

    table, th, td {
        border: 2px solid #d9d7d7; /* Adiciona uma borda de 1px em volta de todas as células e da tabela */
    }    

    th, td {
        text-align: center; /* Centraliza o texto dentro das células */
        padding: 0px; /* Adiciona algum espaço entre o conteúdo da célula e suas bordas */
    }

    th {
        background-color: #f4f4f4 !important;
    }

    </style>
    @stack('styles')
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    Página Inicial
                </a>
            </div>
        </nav>

        <main class="py-4">
            @yield('content')
        </main>
    </div>

    <!-- Bootstrap JS (via CDN) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Additional Scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"></script>

</script>
    @stack('scripts')
</body>
</html>