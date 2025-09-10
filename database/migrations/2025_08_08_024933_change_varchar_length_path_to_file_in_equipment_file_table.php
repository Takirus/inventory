<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('equipment_file', function (Blueprint $table) {
            DB::statement('ALTER TABLE equipment_files ALTER COLUMN path_to_file TYPE VARCHAR(255);');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('equipment_file', function (Blueprint $table) {
            DB::statement('ALTER TABLE equipment_files ALTER COLUMN path_to_file TYPE VARCHAR(50);');
        });
    }
};
