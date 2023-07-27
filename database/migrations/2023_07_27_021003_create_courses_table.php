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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('category_id')->nullable();
            $table->string('title');
            $table->text('short_description');
            $table->text('description');
            $table->longText('file')->nullable();
            $table->longText('main_image');
            $table->longText('sneek_peek_1')->nullable();
            $table->longText('sneek_peek_2')->nullable();
            $table->longText('sneek_peek_3')->nullable();
            $table->longText('sneek_peek_4')->nullable();
            $table->string('price');
            $table->integer('request_status')->default(0);
            $table->integer('upload_status')->default(0);
            $table->integer('activation_status')->default(0);
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
