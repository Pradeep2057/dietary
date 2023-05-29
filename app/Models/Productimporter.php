<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Productimporter extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'importer_id'
    ];
}
