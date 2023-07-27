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
        Schema::create('rented_course', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('detail_transaction_id');
            $table->unsignedBigInteger('customer_id');
            $table->integer('rental_status');
            $table->date('expired_date');
            $table->date('renewal_date');
            $table->string('renewal_fee');
            $table->timestamps();

            $table->foreign('detail_transaction_id')->references('id')->on('detail_transactions');
            $table->foreign('customer_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rented_course');

        Schema::table('rented_course', function (Blueprint $table) {
            $table->dropForeign(['detail_transaction_id']);
            $table->dropForeign(['customer_id']);
        });
    }
};
