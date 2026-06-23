<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('location');
            $table->string('price');
            $table->decimal('price_value', 12, 2);
            $table->integer('beds');
            $table->integer('baths');
            $table->integer('sqft');
            $table->text('image');
            $table->longText('description');
            $table->json('features');
            $table->integer('built_year');
            $table->string('tag')->nullable();
            $table->string('tag_color')->default('amber');
            $table->boolean('is_featured')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};