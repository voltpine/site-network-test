<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sites', function (Blueprint $table) {
            $table->id();
            $table->string('domain')->unique();
            $table->string('name');
            $table->string('tagline')->nullable();
            $table->string('theme')->default('default');
            $table->string('locale')->default('zh-CN');
            $table->timestamps();
        });

        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('site_id')->constrained()->cascadeOnDelete();
            $table->string('slug');
            $table->string('name');
            $table->string('lede')->nullable();
            $table->string('scene')->nullable();
            $table->unsignedInteger('sort')->default(0);
            $table->timestamps();

            $table->unique(['site_id', 'slug']);
        });

        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('site_id')->constrained()->cascadeOnDelete();
            $table->foreignId('category_id')->constrained()->cascadeOnDelete();
            $table->string('slug');
            $table->string('title');
            $table->string('description')->nullable();
            $table->text('summary')->nullable();
            $table->longText('body');
            $table->string('status')->default('published');
            $table->unsignedSmallInteger('reading_minutes')->default(5);
            $table->date('published_at')->nullable();
            $table->timestamps();

            $table->unique(['site_id', 'category_id', 'slug']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('articles');
        Schema::dropIfExists('categories');
        Schema::dropIfExists('sites');
    }
};
