@extends('layouts.app')

@section('title', 'Detalhes do Livro')

@section('content')
<div class="card">
    <div class="card-header">
        <h1 class="card-title">Detalhes do Livro</h1>
    </div>
    <div class="card-body">
        <div class="row">
            @if($book->imagem_capa)
                <div class="col-md-4 mb-3">
                    <img src="{{ asset('storage/' . $book->imagem_capa) }}" 
                         alt="Capa do livro {{ $book->titulo }}" 
                         class="img-fluid rounded">
                </div>
            @else
                <div class="col-md-4 mb-3">
                    <div class="rounded bg-light d-flex align-items-center justify-content-center" 
                         style="height: 300px">
                        <x-book-cover-placeholder />
                    </div>
                </div>
            @endif
            <div class="col">
                <dl class="row">
                    <dt class="col-sm-3">Título</dt>
                    <dd class="col-sm-9">{{ $book->titulo }}</dd>

                    <dt class="col-sm-3">Descrição</dt>
                    <dd class="col-sm-9">{{ $book->descricao }}</dd>

                    <dt class="col-sm-3">Data de Publicação</dt>
                    <dd class="col-sm-9">{{ $book->data_publicacao }}</dd>

                    <dt class="col-sm-3">Autor</dt>
                    <dd class="col-sm-9">{{ $book->author->nome }}</dd>
                </dl>
            </div>
        </div>
        <div class="mt-3">
            <a href="{{ route('books.index') }}" class="btn btn-secondary">Voltar</a>
        </div>
    </div>
</div>
@endsection