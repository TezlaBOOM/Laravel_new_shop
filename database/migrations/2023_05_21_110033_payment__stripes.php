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
        Schema::create('payment_stripes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();           
            $table->float('amount', 10,2);
            $table->string('currency');
            $table->integer('quantity');        
            $table->string('payment_status'); 
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_stripes');
    }
};