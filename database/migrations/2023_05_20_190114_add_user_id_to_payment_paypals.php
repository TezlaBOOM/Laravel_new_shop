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
        Schema::table('payment_paypals', function (Blueprint $table) {
            $table->integer('quantity')->after('amount');
            $table->foreignId('user_id')->constrained()->after('payer_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('payment_paypals', function (Blueprint $table) {
            //
        });
    }
};
