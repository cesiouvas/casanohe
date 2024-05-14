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
        Schema::create('custom_orders', function (Blueprint $table) {
            $table->id();
            $table->string('comments');
            $table->integer('quantity');
            $table->integer('status');
            $table->decimal('price', 15, 2);

            // foreign key for users
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');

            // foreign key for types
            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')->references('id')->on('products');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('custom_orders');
    }
};
