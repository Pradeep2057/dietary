<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\Authenticate;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AgencyController;
use App\Http\Controllers\ImporterController;
use App\Http\Controllers\LabController;
use App\Http\Controllers\ManufacturerController;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\NutrientController;
use App\Http\Controllers\NutrientcategoryController;
use App\Http\Controllers\ProducttypeController;
use App\Http\Controllers\ProductformController;
use App\Http\Controllers\IngredientController;
use App\Http\Controllers\ManufacturerauthorityController;
use App\Http\Controllers\SizeController;
use App\Http\Controllers\DoseController;
use App\Http\Controllers\CapitalController;
use App\Http\Controllers\ProductController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Auth::routes();



Route::middleware(['auth'])->group(function () {

    Route::get('/', function () {
        return view('welcome');
    });

    Route::get('/home',[HomeController::class, 'index'])->name('home');

    Route::group(['prefix' => 'category', 'as' => 'category.'], function () {
        Route::get('/', [CategoryController::class, 'index'])->name('index');
        Route::get('/create', [CategoryController::class, 'create'])->name('create');
        Route::post('/', [CategoryController::class, 'store'])->name('store');
        Route::get('/{category:id}/edit', [CategoryController::class, 'edit'])->name('edit');
        Route::put('/{category:id}', [CategoryController::class, 'update'])->name('update');
        Route::delete('/{category:id}', [CategoryController::class, 'destroy'])->name('delete');
    });

    Route::group(['prefix' => 'agency', 'as' => 'agency.'], function () {
        Route::get('/', [AgencyController::class, 'index'])->name('index');
        Route::get('/create', [AgencyController::class, 'create'])->name('create');
        Route::post('/', [AgencyController::class, 'store'])->name('store');
        Route::get('/{agency:id}/edit', [AgencyController::class, 'edit'])->name('edit');
        Route::put('/{agency:id}', [AgencyController::class, 'update'])->name('update');
        Route::delete('/{agency:id}', [AgencyController::class, 'destroy'])->name('delete');
    });

    Route::group(['prefix' => 'importer', 'as' => 'importer.'], function () {
        Route::get('/', [ImporterController::class, 'index'])->name('index');
        Route::get('/create', [ImporterController::class, 'create'])->name('create');
        Route::post('/', [ImporterController::class, 'store'])->name('store');
        Route::get('/{importer:id}/edit', [ImporterController::class, 'edit'])->name('edit');
        Route::put('/{importer:id}', [ImporterController::class, 'update'])->name('update');
        Route::delete('/{importer:id}', [ImporterController::class, 'destroy'])->name('delete');
    });

    Route::group(['prefix' => 'lab', 'as' => 'lab.'], function () {
        Route::get('/', [LabController::class, 'index'])->name('index');
        Route::get('/create', [LabController::class, 'create'])->name('create');
        Route::post('/', [LabController::class, 'store'])->name('store');
        Route::get('/{lab:id}/edit', [LabController::class, 'edit'])->name('edit');
        Route::put('/{lab:id}', [LabController::class, 'update'])->name('update');
        Route::delete('/{lab:id}', [LabController::class, 'destroy'])->name('delete');
    });

    Route::group(['prefix' => 'manufacturer', 'as' => 'manufacturer.'], function () {
        Route::get('/', [ManufacturerController::class, 'index'])->name('index');
        Route::get('/create', [ManufacturerController::class, 'create'])->name('create');
        Route::post('/', [ManufacturerController::class, 'store'])->name('store');
        Route::get('/{manufacturer:id}/edit', [ManufacturerController::class, 'edit'])->name('edit');
        Route::put('/{manufacturer:id}', [ManufacturerController::class, 'update'])->name('update');
        Route::delete('/{manufacturer:id}', [ManufacturerController::class, 'destroy'])->name('delete');
    });

    Route::group(['prefix' => 'manufacturer-authority', 'as' => 'manufacturer-authority.'], function () {
        Route::get('/', [ManufacturerauthorityController::class, 'index'])->name('index');
        Route::get('/create', [ManufacturerauthorityController::class, 'create'])->name('create');
        Route::post('/', [ManufacturerauthorityController::class, 'store'])->name('store');
        Route::get('/{manufacturerauthority:id}/edit', [ManufacturerauthorityController::class, 'edit'])->name('edit');
        Route::put('/{manufacturerauthority:id}', [ManufacturerauthorityController::class, 'update'])->name('update');
        Route::delete('/{manufacturerauthority:id}', [ManufacturerauthorityController::class, 'destroy'])->name('delete');
    });

    Route::group(['prefix' => 'country', 'as' => 'country.'], function () {
        Route::get('/', [CountryController::class, 'index'])->name('index');
        Route::get('/create', [CountryController::class, 'create'])->name('create');
        Route::post('/', [CountryController::class, 'store'])->name('store');
        Route::get('/{country:id}/edit', [CountryController::class, 'edit'])->name('edit');
        Route::put('/{country:id}', [CountryController::class, 'update'])->name('update');
        Route::delete('/{country:id}', [CountryController::class, 'destroy'])->name('delete');
    });

    Route::group(['prefix' => 'nutrient', 'as' => 'nutrient.'], function () {
        Route::get('/', [NutrientController::class, 'index'])->name('index');
        Route::get('/create', [NutrientController::class, 'create'])->name('create');
        Route::post('/', [NutrientController::class, 'store'])->name('store');
        Route::get('/{nutrients:id}/edit', [NutrientController::class, 'edit'])->name('edit');
        Route::put('/{nutrients:id}', [NutrientController::class, 'update'])->name('update');
        Route::delete('/{nutrients:id}', [NutrientController::class, 'destroy'])->name('delete');
    });

    Route::group(['prefix' => 'nutrient-category', 'as' => 'nutrient-category.'], function () {
        Route::get('/', [NutrientcategoryController::class, 'index'])->name('index');
        Route::get('/create', [NutrientcategoryController::class, 'create'])->name('create');
        Route::post('/', [NutrientcategoryController::class, 'store'])->name('store');
        Route::get('/{nutrientcategory:id}/edit', [NutrientcategoryController::class, 'edit'])->name('edit');
        Route::put('/{nutrientcategory:id}', [NutrientcategoryController::class, 'update'])->name('update');
        Route::delete('/{nutrientcategory:id}', [NutrientcategoryController::class, 'destroy'])->name('delete');
    });

    Route::group(['prefix' => 'type-of-product', 'as' => 'type-of-product.'], function () {
        Route::get('/', [ProducttypeController::class, 'index'])->name('index');
        Route::get('/create', [ProducttypeController::class, 'create'])->name('create');
        Route::post('/', [ProducttypeController::class, 'store'])->name('store');
        Route::get('/{producttype:id}/edit', [ProducttypeController::class, 'edit'])->name('edit');
        Route::put('/{producttype:id}', [ProducttypeController::class, 'update'])->name('update');
        Route::delete('/{producttype:id}', [ProducttypeController::class, 'destroy'])->name('delete');
    });

    Route::group(['prefix' => 'form-of-product', 'as' => 'form-of-product.'], function () {
        Route::get('/', [ProductformController::class, 'index'])->name('index');
        Route::get('/create', [ProductformController::class, 'create'])->name('create');
        Route::post('/', [ProductformController::class, 'store'])->name('store');
        Route::get('/{productform:id}/edit', [ProductformController::class, 'edit'])->name('edit');
        Route::put('/{productform:id}', [ProductformController::class, 'update'])->name('update');
        Route::delete('/{productform:id}', [ProductformController::class, 'destroy'])->name('delete');
    });

    Route::group(['prefix' => 'ingredient', 'as' => 'ingredient.'], function () {
        Route::get('/', [IngredientController::class, 'index'])->name('index');
        Route::get('/create', [IngredientController::class, 'create'])->name('create');
        Route::post('/', [IngredientController::class, 'store'])->name('store');
        Route::get('/{ingredient:id}/edit', [IngredientController::class, 'edit'])->name('edit');
        Route::put('/{ingredient:id}', [IngredientController::class, 'update'])->name('update');
        Route::delete('/{ingredient:id}', [IngredientController::class, 'destroy'])->name('delete');
    });

    Route::group(['prefix' => 'dose', 'as' => 'dose.'], function () {
        Route::get('/', [DoseController::class, 'index'])->name('index');
        Route::get('/create', [DoseController::class, 'create'])->name('create');
        Route::post('/', [DoseController::class, 'store'])->name('store');
        Route::get('/{dose:id}/edit', [DoseController::class, 'edit'])->name('edit');
        Route::put('/{dose:id}', [DoseController::class, 'update'])->name('update');
        Route::delete('/{dose:id}', [DoseController::class, 'destroy'])->name('delete');
    });

    Route::group(['prefix' => 'size', 'as' => 'size.'], function () {
        Route::get('/', [SizeController::class, 'index'])->name('index');
        Route::get('/create', [SizeController::class, 'create'])->name('create');
        Route::post('/', [SizeController::class, 'store'])->name('store');
        Route::get('/{size:id}/edit', [SizeController::class, 'edit'])->name('edit');
        Route::put('/{size:id}', [SizeController::class, 'update'])->name('update');
        Route::delete('/{size:id}', [SizeController::class, 'destroy'])->name('delete');
    });

    Route::group(['prefix' => 'capital', 'as' => 'capital.'], function () {
        Route::get('/', [CapitalController::class, 'index'])->name('index');
        Route::get('/create', [CapitalController::class, 'create'])->name('create');
        Route::post('/', [CapitalController::class, 'store'])->name('store');
        Route::get('/{capital:id}/edit', [CapitalController::class, 'edit'])->name('edit');
        Route::put('/{capital:id}', [CapitalController::class, 'update'])->name('update');
        Route::delete('/{capital:id}', [CapitalController::class, 'destroy'])->name('delete');
    });

    Route::group(['prefix' => 'product', 'as' => 'product.'], function () {
        Route::get('/', [ProductController::class, 'index'])->name('index');
        Route::get('/create', [ProductController::class, 'create'])->name('create');
        Route::post('/', [ProductController::class, 'store'])->name('store');
        Route::get('/{product:id}/edit', [ProductController::class, 'edit'])->name('edit');
        Route::put('/{product:id}', [ProductController::class, 'update'])->name('update');
        Route::delete('/{product:id}', [ProductController::class, 'destroy'])->name('delete');
    });

});
