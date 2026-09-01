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
        Schema::create('mb_users', function (Blueprint $table) {
            $table->id('mb_id');
            $table->string('mb_name');
            $table->string('mb_email')->unique();
            $table->string('mb_password');
            $table->enum('mb_role', ['admin', 'user'])->default('user');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mb_users');
    }
};
