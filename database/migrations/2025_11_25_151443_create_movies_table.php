<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('movies', function (Blueprint $table) {
            $table->id();
            $table->string('title');              // Judul Film
            $table->text('synopsis');             // Sinopsis (Panjang)
            $table->string('poster')->nullable(); // Link Gambar Poster
            $table->integer('year');              // Tahun Rilis
            $table->string('genre');              // Genre
            $table->string('director');           // Sutradara
            $table->timestamps();                 // Waktu dibuat

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movies');
    }
};
