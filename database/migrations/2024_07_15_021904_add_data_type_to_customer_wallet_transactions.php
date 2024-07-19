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
        Schema::table('customer_wallet_transactions', function (Blueprint $table) {
            $table->string('movements_type')->default('user')->comment('to_resturant_or_user_or_topup');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('customer_wallet_transactions', function (Blueprint $table) {
            $table->string('movements_type')->default('user')->comment('to_resturant_or_user_or_topup');
        });
    }
};
