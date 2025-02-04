<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Gerenciamento de Livros</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-4">
    <h1>Lista de Livros</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('books.create') }}" class="btn btn-primary mb-3">Novo Livro</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Título</th>
                <th>Autor</th>
                <th>Data de Publicação</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @forelse($books as $book)
            <tr>
                <td>{{ $book->id }}</td>
                <td>{{ $book->titulo }}</td>
                <td>{{ $book->author->nome ?? 'N/A' }}</td>
                <td>{{ $book->data_publicacao }}</td>
                <td>
                    <a href="{{ route('books.edit', $book) }}" class="btn btn-sm btn-warning">Editar</a>
                    <form action="{{ route('books.destroy', $book) }}" method="post" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger"
                          onclick="return confirm('Deseja realmente excluir este livro?')">Excluir</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5">Nenhum livro cadastrado.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
</body>
</html>