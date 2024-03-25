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
        Schema::create('order_product', function (Blueprint $table) {
            $table->id();
            $table->string('quantity');

            // foreign key for products
            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')->references('id')->on('products');

            // foreign key for orders
            $table->unsignedBigInteger('order_id');
            $table->foreign('order_id')->references('id')->on('orders')->constrained()
            // delete campos relacionados con orders
                ->onDelete('CASCADE')
                ->onUpdate('CASCADE');



            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
