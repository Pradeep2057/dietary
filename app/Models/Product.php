<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'status',
        'health_claim',
        'nutritional_claim',
        'expirydate_claim',
        'gmp_validity_upto',
        'coa_inhouse',
        'coa_thirdparty',
        'coa_product_standard',
        'authorization_letter',
        'sale_certificate',
        'product_label',
        'product_registration_certificate',
        'composition',
        'overall_openion',
        'diagnose_statement',
        'medical_statement',
        'dietary_supplement',
        'product_specification',
        'specification_rational',
        'analysis_method',
        'process_flow',
        'gmp_certificate'
    ];

    public function importer(): BelongsTo
    {
        return $this->belongsTo(Importer::class, 'importer_id');
    }

    public function manufacturer(): BelongsTo
    {
        return $this->belongsTo(Manufacturer::class, 'manufacturer_id');
    }

    public function agency(): BelongsTo
    {
        return $this->belongsTo(Agency::class, 'gmp_id');
    }

    public function producttype(): BelongsTo
    {
        return $this->belongsTo(Producttype::class, 'product_type');
    }

    public function productform(): BelongsTo
    {
        return $this->belongsTo(Productform::class, 'product_form');
    }

    public function dose(): BelongsTo
    {
        return $this->belongsTo(Dose::class, 'dose_id');
    }

    public function size(): BelongsTo
    {
        return $this->belongsTo(Size::class, 'size_id');
    }

    public function ingredient(): BelongsTo
    {
        return $this->belongsTo(Ingredient::class, 'ingredient_id');
    }

    public function lab(): BelongsTo
    {
        return $this->belongsTo(Lab::class, 'lab_id');
    }

    public function capital(): BelongsTo
    {
        return $this->belongsTo(Capital::class, 'capital_id');
    }
}
