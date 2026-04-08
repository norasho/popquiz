<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('questions', function (Blueprint $table) {
            $table->text('question_text_ar')->nullable()->after('question_text');
            $table->string('hint_ar')->nullable()->after('hint');
        });

        Schema::table('answers', function (Blueprint $table) {
            $table->string('answer_text_ar')->nullable()->after('answer_text');
        });
    }

    public function down(): void
    {
        Schema::table('questions', function (Blueprint $table) {
            $table->dropColumn(['question_text_ar', 'hint_ar']);
        });

        Schema::table('answers', function (Blueprint $table) {
            $table->dropColumn('answer_text_ar');
        });
    }
};
