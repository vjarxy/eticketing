<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // First, expand the enum to include both 'valid' and 'active'
        Schema::table('e_tickets', function (Blueprint $table) {
            $table->enum('status', ['valid', 'active', 'used', 'expired'])->default('valid')->change();
        });

        // Update existing 'valid' status to 'active'
        DB::statement("UPDATE e_tickets SET status = 'active' WHERE status = 'valid'");

        // Finally, remove 'valid' from the enum
        Schema::table('e_tickets', function (Blueprint $table) {
            $table->enum('status', ['active', 'used', 'expired'])->default('active')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('e_tickets', function (Blueprint $table) {
            // Revert status enum to original values
            $table->enum('status', ['valid', 'used', 'expired'])->default('valid')->change();
        });

        // Update 'active' status back to 'valid'
        DB::statement("UPDATE e_tickets SET status = 'valid' WHERE status = 'active'");
    }
};
