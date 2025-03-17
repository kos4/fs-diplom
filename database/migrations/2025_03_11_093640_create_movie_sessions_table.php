<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('movie_sessions', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('movie_id')->constrained(
                table: 'movies', indexName: 'movie_sessions_movie_id'
            )
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('hall_id')->constrained(
                table: 'halls', indexName: 'movie_sessions_hall_id'
            )
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->time('movie_session_time');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movie_sessions');
    }
};
