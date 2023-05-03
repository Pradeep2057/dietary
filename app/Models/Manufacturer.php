<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Manufacturer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'registration_number',
        'registration_validity',  
    ];

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    public function manufacturerauthority(): BelongsTo
    {
        return $this->belongsTo(Manufacturerauthority::class, 'registration_authority');
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
