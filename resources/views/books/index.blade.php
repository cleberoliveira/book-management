@extends('layouts.app')

@section('title', 'Lista de Livros')

@section('content')
<div class="card">
    <div class="card-header bg-white py-3">
        <div class="d-flex justify-content-between align-items-center">
            <h1 class="h3 mb-0">📚 Lista de Livros</h1>
            <a href="{{ route('books.create') }}" class="btn btn-primary">
                <i class="bi bi-plus-lg"></i> Novo Livro
            </a>
        </div>
    </div>
    <div class="card-body">
        @if($books->isEmpty())
            <div class="text-center py-5">
                <i class="bi bi-book display-1 text-muted"></i>
                <p class="h4 mt-3 text-muted">Nenhum livro cadastrado</p>
                <a href="{{ route('books.create') }}" class="btn btn-primary mt-3">
                    <i class="bi bi-plus-lg"></i> Adicionar Primeiro Livro
                </a>
            </div>
        @else
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead>
                        <tr>
                            <th>📸 Capa</th>
                            <th>📖 Título</th>
                            <th>✍️ Autor</th>
                            <th>📅 Publicação</th>
                            <th>🔧 Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($books as $book)
                        <tr>
                            <td width="80">
                                @if($book->imagem_capa)
                                    <img src="{{ asset('storage/' . $book->imagem_capa) }}" 
                                         alt="Capa do livro {{ $book->titulo }}" 
                                         class="img-thumbnail" 
                                         style="width: 50px; height: 50px; object-fit: cover">
                                @else
                                    <div class="img-thumbnail d-flex align-items-center justify-content-center bg-light" 
                                         style="width: 50px; height: 50px">
                                        <x-book-cover-placeholder />
                                    </div>
                                @endif
                            </td>
                            <td>{{ $book->titulo }}</td>
                            <td>{{ $book->author->nome ?? 'N/A' }}</td>
                            <td>{{ \Carbon\Carbon::parse($book->data_publicacao)->format('d/m/Y') }}</td>
                            <td>
                                <div class="btn-group">
                                    <a href="{{ route('books.show', $book) }}" 
                                       class="btn btn-sm btn-outline-primary">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                    <a href="{{ route('books.edit', $book) }}" 
                                       class="btn btn-sm btn-outline-warning">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <button type="button" 
                                            class="btn btn-sm btn-outline-danger"
                                            onclick="confirmarExclusao({{ $book->id }})">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                    <form id="form-delete-{{ $book->id }}"
                                          action="{{ route('books.destroy', $book) }}" 
                                          method="POST" class="d-none">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>

@push('scripts')
<script>
function confirmarExclusao(id) {
    if (confirm('❌ Deseja realmente excluir este livro?')) {
        document.getElementById('form-delete-' + id).submit();
    }
}
</script>
@endpush
@endsection