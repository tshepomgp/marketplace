<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('storage_orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->string('order_number')->unique();
            $table->string('storage_type')->nullable();
            $table->decimal('storage_size', 8, 2)->default(1);
            $table->decimal('monthly_cost', 12, 2)->default(0);
            $table->string('billing_cycle')->default('monthly');
            $table->date('renewal_date')->nullable();
            $table->string('status')->default('pending');
            $table->string('access_endpoint')->nullable();
            $table->string('purpose')->nullable();
            $table->string('location')->nullable();
            $table->text('special_requirements')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('storage_orders');
    }
};