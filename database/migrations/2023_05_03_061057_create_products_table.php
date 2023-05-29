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
            $table->string('code')->nullable();
            $table->string('name');
            $table->string('fy')->nullable()->constrained('fiscalyears');
            $table->string('registration')->nullable();
            $table->string('status')->default('Pending');
            $table->string('health_claim')->nullable();
            $table->string('nutritional_claim')->nullable();
            $table->string('medical_statement')->nullable();
            $table->string('diagnose_statement')->nullable();
            $table->string('dietary_supplement')->nullable();
            $table->string('product_specification')->nullable();
            $table->string('specification_rational')->nullable();
            $table->string('analysis_method')->nullable();
            $table->string('process_flow')->nullable();
            $table->string('gmp_certificate')->nullable();
            $table->string('gmp_validity_upto')->nullable();
            $table->string('coa_inhouse')->nullable();
            $table->string('coa_thirdparty')->nullable();
            $table->string('coa_product_standard')->nullable();
            $table->string('authorization_letter')->nullable();
            $table->string('sale_certificate')->nullable();
            $table->string('product_label')->nullable();
            $table->string('product_registration_certificate')->nullable();
            $table->string('overall_openion')->nullable();
            $table->text('ingredients')->nullable();
            $table->string('ingredient_unit')->nullable();
            $table->string('remarks')->nullable();
            $table->string('remarks_1')->nullable();
            $table->foreignId('expirydate_id')->nullable()->constrained('expirydates');
            $table->foreignId('manufacturer_id')->nullable()->constrained('manufacturers');
            $table->foreignId('gmp_id')->nullable()->constrained('agencies');
            $table->foreignId('product_type')->nullable()->constrained('producttypes');
            $table->foreignId('product_form')->nullable()->constrained('productforms');
            $table->foreignId('dose_id')->nullable()->constrained('doses');
            $table->foreignId('size_id')->nullable()->constrained('sizes');
            $table->foreignId('lab_id')->nullable()->constrained('labs');
            $table->foreignId('capital_id')->nullable()->constrained('capitals');
            $table->foreignId('category_id')->nullable()->constrained('categories');
            $table->foreignId('author_id')->constrained('users');
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
        Schema::dropIfExists('products');
    }
};
