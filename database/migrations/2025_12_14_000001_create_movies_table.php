<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('movies', function (Blueprint $table) {
            $table->id();

            $table->string('title');
            $table->smallInteger('year')->nullable();
            $table->integer('runtime')->nullable();

            $table->string('tagline')->nullable();
            $table->text('description')->nullable();

            $table->json('genres')->nullable();

            $table->decimal('rating_avg', 4, 1)->default(0);
            $table->integer('vote_count')->default(0);

            $table->string('poster_path')->nullable();
            $table->string('backdrop_path')->nullable();

            $table->string('trailer_url')->nullable();
            $table->string('trailer_length')->nullable();

            $table->string('language')->nullable();
            $table->date('release_date')->nullable();
            $table->string('certificate')->nullable();

            $table->string('director')->nullable();
            $table->string('writer')->nullable();
            $table->string('filming_locations')->nullable();
            $table->string('production_companies')->nullable();

            $table->timestamps();

            $table->index('title');
            $table->index('year');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('movies');
    }
};
