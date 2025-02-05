<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Detalhes do Livro</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-4">
    <h1>Detalhes do Livro</h1>
    @if($book->imagem_capa)
        <div class="mb-3">
            <img src="{{ asset($book->imagem_capa) }}" alt="Capa do Livro" width="200" height="200">
        </div>
    @endif
    <p><strong>Título:</strong> {{ $book->titulo }}</p>
    <p><strong>Descrição:</strong> {{ $book->descricao }}</p>
    <p><strong>Data de Publicação:</strong> {{ $book->data_publicacao }}</p>
    <p><strong>Autor:</strong> {{ $book->author->nome }}</p>
    <a href="{{ route('books.index') }}" class="btn btn-secondary">Voltar</a>
</div>
</body>
</html>