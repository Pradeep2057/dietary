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
        Schema::create('renewals', function (Blueprint $table) {
            $table->id();
            $table->date('valid_from');
            $table->date('valid_to');
            $table->date('date_of_preparation');
            $table->string('product_renewal')->nullable();
            $table->string('certificate_category')->default('Product Renewal');
            $table->string('tippani_category')->default('Tippani Renewal');
            $table->string('status')->default('Processing');
            $table->string('application_number');
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
        Schema::dropIfExists('renewals');
    }
};
