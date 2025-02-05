<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Editar Livro</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-4">
    <h1>Editar Livro</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('books.update', $book) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="titulo" class="form-label">Título</label>
            <input type="text" name="titulo" class="form-control" value="{{ old('titulo', $book->titulo) }}" required>
        </div>
        <div class="mb-3">
            <label for="descricao" class="form-label">Descrição</label>
            <textarea name="descricao" class="form-control" rows="5" required>{{ old('descricao', $book->descricao) }}</textarea>
        </div>
        <div class="mb-3">
            <label for="data_publicacao" class="form-label">Data de Publicação</label>
            <input type="date" name="data_publicacao" class="form-control" value="{{ old('data_publicacao', $book->data_publicacao) }}" required>
        </div>
        <div class="mb-3">
            <label for="author_id" class="form-label">Autor</label>
            <select name="author_id" class="form-control" required>
                <option value="">Selecione um autor</option>
                @foreach($authors as $author)
                    <option value="{{ $author->id }}" {{ (old('author_id', $book->author_id) == $author->id) ? 'selected' : '' }}>
                        {{ $author->nome }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="imagem_capa" class="form-label">Imagem de Capa (JPG, PNG - Máximo 2MB)</label>
            <input type="file" name="imagem_capa" class="form-control" accept="image/jpeg, image/png">
            @if($book->imagem_capa)
                 <div class="mt-2">
                     <img src="{{ asset($book->imagem_capa) }}" alt="Capa do Livro" width="100" height="100">
                 </div>
            @endif
        </div>
        <button type="submit" class="btn btn-success">Atualizar Livro</button>
        <a href="{{ route('books.index') }}" class="btn btn-secondary">Voltar</a>
    </form>
</div>
</body>
</html>