@extends('layouts.app')

@section('title', 'Editar Livro')

@section('content')
<div class="card">
    <div class="card-header">
        <h1 class="card-title">Editar Livro</h1>
    </div>
    <div class="card-body">
        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('books.update', $book) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label for="titulo" class="form-label">Título</label>
                <input type="text" class="form-control @error('titulo') is-invalid @enderror" 
                       id="titulo" name="titulo" value="{{ old('titulo', $book->titulo) }}">
                @error('titulo')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="descricao" class="form-label">Descrição</label>
                <textarea class="form-control @error('descricao') is-invalid @enderror" 
                          id="descricao" name="descricao" rows="3">{{ old('descricao', $book->descricao) }}</textarea>
                @error('descricao')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="data_publicacao" class="form-label">Data de Publicação</label>
                <input type="date" class="form-control @error('data_publicacao') is-invalid @enderror" 
                       id="data_publicacao" name="data_publicacao" value="{{ old('data_publicacao', $book->data_publicacao) }}">
                @error('data_publicacao')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="author_id" class="form-label">Autor</label>
                <select class="form-select @error('author_id') is-invalid @enderror" 
                        id="author_id" name="author_id">
                    <option value="">Selecione um autor</option>
                    @foreach($authors as $author)
                        <option value="{{ $author->id }}" 
                                {{ old('author_id', $book->author_id) == $author->id ? 'selected' : '' }}>
                            {{ $author->nome }}
                        </option>
                    @endforeach
                </select>
                @error('author_id')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="imagem_capa" class="form-label">Capa do Livro</label>
                <input type="file" class="form-control @error('imagem_capa') is-invalid @enderror" 
                       id="imagem_capa" name="imagem_capa">
                @error('imagem_capa')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <small class="form-text text-muted">
                    Formatos aceitos: JPG, PNG. Tamanho máximo: 2MB
                </small>
                @if($book->imagem_capa)
                    <div class="mt-2">
                        <img src="{{ asset('storage/' . $book->imagem_capa) }}" 
                             alt="Capa do livro {{ $book->titulo }}" 
                             class="img-thumbnail" 
                             style="max-width: 150px">
                        <div class="form-check mt-2">
                            <input type="checkbox" 
                                   class="form-check-input" 
                                   id="remover_imagem" 
                                   name="remover_imagem" 
                                   value="1">
                            <label class="form-check-label" for="remover_imagem">
                                Remover imagem atual
                            </label>
                        </div>
                    </div>
                @else
                    <div class="mt-2">
                        <div class="img-thumbnail d-flex align-items-center justify-content-center bg-light" 
                             style="width: 150px; height: 150px">
                            <x-book-cover-placeholder />
                        </div>
                    </div>
                @endif
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{ route('books.index') }}" class="btn btn-secondary">Voltar</a>
                <button type="submit" class="btn btn-primary">Atualizar</button>
            </div>
        </form>
    </div>
</div>
@endsection