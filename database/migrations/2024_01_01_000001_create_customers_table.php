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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('microsoft_customer_id')->unique()->nullable();
            $table->string('company_name');
            $table->string('domain')->unique();
            $table->string('email');
            $table->string('phone');
            $table->string('country', 2);
            $table->string('city');
            $table->string('state')->nullable();
            $table->string('address');
            $table->string('postal_code');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('language', 5)->default('en');
            $table->string('currency', 3)->default('USD');
            $table->enum('status', ['active', 'suspended', 'deleted'])->default('active');
            $table->json('metadata')->nullable();
            $table->timestamps();
            $table->softDeletes();
            
            $table->index('microsoft_customer_id');
            $table->index('status');
            $table->index('country');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
