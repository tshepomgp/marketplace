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
	Schema::create('colocation_payments', function (Blueprint $table) {
    $table->id();
    $table->foreignId('colocation_order_id')->constrained('colocation_orders')->onDelete('cascade');
    $table->foreignId('colocation_sku_id')->constrained('colocation_skus')->onDelete('cascade');
    $table->foreignId('customer_id')->constrained('users')->onDelete('cascade');
    $table->decimal('amount', 12, 2);
    $table->string('payment_method'); // mtn_momo, card, credit
    $table->string('payment_status')->default('pending'); // pending, completed, failed
    $table->string('transaction_id')->nullable();
    $table->timestamp('paid_at')->nullable();
    $table->json('metadata')->nullable();
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('colocation_payments');
    }
};
