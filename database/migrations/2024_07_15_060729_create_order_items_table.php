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
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained('orders')
                ->onUpdate('cascade')->onDelete('restrict');

            $table->foreignId('parent_id')->nullable()->constrained('order_items')
                ->onUpdate('cascade')->onDelete('restrict');

            $table->bigInteger('item_id');

            $table->string('type');
            $table->float('price')->default(0);
            $table->float('discount')->default(0);
            $table->integer('quantity')->default(1);
            $table->float('total')->default(0);
            
            $table->tinyInteger('action_type')->default(1); //1 for adding 2 for removing
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
