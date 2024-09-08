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
        Schema::create('food', function (Blueprint $table) {
            $table->string('food_id')->primary(); // Custom ID
            $table->string('name');
            $table->string('description');
            $table->string('category_id'); // Match the type of the foreign key
            $table->foreign('category_id')->references('category_id')->on('categories')->onDelete('cascade');
            $table->decimal('price', 8, 2); // Specify precision and scale
            $table->string('image_path');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('food');
    }
};
