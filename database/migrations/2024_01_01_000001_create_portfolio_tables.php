<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description');
            $table->text('long_description')->nullable();
            $table->string('category'); // web, mobile, design, etc
            $table->json('tech_stack')->nullable(); // ["Laravel", "Vue.js", "MySQL"]
            $table->string('image')->nullable();
            $table->string('url_live')->nullable();
            $table->string('url_github')->nullable();
            $table->boolean('featured')->default(false);
            $table->integer('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });

        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('title'); // "Full Stack Developer"
            $table->string('tagline'); // "I build beautiful web apps"
            $table->text('about');
            $table->string('email');
            $table->string('phone')->nullable();
            $table->string('location')->nullable();
            $table->string('github')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('instagram')->nullable();
            $table->string('twitter')->nullable();
            $table->string('avatar')->nullable();
            $table->json('skills')->nullable(); // [{"name":"Laravel","level":90}, ...]
            $table->json('services')->nullable();
            $table->timestamps();
        });

        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('subject')->nullable();
            $table->text('message');
            $table->boolean('is_read')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contacts');
        Schema::dropIfExists('profiles');
        Schema::dropIfExists('projects');
    }
};
