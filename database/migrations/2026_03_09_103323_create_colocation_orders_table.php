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
	Schema::create('colocation_orders', function (Blueprint $table) {
    $table->id();
    $table->foreignId('customer_id')->constrained('users')->onDelete('cascade');
    $table->foreignId('colocation_sku_id')->nullable()->constrained('colocation_skus');
    $table->string('order_number')->unique();
    $table->string('colocation_type'); // standard, premium, enterprise
    $table->decimal('monthly_cost', 12, 2);
    $table->string('location');
    $table->string('power_requirement');
    $table->string('organization_name');
    $table->string('contact_name');
    $table->string('email');
    $table->string('payment_method');
    $table->string('payment_status')->default('pending');
    $table->string('status')->default('pending');
    $table->text('special_requirements')->nullable();
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('colocation_orders');
    }
};
