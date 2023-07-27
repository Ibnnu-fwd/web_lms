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
        Schema::create('course_sub_chapters', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('course_chapter_id');
            $table->string('title');
            $table->longText('file')->nullable();
            $table->longText('video')->nullable();
            $table->timestamps();

            $table->foreign('course_chapter_id')
                ->references('id')
                ->on('course_chapters');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('course_sub_chapters');
        Schema::table('course_sub_chapters', function (Blueprint $table) {
            $table->dropForeign(['course_chapter_id']);
        });
    }
};
