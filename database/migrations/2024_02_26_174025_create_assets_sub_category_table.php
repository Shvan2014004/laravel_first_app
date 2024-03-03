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
        //Schema::dropIfExists('assets_sub_category');
        Schema::create('assets_sub_category', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('sub_category');
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')->references('id')->on('assets_category')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assets_sub_category');
    }
};
