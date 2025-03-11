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
        Schema::create('prices', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->float('price');
            $table->foreignId('hall_id')->constrained(
                table: 'halls', indexName: 'prices_hall_id'
            )
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('type_id')->constrained(
                table: 'place_types', indexName: 'prices_type_id'
            )
                ->onUpdate('cascade')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('prices');
    }
};
