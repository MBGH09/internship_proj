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
        Schema::create('mb_events', function (Blueprint $table) {
            
            $table->id('mb_event_id');
            $table->string('mb_title');
            $table->longText('mb_description');
            
           
            $table->dateTime('mb_start_date');
            
           
            $table->dateTime('mb_end_date');
            
            $table->string('mb_place');
            
            $table->decimal('mb_price', 8, 2)->default(0);
            
            $table->boolean('mb_is_free')->default(false);
    
            $table->integer('mb_capacity');
            
            $table->string('mb_image')->nullable();
    
            $table->unsignedBigInteger('mb_category_id');
            $table->foreign('mb_category_id')->references('mb_cat_id')->on('mb_categories')->onDelete('cascade');
            
            $table->unsignedBigInteger('mb_created_by');
            $table->foreign('mb_created_by')->references('mb_id')->on('mb_users')->onDelete('cascade');
            
            $table->boolean('mb_is_active')->default(true);
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mb_events');
    }
};
