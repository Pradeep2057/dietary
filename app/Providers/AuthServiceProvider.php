<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Country;
use App\Models\Lab;
use App\Models\Manufacturer;
use App\Models\Agency;
use App\Models\Importer;
use App\Models\Nutrientcategory;
use App\Models\Productform;
use App\Models\Producttype;
use App\Models\Ingredient;
use App\Models\Manufacturerauthority;
use App\Models\Size;
use App\Models\Dose;
use App\Models\Capital;
use App\Models\Product;
use App\Policies\CategoryPolicy;
use App\Policies\CountryPolicy;
use App\Policies\LabPolicy;
use App\Policies\ManufacturerPolicy;
use App\Policies\AgencyPolicy;
use App\Policies\ImporterPolicy;
use App\Policies\NutrientcategoryPolicy;
use App\Policies\ProductformPolicy;
use App\Policies\ProducttypePolicy;
use App\Policies\IngredientPolicy;
use App\Policies\ManufacturerauthorityPolicy;
use App\Policies\SizePolicy;
use App\Policies\DosePolicy;
use App\Policies\CapitalPolicy;
use App\Policies\ProductPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Category::class => CategoryPolicy::class,
        Country::class => CountryPolicy::class,
        Lab::class => LabPolicy::class,
        Manufacturer::class => ManufacturerPolicy::class,
        Agency::class => AgencyPolicy::class,
        Importer::class => ImporterPolicy::class,
        Nutrientcategory::class => NutrientcategoryPolicy::class,
        Productform::class => ProductformPolicy::class,
        Producttype::class => ProducttypePolicy::class,
        Ingredient::class => IngredientPolicy::class,
        Manufacturerauthority::class => ManufacturerauthorityPolicy::class,
        Size::class => SizePolicy::class,
        Dose::class => DosePolicy::class,
        Capital::class => CapitalPolicy::class,
        Product::class => ProductPolicy::class,
    ];
}
