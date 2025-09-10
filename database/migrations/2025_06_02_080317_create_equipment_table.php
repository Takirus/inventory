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
        Schema::create('equipment', function (Blueprint $table) {
            $table->id();
            $table->integer('type_id')->nullable();
            $table->string('serial_code')->unique()->nullable();
            $table->string('manufacturer')->nullable();
            $table->string('model')->nullable();
            $table->string('status')->nullable();
            $table->integer('user_id')->nullable();
            $table->foreign('type_id')->references('id')
            ->on('type_equipment');
            $table->foreign('user_id')->references('id')
            ->on('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipment');
    }
};
