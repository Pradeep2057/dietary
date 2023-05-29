<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Productform extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'author_id'
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
