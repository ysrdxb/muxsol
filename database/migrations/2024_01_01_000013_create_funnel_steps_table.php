<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('funnel_steps', function (Blueprint $table) {
            $table->id();
            $table->foreignId('funnel_id')->constrained()->onDelete('cascade');
            $table->string('name');
            $table->string('slug');
            $table->string('type');
            $table->json('content')->nullable();
            $table->json('settings')->nullable();
            $table->integer('order')->default(0);
            $table->boolean('is_active')->default(true);
            $table->unsignedBigInteger('views')->default(0);
            $table->unsignedBigInteger('conversions')->default(0);
            $table->timestamps();

            $table->unique(['funnel_id', 'slug']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('funnel_steps');
    }
};
