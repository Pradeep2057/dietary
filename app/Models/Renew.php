<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Renew extends Model
{
    use HasFactory;

    protected $fillable = [
        'prepared_by',
        'post',
        'renew_valid',
        'date_of_preparation',
        'gmp_validity',
        'date_of_grant',
        'gmp_validity_from',
        'gmp_validity_to',
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
