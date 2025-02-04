<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    // Exibe todos os autores
    public function index()
    {
        $authors = Author::all();
        return response()->json($authors);
    }

    // Cria um novo autor
    public function store(Request $request)
    {
        $data = $request->validate([
            'nome'   => 'required|string|max:255',
            'estado' => 'required|string|max:50'
        ]);

        $author = Author::create($data);

        return response()->json($author, 201);
    }

    // Exibe um autor específico
    public function show(Author $author)
    {
        return response()->json($author);
    }

    // Atualiza os dados de um autor
    public function update(Request $request, Author $author)
    {
        $data = $request->validate([
            'nome'   => 'sometimes|required|string|max:255',
            'estado' => 'sometimes|required|string|max:50'
        ]);

        $author->update($data);

        return response()->json($author);
    }

    // Exclui um autor, se não possuir livros associados
    public function destroy(Author $author)
    {
        if ($author->books()->count() > 0) {
            return response()->json([
                'error' => 'Não é permitido eliminar um autor que possua livros associados.'
            ], 409);
        }

        $author->delete();
        return response()->json(['message' => 'Autor removido com sucesso']);
    }

    // Retorna os livros associados a um autor
    public function books(Author $author)
    {
        $books = $author->books; // relaicona definido no model
        return response()->json($books);
    }
}