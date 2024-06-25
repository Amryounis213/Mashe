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
        Schema::create('markets', function (Blueprint $table) {

            $table->bigIncrements('id');
            $table->string('name', 191);
            $table->string('phone', 20);
            $table->string('email', 100)->nullable();
            $table->string('logo', 191)->nullable();
            $table->string('latitude', 191)->nullable();
            $table->string('longitude', 191)->nullable();
            $table->text('address')->nullable();
            $table->text('footer_text')->nullable();
            $table->decimal('minimum_order', 24, 2)->default(0.00);
            $table->decimal('comission', 24, 2)->nullable();
            $table->tinyInteger('schedule_order')->default(0);
            $table->time('opening_time')->default('10:00:00')->nullable();
            $table->time('closing_time')->default('23:00:00')->nullable();
            $table->tinyInteger('status')->default(1);
            $table->bigInteger('vendor_id')->unsigned();
            $table->tinyInteger('free_delivery')->default(0);
            $table->string('rating', 191)->nullable();
            $table->string('cover_photo', 191)->nullable();
            $table->tinyInteger('delivery')->default(1);
            $table->tinyInteger('take_away')->default(1);
            $table->tinyInteger('food_section')->default(1);
            $table->decimal('tax', 24, 2)->default(0.00);
            $table->bigInteger('zone_id')->unsigned()->nullable();
            $table->tinyInteger('reviews_section')->default(1);
            $table->tinyInteger('active')->default(1);
            $table->string('off_day', 191);
            $table->string('gst', 191)->nullable();
            $table->tinyInteger('self_delivery_system')->default(0);
            $table->tinyInteger('pos_system')->default(0);
            $table->decimal('minimum_shipping_charge', 24, 2)->default(0.00);
            $table->string('delivery_time', 191)->default('30-40')->nullable();
            $table->tinyInteger('veg')->default(1);
            $table->tinyInteger('non_veg')->default(1);
            $table->integer('order_count')->unsigned()->default(0);
            $table->integer('total_order')->unsigned()->default(0);
            $table->double('per_km_shipping_charge', 16, 3)->unsigned()->nullable();
            $table->string('market_model', 50)->default('commission')->nullable();
            $table->double('maximum_shipping_charge', 23, 3)->nullable();
            $table->string('slug', 255)->nullable();
            $table->tinyInteger('order_subscription_active')->default(0)->nullable();
            $table->tinyInteger('cutlery')->default(0);
            $table->string('meta_title', 100)->nullable();
            $table->text('meta_description')->nullable();
            $table->string('meta_image', 100)->nullable();
            $table->tinyInteger('announcement')->default(0);
            $table->string('announcement_message', 255)->nullable();
            $table->text('qr_code')->nullable();
            $table->string('free_delivery_distance', 255)->nullable();
            $table->text('additional_data')->nullable();
            $table->text('additional_documents')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('markets');
    }
};
