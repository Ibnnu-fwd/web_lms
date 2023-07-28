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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('fullname');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->enum('gender', ['L', 'P'])->nullable();
            $table->date('birthday')->nullable();
            $table->longText('avatar')->nullable();
            $table->string('phone')->nullable();
            $table->string('job')->nullable();
            $table->string('institution')->nullable();
            $table->integer('role'); // 1 = admin, 2 = verificator, 3 = institution, 4 = user
            $table->integer('status'); // 0 = pending, 1 = active, 2 = inactive
            $table->integer('is_verificator')->nullable(); // 0 = not verificator, 1 = verificator
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
