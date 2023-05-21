<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
//należy połóczyc tabele ze sobą , migracja standardowa nie działa z jakiegoś powodu 
// use in phpmyadmin: ALTER TABLE `payment_paypal_product` ADD FOREIGN KEY (`paypal_id`) REFERENCES `payment_paypals`(`id`) ON DELETE RESTRICT ON UPDATE RESTRICT; ALTER TABLE `payment_paypal_product` ADD FOREIGN KEY (`product_id`) REFERENCES `products`(`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
    public function up(): void
    {
        Schema::create('payment_paypal_product', function (Blueprint $table) {

                $table->foreignId('payment_paypal_id')->constrained();
                $table->foreignId('product_id')->constrained();

        });
    }

 
    public function down(): void
    {
        Schema::dropIfExists('payment_paypal_product');
    }
};