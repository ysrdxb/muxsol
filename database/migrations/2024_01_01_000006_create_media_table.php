<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('media', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('file_name');
            $table->string('mime_type');
            $table->string('path');
            $table->string('disk')->default('public');
            $table->unsignedBigInteger('size');
            $table->json('dimensions')->nullable();
            $table->string('alt_text')->nullable();
            $table->string('caption')->nullable();
            $table->string('folder')->default('/');
            $table->foreignId('uploaded_by')->constrained('users')->onDelete('cascade');
            $table->timestamps();

            $table->index(['folder']);
            $table->index(['mime_type']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('media');
    }
};
