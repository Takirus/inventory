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
        Schema::create('request_status_history', function (Blueprint $table) {
            $table->id();
            $table->integer('request_id')->nullable();
            $table->foreign('request_id')->references('id')
            ->on('requests')->onDelete('cascade');
            $table->integer('status_id')->nullable();
            $table->foreign('status_id')->references('id')
            ->on('request_statuses');
            $table->integer('changed_by_user_id')->nullable();
            $table->foreign('changed_by_user_id')->references('id')
            ->on('users');
            $table->timestamp('changed_at')->nullable();
            $table->timestamp('closed_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('request_status_history');
    }
};
