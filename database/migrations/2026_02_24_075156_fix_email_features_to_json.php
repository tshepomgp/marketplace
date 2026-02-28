<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // Drop old column and recreate as JSON
        DB::statement('ALTER TABLE email_hosting_plans DROP COLUMN features');
        DB::statement('ALTER TABLE email_hosting_plans ADD COLUMN features JSON NULL AFTER mailboxes_included');
    }

    public function down(): void
    {
        DB::statement('ALTER TABLE email_hosting_plans DROP COLUMN features');
        DB::statement('ALTER TABLE email_hosting_plans ADD COLUMN features LONGTEXT NULL AFTER mailboxes_included');
    }
};