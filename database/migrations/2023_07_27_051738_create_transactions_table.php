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
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->longText('transaction_code');
            $table->string('transaction_type');
            $table->unsignedBigInteger('customer_id');
            $table->string('sub_total');
            $table->string('total_payment');
            $table->integer('status_order')->default(0);
            $table->integer('status_payment')->default(0);
            $table->timestamps();

            $table->foreign('customer_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transactions');
        Schema::table('transactions', function (Blueprint $table) {
            $table->dropForeign(['customer_id']);
        });
    }
};
