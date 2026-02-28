<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('email_hosting_plans', function (Blueprint $table) {
            // Drop and recreate the column as JSON
            $table->json('features')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('email_hosting_plans', function (Blueprint $table) {
            $table->longText('features')->nullable()->change();
        });
    }
};