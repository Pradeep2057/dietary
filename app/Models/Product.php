<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'fy',
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

    public function expirydate(): BelongsTo
    {
        return $this->belongsTo(Expirydate::class, 'expirydate_id');
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

    public function fiscalyear()
    {
        return $this->belongsTo(Fiscalyear::class);
    }

    public function capital(): BelongsTo
    {
        return $this->belongsTo(Capital::class, 'capital_id');
    }

    public function reports()
    {
        return $this->hasMany(Report::class);
    }
    public function renews()
    {
        return $this->hasMany(Report::class);
    }

    public function registrations()
    {
        return $this->hasMany(Registration::class);
    }

    public function renewals()
    {
        return $this->hasMany(Renewal::class);
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }
    
    public function ingredients()
    {
        return $this->belongsToMany(Ingredient::class, 'product_ingredient')->withTimestamps();
    }
    public function compositions()
    {
        return $this->belongsToMany(Ingredient::class, 'product_composition')->withTimestamps();
    }
    public function importers()
    {
        return $this->belongsToMany(Importer::class, 'product_importer')->withTimestamps();
    }
}
