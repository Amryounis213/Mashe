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
        Schema::create('card_accounts', function (Blueprint $table) {
            $table->id();

            $table->text('token')->nullable();
            $table->string('transaction_id')->nullable();


            $table->string('holder_name')->nullable();
            $table->string('holder_id')->nullable();

            $table->string('Tmonth')->nullable();
            $table->string('Tyear')->nullable();
            $table->string('last_4_digits')->nullable();
            $table->string('brand')->nullable();
            $table->string('issuer')->nullable();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->boolean('default')->default(false);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('card_accounts');
    }
};
