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
        Schema::create('registrations', function (Blueprint $table) {
            $table->id();
            $table->date('validity');
            $table->date('approval');
            $table->date('date_of_preparation');
            $table->string('application_number');
            $table->string('product_registration')->nullable();
            $table->string('certificate_category')->default('Product Registration');
            $table->string('status')->default('Processing');
            $table->foreignId('product_id')->constrained('products');
            $table->foreignId('author_id')->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('registrations');
    }
};
