<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Nutrientcategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'author_id',
    ];

    public function nutrients()
    {
        return $this->hasMany(Nutrient::class);
    }
}
