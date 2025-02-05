<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('books', function (Blueprint $table) {
            $table->string('imagem_capa')->nullable()->after('author_id');
        });
    }

    public function down(): void {
        Schema::table('books', function (Blueprint $table) {
            $table->dropColumn('imagem_capa');
        });
    }
}; 