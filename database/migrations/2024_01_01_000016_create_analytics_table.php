<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('analytics', function (Blueprint $table) {
            $table->id();
            $table->string('type');
            $table->foreignId('page_id')->nullable()->constrained()->onDelete('set null');
            $table->string('url');
            $table->string('referrer')->nullable();
            $table->text('user_agent')->nullable();
            $table->string('ip_address', 45)->nullable();
            $table->string('country')->nullable();
            $table->string('city')->nullable();
            $table->string('device')->nullable();
            $table->string('browser')->nullable();
            $table->string('os')->nullable();
            $table->string('session_id')->nullable();
            $table->json('metadata')->nullable();
            $table->timestamp('created_at');

            $table->index(['type', 'created_at']);
            $table->index(['page_id', 'created_at']);
            $table->index(['session_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('analytics');
    }
};
