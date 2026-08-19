<?php
// database/migrations/xxxx_xx_xx_add_media_group_to_portfolio_project_media_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('portfolio_project_media', function (Blueprint $table) {
            $table->string('media_group')->nullable()->after('sort_order');
        });
    }

    public function down(): void
    {
        Schema::table('portfolio_project_media', function (Blueprint $table) {
            $table->dropColumn('media_group');
        });
    }
};
