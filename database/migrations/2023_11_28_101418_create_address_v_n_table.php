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
        // Create tables with prerequisite data
		DB::unprepared(file_get_contents(public_path('databaseVN/CreateTables_vn_units.sql')));
		DB::unprepared(file_get_contents(public_path('databaseVN/ImportData_vn_units.sql')));

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Drop tables
		Schema::dropIfExists('wards');
		Schema::dropIfExists('districts');
		Schema::dropIfExists('provinces');
		Schema::dropIfExists('administrative_units');
		Schema::dropIfExists('administrative_regions');
    }
};
