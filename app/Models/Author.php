<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Book;

class Author extends Model
{
    use HasFactory;

    protected $fillable = ['nome', 'ativo'];
    
    protected $casts = [
        'ativo' => 'boolean',
    ];

    public function books()
    {
        return $this->hasMany(Book::class);
    }
}