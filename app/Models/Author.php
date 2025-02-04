<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'estado'];

    // Relacionamento: Um autor pode ter muitos livros
    public function books()
    {
        return $this->hasMany(Book::class);
    }
}