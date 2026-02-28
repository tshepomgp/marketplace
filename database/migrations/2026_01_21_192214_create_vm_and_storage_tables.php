<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // VM SKUs Table
        Schema::create('vm_skus', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->integer('vcpus');
            $table->integer('ram_gb');
            $table->decimal('price_monthly', 10, 2);
            $table->string('currency', 3)->default('XAF');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Operating Systems Table
        Schema::create('operating_systems', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('version');
            $table->string('type'); // Windows, Linux
            $table->decimal('license_cost', 10, 2)->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // Storage SKUs Table
        Schema::create('storage_skus', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('type'); // SSD, HDD
            $table->integer('min_size_gb');
            $table->integer('max_size_gb');
            $table->decimal('price_per_gb_monthly', 10, 2);
            $table->string('currency', 3)->default('XAF');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        // VM Orders Table
        Schema::create('vm_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained()->onDelete('cascade');
            $table->string('order_number')->unique();
            $table->foreignId('vm_sku_id')->constrained()->onDelete('restrict');
            $table->foreignId('operating_system_id')->constrained()->onDelete('restrict');
            $table->integer('disk_size_gb');
            $table->integer('quantity')->default(1);
            $table->string('vm_name')->nullable();
            $table->text('notes')->nullable();
            $table->decimal('monthly_cost', 10, 2);
            $table->decimal('setup_fee', 10, 2)->default(0);
            $table->string('currency', 3)->default('XAF');
            $table->string('status')->default('pending'); // pending, approved, provisioning, active, cancelled
            $table->timestamp('approved_at')->nullable();
            $table->timestamp('provisioned_at')->nullable();
            $table->timestamps();
        });

        // Storage Orders Table
        Schema::create('storage_orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained()->onDelete('cascade');
            $table->string('order_number')->unique();
            $table->foreignId('storage_sku_id')->constrained()->onDelete('restrict');
            $table->integer('size_gb');
            $table->integer('quantity')->default(1);
            $table->string('storage_name')->nullable();
            $table->text('notes')->nullable();
            $table->decimal('monthly_cost', 10, 2);
            $table->string('currency', 3)->default('XAF');
            $table->string('status')->default('pending'); // pending, approved, provisioning, active, cancelled
            $table->timestamp('approved_at')->nullable();
            $table->timestamp('provisioned_at')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('storage_orders');
        Schema::dropIfExists('vm_orders');
        Schema::dropIfExists('storage_skus');
        Schema::dropIfExists('operating_systems');
        Schema::dropIfExists('vm_skus');
    }
};
