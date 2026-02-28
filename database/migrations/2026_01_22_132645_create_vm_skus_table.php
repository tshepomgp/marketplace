<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('vm_skus', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description')->nullable();
            $table->integer('vcpus');
            $table->integer('ram_gb');
            $table->decimal('price_monthly', 12, 2);
            $table->string('currency', 10);
            $table->boolean('is_active')->default(true);
            $table->timestamps(); // creates `created_at` and `updated_at`
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('vm_skus');
    }
};
