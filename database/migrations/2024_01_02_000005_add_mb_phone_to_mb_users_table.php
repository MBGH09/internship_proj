<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Add column only if it does not already exist (avoid duplicate column error on re-run)
        if (!Schema::hasColumn('mb_users', 'mb_phone')) {
            Schema::table('mb_users', function (Blueprint $table) {
                $table->string('mb_phone')->nullable()->after('mb_email');
            });
        }
    }

    public function down(): void
    {
        if (Schema::hasColumn('mb_users', 'mb_phone')) {
            Schema::table('mb_users', function (Blueprint $table) {
                $table->dropColumn('mb_phone');
            });
        }
    }
};
