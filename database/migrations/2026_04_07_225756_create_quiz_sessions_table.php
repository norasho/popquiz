<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('quiz_sessions', function (Blueprint $table) {
            $table->id();
            $table->string('player_id', 36)->index(); // UUID
            $table->string('player_short_id', 10)->nullable();
            $table->foreignId('quiz_id')->constrained()->onDelete('cascade');
            $table->string('player_name');
            $table->string('player_emoji')->default('🎯');
            $table->integer('current_index')->default(0);
            $table->integer('score')->default(0);
            $table->string('phase')->default('intro'); // intro, question, result, finished
            $table->timestamp('last_seen_at')->nullable();
            $table->timestamps();

            $table->unique(['player_id', 'quiz_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('quiz_sessions');
    }
};
