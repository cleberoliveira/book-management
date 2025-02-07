<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Author;
use Illuminate\Http\Request;

class AuthorController extends Controller
{
    public function __construct()
    {
        // Apenas administradores podem acessar todos os métodos deste controller
        $this->middleware('is_admin');
    }

    // Exibe todos os autores
    public function index()
    {
        return response()->json(Author::all());
    }

    // Cria um novo autor (acessível apenas para administradores)
    public function store(Request $request)
    {
        $data = $request->validate([
            'nome' => 'required|string|max:255',
            'ativo' => 'required|boolean'
        ]);

        return response()->json(Author::create($data), 201);
    }

    // Exibe um autor específico
    public function show(Author $author)
    {
        return response()->json($author);
    }

    // Atualiza os dados de um autor (acessível apenas para administradores)
    public function update(Request $request, Author $author)
    {
        $data = $request->validate([
            'nome' => 'sometimes|required|string|max:255',
            'ativo' => 'sometimes|required|boolean'
        ]);

        $author->update($data);
        return response()->json($author);
    }

    // Exclui um autor, se não possuir livros associados (acessível apenas para administradores)
    public function destroy(Author $author)
    {
        if ($author->books()->exists()) {
            return response()->json(['error' => 'Autor possui livros associados'], 409);
        }

        $author->delete();
        return response()->json(null, 204);
    }

    // Retorna os livros associados a um autor
    public function books(Author $author)
    {
        return response()->json($author->books);
    }
}