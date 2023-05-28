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
        Schema::create('nutrients', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('common_name');
            $table->string('unit_of_expression')->nullable();
            $table->string('rda');
            $table->string('minimum');
            $table->string('permissable_unit')->nullable();
            $table->string('permissable_overage')->nullable();
            $table->text('caution')->nullable();
            $table->string('usable_part')->nullable();
            $table->foreignId('nutrient_category')->nullable()->constrained('nutrientcategories');
            $table->foreignId('author_id')->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('nutrients');
    }
};
