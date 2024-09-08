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
        Schema::create('cart_details', function (Blueprint $table) {
            $table->string('cartDetail_id')->primary(); // Custom ID
            $table->string('food_id'); // Match the type of the foreign key
            $table->foreign('food_id')->references('food_id')->on('food')->onDelete('cascade');
            $table->string('cart_id'); // Match the type of the foreign key
            $table->foreign('cart_id')->references('cart_id')->on('carts')->onDelete('cascade');
            $table->smallInteger('quantity');
            $table->decimal('subtotal');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cart_details');
    }
};
