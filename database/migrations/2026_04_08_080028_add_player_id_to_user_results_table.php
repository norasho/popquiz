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
        Schema::table('user_results', function (Blueprint $table) {
            $table->string('player_id')->nullable()->after('quiz_id');
        });
    }

    public function down(): void
    {
        Schema::table('user_results', function (Blueprint $table) {
            $table->dropColumn('player_id');
        });
    }
};
