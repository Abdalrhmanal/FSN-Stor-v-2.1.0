<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('soldlines', function (Blueprint $table) {
            $table->id();
            $table->string('first_image');
            $table->string('second_image');
            $table->unsignedBigInteger('simcard_id');
            $table->foreign('simcard_id')->references('id')->on('simcards')->onDelete('cascade'); // إضافة onDelete لتحديث الحقول المرتبطة
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('soldlines');
    }
};
