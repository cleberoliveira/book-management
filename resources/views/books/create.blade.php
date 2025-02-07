@extends('layouts.app')

@section('title', 'Novo Livro')

@section('content')
<div class="card">
    <div class="card-header">
        <h1 class="card-title">Adicionar Novo Livro</h1>
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

        <form action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="titulo" class="form-label">Título</label>
                <input type="text" class="form-control @error('titulo') is-invalid @enderror" 
                       id="titulo" name="titulo" value="{{ old('titulo') }}">
                @error('titulo')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="descricao" class="form-label">Descrição</label>
                <textarea class="form-control @error('descricao') is-invalid @enderror" 
                          id="descricao" name="descricao" rows="3">{{ old('descricao') }}</textarea>
                @error('descricao')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="data_publicacao" class="form-label">Data de Publicação</label>
                <input type="date" class="form-control @error('data_publicacao') is-invalid @enderror" 
                       id="data_publicacao" name="data_publicacao" value="{{ old('data_publicacao') }}">
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
                                {{ old('author_id') == $author->id ? 'selected' : '' }}>
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
            </div>

            <div class="d-flex justify-content-between">
                <a href="{{ route('books.index') }}" class="btn btn-secondary">Voltar</a>
                <button type="submit" class="btn btn-primary">Salvar</button>
            </div>
        </form>
    </div>
</div>
@endsection