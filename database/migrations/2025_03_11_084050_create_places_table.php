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
        Schema::create('places', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('hall_id')->constrained(
                table: 'halls', indexName: 'places_hall_id'
            )
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('type_id')->constrained(
                table: 'place_types', indexName: 'places_type_id'
            )
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->integer('number');
            $table->integer('position');
            $table->integer('row');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('places');
    }
};
