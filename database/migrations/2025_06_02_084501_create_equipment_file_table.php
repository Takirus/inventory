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
        Schema::create('equipment_files', function (Blueprint $table) {
            $table->id();
            $table->string('path_to_file',50);
            $table->integer('equipment_id');
            $table->integer('type_file_id');
            $table->foreign('type_file_id')->references('id')
            ->on('type_equipment_files');
            $table->foreign('equipment_id')->references('id')
            ->on('equipment')
            ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipment_files');
    }
};
