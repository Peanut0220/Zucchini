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
        Schema::create('orders', function (Blueprint $table) {
            $table->string('order_id')->primary(); // Custom ID
            $table->string('user_id'); // Match the type of the foreign key
            $table->foreign('user_id')->references('user_id')->on('users')->onDelete('cascade');
            $table->string('payment_type');
            $table->decimal('final');
            $table->decimal('total');
            $table->decimal('tax');
            $table->decimal('discount');
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
