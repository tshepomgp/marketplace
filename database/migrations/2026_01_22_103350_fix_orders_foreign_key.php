<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Drop the incorrect foreign key
        DB::statement('ALTER TABLE orders DROP FOREIGN KEY orders_customer_id_foreign');
        
        // Add correct foreign key pointing to users table
        DB::statement('ALTER TABLE orders ADD CONSTRAINT orders_customer_id_foreign 
                     FOREIGN KEY (customer_id) REFERENCES users(id) ON DELETE CASCADE');
    }

    public function down(): void
    {
        DB::statement('ALTER TABLE orders DROP FOREIGN KEY orders_customer_id_foreign');
    }
};