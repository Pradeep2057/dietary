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
            $table->string('certificate_category')->default('Registration');
            $table->string('production_report')->nullable();
            $table->string('production_tippani')->nullable();
            $table->string('status')->default('Processing');
            $table->string('voucher_number')->nullable();
            $table->string('voucher_amount')->nullable();
            $table->foreignId('product_id')->constrained('products');
            $table->foreignId('author_id')->constrained('users');

            $table->foreignId('pending_id')->nullable()->constrained('users');
            $table->string('pending_at')->nullable();

            $table->foreignId('verifier_id')->nullable()->constrained('users');
            $table->string('verified_at')->nullable();

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
