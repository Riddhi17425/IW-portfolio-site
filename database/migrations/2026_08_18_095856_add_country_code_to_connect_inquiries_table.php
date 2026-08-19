<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('connect_inquiries', function (Blueprint $table) {
            $table->string('country_code', 5)->default('+91')->after('contact_number');
        });
    }

    public function down(): void
    {
        Schema::table('connect_inquiries', function (Blueprint $table) {
            $table->dropColumn('country_code');
        });
    }
};