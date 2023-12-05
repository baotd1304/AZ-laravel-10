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
        Schema::table('users', function (Blueprint $table) {
            $table->after('email', function (Blueprint $table){
                $table->string('phone', 20)->nullable();
                $table->string('province_id', 20)->nullable();
                $table->string('district_id', 20)->nullable();
                $table->string('ward_id', 20)->nullable();
                $table->string('address')->nullable();
                $table->dateTime('birthday')->nullable();
                $table->string('image')->nullable();
                $table->tinyInteger('role')->default(0)->comment('0 la client, 1 admin');
                $table->tinyInteger('publish')->default(0)->comment('0 la inactive, 1 active');
                $table->text('description')->nullable();
                $table->text('user_agent')->nullable();
                $table->text('ip')->nullable();
            });
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('phone');
            $table->dropColumn('province_id');
            $table->dropColumn('district_id');
            $table->dropColumn('ward_id');
            $table->dropColumn('address');
            $table->dropColumn('birthday');
            $table->dropColumn('image');
            $table->dropColumn('role');
            $table->dropColumn('active');
            $table->dropColumn('description');
            $table->dropColumn('user_agent');
            $table->dropColumn('ip');
        });
    }
};
