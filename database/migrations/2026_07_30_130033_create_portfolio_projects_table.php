<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('portfolio_projects', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('url')->unique();
            $table->string('hero_heading', 500)->nullable();
            $table->longText('hero_description')->nullable();
            $table->string('hero_model')->nullable(); // glb/gltf filename
            $table->string('banner_image')->nullable();
            $table->longText('overview_description')->nullable();
            $table->string('industry_ids')->nullable(); // comma-separated Industry IDs
            $table->longText('services')->nullable();   // JSON array of tag strings
            $table->longText('challenge_description')->nullable();
            $table->longText('approach_description')->nullable();
            $table->string('gallery_heading')->nullable();
            $table->longText('gallery_description')->nullable();
            $table->boolean('status')->default(1);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('portfolio_projects');
    }
};
