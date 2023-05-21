<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**PHPMYADMIN
     * ALTER TABLE `payment_stripe_product` ADD FOREIGN KEY (`product_id`) REFERENCES `products`(`id`) ON DELETE RESTRICT ON UPDATE RESTRICT; ALTER TABLE `payment_stripe_product` ADD FOREIGN KEY (`stripe_id`) REFERENCES `payment_stripes`(`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
     */
    public function up(): void
    {
        Schema::create('payment_stripe_product', function (Blueprint $table) {
            $table->foreignId('payment_stripe_id')->constrained();
            $table->foreignId('product_id')->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_stripe_product');
    }
};
