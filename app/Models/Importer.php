<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Importer extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'address',
        'pan',
        'firm_no',
        'exim_code',
        'contact_number',
        'contact_person',
    ];

    // public function products()
    // {
    //     return $this->hasMany(Product::class);
    // }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_importer');
    }
}
