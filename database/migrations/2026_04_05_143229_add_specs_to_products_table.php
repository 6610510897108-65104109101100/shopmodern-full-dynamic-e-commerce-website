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
        Schema::table('products', function (Blueprint $table) {
            $table->string('fabric_type')->nullable()->after('colors');
            $table->string('yarn_count')->nullable()->after('fabric_type');
            $table->string('composition')->nullable()->after('yarn_count');
            $table->string('gsm')->nullable()->after('composition');
            $table->string('color_type')->nullable()->after('gsm');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['fabric_type', 'yarn_count', 'composition', 'gsm', 'color_type']);
        });
    }
};
