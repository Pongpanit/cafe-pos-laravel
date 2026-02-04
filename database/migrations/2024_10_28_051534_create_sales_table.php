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
        Schema::create('sales', function (Blueprint $table) {
        $table->id();
        $table->string('product_name');
        $table->integer('quantity');
        $table->decimal('price', 8, 2);
        $table->decimal('total', 8, 2);
        $table->text('order_details')->nullable(); // เก็บรายละเอียดเช่น add-ons และ sweetness level
        $table->dateTime('sale_date');
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
