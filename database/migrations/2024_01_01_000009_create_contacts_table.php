<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email');
            $table->string('phone')->nullable();
            $table->string('company')->nullable();
            $table->text('message')->nullable();
            $table->string('source')->default('contact_form');
            $table->string('status')->default('new');
            $table->json('metadata')->nullable();
            $table->timestamps();

            $table->index(['status']);
            $table->index(['source']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};
