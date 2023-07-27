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
        Schema::create('detail_transactions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('transaction_id');
            $table->unsignedBigInteger('course_id');
            $table->date('start_date');
            $table->date('end_date');
            $table->integer('total_month');
            $table->string('sub_total');
            $table->string('total_payment');
            $table->timestamps();

            $table->foreign('transaction_id')->references('id')->on('transactions');
            $table->foreign('course_id')->references('id')->on('courses');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_transactions');

        Schema::table('detail_transactions', function (Blueprint $table) {
            $table->dropForeign(['transaction_id']);
            $table->dropForeign(['course_id']);
        });
    }
};
