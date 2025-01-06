<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('pattern_tag', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pattern_id');
            $table->unsignedBigInteger('tag_id');
            $table->timestamps();

            // Foreign key constraints
            $table->foreign('pattern_id')->references('id')->on('patterns')->onDelete('cascade');
            $table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');

            // Define a unique constraint for the combination of pattern and tag to avoid duplicates
            $table->unique(['pattern_id', 'tag_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pattern_tag');
    }
};
