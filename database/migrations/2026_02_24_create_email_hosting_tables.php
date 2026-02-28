<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Email Hosting Plans
        Schema::create('email_hosting_plans', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // e.g., "Professional Email"
            $table->string('sku_code')->unique();
            $table->text('description')->nullable();
            $table->decimal('price_per_mailbox', 12, 2); // Monthly price per mailbox
            $table->decimal('domain_price', 12, 2); // Domain registration price
            $table->integer('storage_gb')->default(50); // Storage per mailbox
            $table->integer('mailboxes_included')->default(1); // Number of mailboxes
            $table->json('features')->nullable(); // Features list
            $table->string('status')->default('active');
            $table->timestamps();
        });

        // Domains
        Schema::create('domains', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->unsignedBigInteger('email_hosting_plan_id')->nullable();
            $table->string('domain_name')->unique();
            $table->string('order_number')->unique();
            $table->string('status')->default('pending'); // pending, registered, active, expired
            $table->string('registrar')->nullable(); // e.g., "Namecheap", "GoDaddy"
            $table->string('registrar_domain_id')->nullable(); // ID from registrar
            $table->decimal('price', 12, 2);
            $table->date('registered_date')->nullable();
            $table->date('expiration_date')->nullable();
            $table->date('auto_renew_date')->nullable();
            $table->boolean('auto_renew')->default(true);
            $table->json('whois_info')->nullable(); // WHOIS information
            $table->timestamps();
            
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('email_hosting_plan_id')->references('id')->on('email_hosting_plans')->onDelete('set null');
        });

        // Email Accounts
        Schema::create('email_accounts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('domain_id');
            $table->string('email_address')->unique();
            $table->string('mailbox_name'); // Before @ symbol
            $table->string('password');
            $table->string('status')->default('active'); // active, inactive, suspended
            $table->string('imap_host')->nullable();
            $table->string('smtp_host')->nullable();
            $table->integer('imap_port')->default(993);
            $table->integer('smtp_port')->default(587);
            $table->boolean('imap_ssl')->default(true);
            $table->boolean('smtp_tls')->default(true);
            $table->decimal('storage_gb', 5, 2)->default(50);
            $table->decimal('storage_used_gb', 5, 2)->default(0);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
            
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('domain_id')->references('id')->on('domains')->onDelete('cascade');
        });

        // Email Hosting Orders
        Schema::create('email_hosting_orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('domain_id');
            $table->unsignedBigInteger('email_hosting_plan_id');
            $table->string('order_number')->unique();
            $table->decimal('domain_price', 12, 2);
            $table->decimal('hosting_price', 12, 2);
            $table->decimal('total_amount', 12, 2);
            $table->string('status')->default('pending'); // pending, completed, cancelled
            $table->string('payment_method')->nullable();
            $table->string('payment_status')->default('pending'); // pending, paid, failed
            $table->timestamp('payment_date')->nullable();
            $table->json('order_data')->nullable(); // Additional order info
            $table->timestamps();
            
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('domain_id')->references('id')->on('domains')->onDelete('cascade');
            $table->foreign('email_hosting_plan_id')->references('id')->on('email_hosting_plans')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('email_hosting_orders');
        Schema::dropIfExists('email_accounts');
        Schema::dropIfExists('domains');
        Schema::dropIfExists('email_hosting_plans');
    }
};
