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
        Schema::table('caregivers', function (Blueprint $table) {
             $table->boolean('medical_background')->default(false)->after('skills');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('caregivers', function (Blueprint $table) {
            $table->dropColumn('medical_background');
        });
    }
};
