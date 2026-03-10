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

		Schema::create('colocation_skus', function (Blueprint $table) {
    $table->id();
    $table->string('name'); // e.g., "Standard Rack"
    $table->string('sku_code')->unique();
    $table->string('type'); // standard, premium, enterprise
    $table->integer('rack_units'); // 21U, 42U, 84U
    $table->string('power_supply'); // single, dual, three phase
    $table->decimal('monthly_price', 12, 2);
    $table->decimal('setup_fee', 12, 2)->default(0);
    $table->text('description')->nullable();
    $table->json('features')->nullable();
    $table->string('status')->default('active');
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('colocation_skus');
    }
};
