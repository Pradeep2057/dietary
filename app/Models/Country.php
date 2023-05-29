<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Country extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'population',
        'area',
        'author_id'
    ];

    public function manufacturers()
    {
        return $this->hasMany(Manufacturer::class);
    }
    public function labs()
    {
        return $this->hasMany(Lab::class);
    }
    
}
