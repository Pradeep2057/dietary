<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Nutrients extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'common_name',
        'unit_of_expression',
        'rda',
        'minimum',
        'permissable_unit',
        'permissable_overage',
        'caution',
        'usable_part',
        'nutrient_category',
        'author_id',
    ];

    public function nutrientcategory(): BelongsTo
    {
        return $this->belongsTo(Nutrientcategory::class, 'nutrient_category');
    }
}
