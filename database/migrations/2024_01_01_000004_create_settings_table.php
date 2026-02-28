<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('key')->unique();
            $table->text('value')->nullable();
            $table->string('type')->default('string'); // string, boolean, integer, json
            $table->string('group')->default('general'); // general, branding, payment, microsoft
            $table->text('description')->nullable();
            $table->boolean('is_public')->default(false); // Can be exposed to frontend
            $table->timestamps();
            
            $table->index('key');
            $table->index('group');
        });
        
        // Insert default branding settings
        DB::table('settings')->insert([
            [
                'key' => 'branding.company_name',
                'value' => 'MTN Cameroon',
                'type' => 'string',
                'group' => 'branding',
                'description' => 'Company name displayed across the platform',
                'is_public' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'branding.logo',
                'value' => '/images/mtn-cameroon-logo.png',
                'type' => 'string',
                'group' => 'branding',
                'description' => 'Main logo path',
                'is_public' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'branding.primary_color',
                'value' => '#FFCB05',
                'type' => 'string',
                'group' => 'branding',
                'description' => 'Primary brand color',
                'is_public' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'branding.currency',
                'value' => 'XAF',
                'type' => 'string',
                'group' => 'branding',
                'description' => 'Default currency code',
                'is_public' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'key' => 'branding.country',
                'value' => 'CM',
                'type' => 'string',
                'group' => 'branding',
                'description' => 'Country code',
                'is_public' => true,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
