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
        Schema::table('manufacturers', function (Blueprint $table) {
            $table->string('registration_authority')->constrained('manufacturerauthorities');
            $table->foreignId('country_id')->constrained('countries');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('manufacturers', function (Blueprint $table) {
            $table->dropForeign(['registration_authority']);
            $table->dropForeign(['country_id']);
        });
    }
};
