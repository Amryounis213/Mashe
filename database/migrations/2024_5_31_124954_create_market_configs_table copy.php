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
        Schema::create('market_configs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('market_id');
            $table->boolean('instant_order')->default('0');
            $table->boolean('customer_date_order_sratus')->default('0');
            $table->integer('customer_order_date')->default('0');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('market_configs');
    }
};
