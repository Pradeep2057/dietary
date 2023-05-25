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
        Schema::create('reports', function (Blueprint $table) {
            $table->id();
            $table->date('date_of_grant');
            $table->date('validity_from');
            $table->date('validity_to');
            $table->date('gmp_validity');
            $table->date('date_of_preparation');
            $table->string('application_number');
            $table->string('prepared_by');
            $table->string('post');
            $table->string('certificate_category')->default('Production Registration');
            $table->string('production_report')->nullable();
            $table->string('status')->default('Processing');
            // $table->foreignId('product_id')->constrained('products');
            $table->foreignId('author_id')->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reports');
    }
};
