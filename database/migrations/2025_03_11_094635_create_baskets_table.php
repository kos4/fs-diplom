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
        Schema::create('baskets', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->foreignId('order_id')->constrained(
                table: 'orders', indexName: 'baskets_order_id'
            )
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->integer('place_number');
            $table->foreignId('place_type_id')->constrained(
                table: 'place_types', indexName: 'place_types_id'
            );
            $table->float('price');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('baskets');
    }
};
