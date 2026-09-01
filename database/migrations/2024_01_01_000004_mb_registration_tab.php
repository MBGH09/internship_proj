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
        Schema::create('mb_registrations', function (Blueprint $table) {
            $table->id('mb_reg_id');
            $table->unsignedBigInteger('mb_event_id');
            $table->unsignedBigInteger('mb_user_id');
            $table->timestamps();
            $table->unique(['mb_event_id', 'mb_user_id']);

            // Ajouter les contraintes de clés étrangères
            $table->foreign('mb_event_id')
                  ->references('mb_event_id')
                  ->on('mb_events')
                  ->onDelete('cascade');

            $table->foreign('mb_user_id')
                  ->references('mb_id')
                  ->on('mb_users')
                  ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mb_registrations');
    }
};
