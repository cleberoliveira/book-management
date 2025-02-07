<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Author;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        return view('books.index', ['books' => Book::with('author')->get()]);
    }

    public function create()
    {
        return view('books.create', ['authors' => Author::where('ativo', true)->get()]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'titulo' => 'required|string|max:255',
            'descricao' => 'required|string',
            'data_publicacao' => 'required|date',
            'author_id' => 'required|exists:authors,id',
            'imagem_capa' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        if ($request->hasFile('imagem_capa')) {
            $data['imagem_capa'] = $request->file('imagem_capa')->store('capas', 'public');
        }

        Book::create($data);
        return redirect()->route('books.index')->with('success', 'Livro criado com sucesso');
    }

    public function show(Book $book)
    {
        return view('books.show', compact('book'));
    }

    public function edit(Book $book)
    {
        $authors = Author::where('ativo', true)->get();
        return view('books.edit', compact('book', 'authors'));
    }

    public function update(Request $request, Book $book)
    {
        $data = $request->validate([
            'titulo' => 'required|string|max:255',
            'descricao' => 'required|string',
            'data_publicacao' => 'required|date',
            'author_id' => 'required|exists:authors,id',
            'imagem_capa' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);

        // Verifica se o usuário quer remover a imagem atual
        if ($request->has('remover_imagem') && $book->imagem_capa) {
            \Storage::disk('public')->delete($book->imagem_capa);
            $data['imagem_capa'] = null;
        }
        // Se não está removendo, mas está enviando uma nova imagem
        elseif ($request->hasFile('imagem_capa')) {
            if ($book->imagem_capa) {
                \Storage::disk('public')->delete($book->imagem_capa);
            }
            $data['imagem_capa'] = $request->file('imagem_capa')->store('capas', 'public');
        }

        $book->update($data);
        return redirect()->route('books.index')->with('success', 'Livro atualizado com sucesso');
    }

    public function destroy(Book $book)
    {
        if ($book->imagem_capa) {
            \Storage::disk('public')->delete($book->imagem_capa);
        }
        
        $book->delete();
        return redirect()->route('books.index')->with('success', 'Livro excluído com sucesso');
    }
}