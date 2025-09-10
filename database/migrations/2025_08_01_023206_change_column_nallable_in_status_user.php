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
        Schema::table('status_user', function (Blueprint $table) {
            DB::statement('ALTER TABLE status_user ALTER COLUMN date_to DROP NOT NULL');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('status_user', function (Blueprint $table) {
            DB::statement('ALTER TABLE status_user ALTER COLUMN date_to SET NOT NULL');
        });
    }
};
