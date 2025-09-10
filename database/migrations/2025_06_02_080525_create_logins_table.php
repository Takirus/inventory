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
        Schema::create('logins', function (Blueprint $table) {
            $table->id();
            $table->integer('software_id');
            $table->integer('equipment_id');
            $table->integer('user_id')->nullable();
            $table->string('login');
            $table->string('password')->nullable();
            $table->text('comment')->nullable();
            $table->foreign('software_id')->references('id')
            ->on('software');
            $table->foreign('equipment_id')->references('id')
            ->on('equipment')
            ->onDelete('cascade');
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
        Schema::dropIfExists('logins');
    }
};
