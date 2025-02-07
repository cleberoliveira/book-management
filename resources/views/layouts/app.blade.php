<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title') - 📚 Book Management</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <style>
        :root {
            --primary-color: #6366f1;
            --secondary-color: #4f46e5;
        }
        
        body {
            background-color: #f8fafc;
            font-family: 'Inter', sans-serif;
        }
        
        .navbar {
            box-shadow: 0 2px 4px rgba(0,0,0,.04);
            background: linear-gradient(to right, var(--primary-color), var(--secondary-color));
        }
        
        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 4px 6px -1px rgba(0,0,0,.1);
        }
        
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }
        
        .btn-primary:hover {
            background-color: var(--secondary-color);
            border-color: var(--secondary-color);
        }
    </style>
    @stack('styles')
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark mb-4">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="{{ route('books.index') }}">
                📚 Book Management
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('books.index') }}">
                            📋 Listar Livros
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('books.create') }}">
                            ✨ Novo Livro
                        </a>
                    </li>
                </ul>
                @auth
                    <form action="{{ route('logout') }}" method="POST" class="d-flex">
                        @csrf
                        <button type="submit" class="btn btn-outline-light">
                            <i class="bi bi-box-arrow-right"></i> Sair
                        </button>
                    </form>
                @endauth
            </div>
        </div>
    </nav>

    <div class="container">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show rounded-3">
                ✅ {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show rounded-3">
                ❌ {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @yield('content')
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @stack('scripts')
</body>
</html> 