<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class BookController extends Controller
{
    private const MESSAGES = [
        'created' => 'Livro criado com sucesso!',
        'updated' => 'Livro atualizado com sucesso!',
        'deleted' => 'Livro excluído com sucesso!'
    ];

    // Exibe a listagem de livros
    public function index()
    {
        $books = Book::with('author')->get();
        return view('books.index', compact('books'));
    }

    // Mostra o formulário para criar um novo livro
    public function create()
    {
        // Seleciona apenas autores ativos
        $authors = Author::where('estado', 'ativo')->get();
        return view('books.create', compact('authors'));
    }

    // Armazena o novo livro
    public function store(Request $request)
    {
        try {
            $request->validate([
                'titulo'         => 'required|string|max:255',
                'descricao'      => 'required|string',
                'data_publicacao'=> 'required|date',
                'author_id'      => 'required|exists:authors,id',
                'imagem_capa'    => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            ], [
                'imagem_capa.max' => 'A imagem da capa não pode ser maior que 2MB.',
                'imagem_capa.mimes' => 'A imagem da capa deve ser do tipo JPG ou PNG.'
            ]);

            if ($request->hasFile('imagem_capa')) {
                $capa = $request->file('imagem_capa');
                $manager = new ImageManager(new Driver());
                $filename = time().'_'.uniqid().'.'.$capa->getClientOriginalExtension();

                $image = $manager->read($capa)
                    ->resize(200, 200, function ($constraint) {
                        $constraint->aspectRatio();
                        $constraint->upsize();
                    })
                    ->encode();

                Storage::disk('public')->put('capas/'.$filename, $image);
                $data['imagem_capa'] = 'capas/'.$filename;
            }

            Book::create($data);
            return redirect()->route('books.index')->with('success', self::MESSAGES['created']);
        } catch (\Exception $e) {
            return back()->with('error', 'Erro ao criar livro: ' . $e->getMessage());
        }
    }

    // Exibe os detalhes de um livro (opcional)
    public function show(Book $book)
    {
        return view('books.show', compact('book'));
    }

    // Mostra o formulário para edição do livro
    public function edit(Book $book)
    {
        $authors = Author::where('estado', 'ativo')->get();
        return view('books.edit', compact('book', 'authors'));
    }

    // Atualiza os dados do livro
    public function update(Request $request, Book $book)
    {
        try {
            $request->validate([
                'titulo'         => 'required|string|max:255',
                'descricao'      => 'required|string',
                'data_publicacao'=> 'required|date',
                'author_id'      => 'required|exists:authors,id',
                'imagem_capa'    => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
            ], [
                'imagem_capa.max' => 'A imagem da capa não pode ser maior que 2MB.',
                'imagem_capa.mimes' => 'A imagem da capa deve ser do tipo JPG ou PNG.'
            ]);

            if ($request->hasFile('imagem_capa')) {
                // Opcional: remover a imagem antiga, se existir
                if ($book->imagem_capa && Storage::disk('public')->exists($book->imagem_capa)) {
                    Storage::disk('public')->delete($book->imagem_capa);
                }

                $capa = $request->file('imagem_capa');
                $manager = new ImageManager(new Driver());
                $filename = time().'_'.uniqid().'.'.$capa->getClientOriginalExtension();

                $image = $manager->read($capa)
                    ->resize(200, 200, function ($constraint) {
                        $constraint->aspectRatio();
                        $constraint->upsize();
                    })
                    ->encode();

                Storage::disk('public')->put('capas/'.$filename, $image);
                $data['imagem_capa'] = 'capas/'.$filename;
            }

            $book->update($data);
            return redirect()->route('books.index')->with('success', self::MESSAGES['updated']);
        } catch (\Exception $e) {
            return back()->with('error', 'Erro ao atualizar livro: ' . $e->getMessage());
        }
    }

    // Exclui o livro
    public function destroy(Book $book)
    {
        try {
            $book->delete();
            return redirect()->route('books.index')->with('success', self::MESSAGES['deleted']);
        } catch (\Exception $e) {
            \Log::error('Erro ao excluir livro: ' . $e->getMessage());
            return back()->with('error', 'Erro ao excluir livro: ' . $e->getMessage());
        }
    }
}