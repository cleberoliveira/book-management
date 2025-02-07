<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('titulo');
            $table->text('descricao');
            $table->date('data_publicacao');
            $table->unsignedBigInteger('author_id');
            $table->string('imagem_capa')->nullable();
            $table->timestamps();

            $table->foreign('author_id')->references('id')->on('authors');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('books');
    }
}; 