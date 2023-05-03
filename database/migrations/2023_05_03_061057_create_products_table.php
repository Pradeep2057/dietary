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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('status')->default('Pending');
            $table->string('health_claim');
            $table->string('nutritional_claim');
            $table->string('expirydate_claim');
            $table->string('medical_statement');
            $table->string('diagnose_statement');
            $table->string('dietary_supplement');
            $table->string('product_specification');
            $table->string('specification_rational');
            $table->string('analysis_method');
            $table->string('process_flow');
            $table->string('gmp_certificate');
            $table->string('gmp_validity_upto');
            $table->string('coa_inhouse');
            $table->string('coa_thirdparty');
            $table->string('coa_product_standard');
            $table->string('authorization_letter');
            $table->string('sale_certificate');
            $table->string('product_label');
            $table->string('product_registration_certificate');
            $table->string('composition');
            $table->string('overall_openion');
            $table->foreignId('importer_id')->constrained('importers');
            $table->foreignId('manufacturer_id')->constrained('manufacturers');
            $table->foreignId('gmp_id')->constrained('agencies');
            $table->foreignId('product_type')->constrained('producttypes');
            $table->foreignId('product_form')->constrained('productforms');
            $table->foreignId('dose_id')->constrained('doses');
            $table->foreignId('size_id')->constrained('sizes');
            $table->foreignId('ingredient_id')->constrained('ingredients');
            $table->foreignId('lab_id')->constrained('labs');
            $table->foreignId('capital_id')->constrained('capitals');
            $table->foreignId('author_id')->constrained('users');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
