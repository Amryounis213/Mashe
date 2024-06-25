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
        Schema::create('cart_memory', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->float('subtotal')->default(0);
            $table->float('discount')->default(0);
            $table->float('tax')->default(0);
            $table->float('total')->default(0);
            $table->float('driver_tip')->default(0);

            $table->foreignId('card_id')->constrained('card_accounts')->nullable()->cascadeOnDelete();
            // $table->foreignId('card_id')->constrained('card_accounts')->cascadeOnDelete();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cart_results');
    }
};
