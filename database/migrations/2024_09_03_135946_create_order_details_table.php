<?php

use App\Models\Food;
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
        Schema::create('order_details', function (Blueprint $table) {
            $table->string('orderDetail_id')->primary(); // Custom ID
            $table->string('food_id'); // Match the type of the foreign key
            $table->foreign('food_id')->references('food_id')->on('food')->onDelete('cascade');
            $table->string('order_id'); // Match the type of the foreign key
            $table->foreign('order_id')->references('order_id')->on('orders')->onDelete('cascade');
            $table->decimal('price', 8, 2);
            $table->smallInteger('quantity');
            $table->decimal('subtotal', 8, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_details');
    }
};
