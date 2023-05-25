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
use App\Http\Controllers\UserController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ReportviewController;
use App\Http\Controllers\RenewController;
use App\Http\Controllers\RegistrationController;
use App\Http\Controllers\RenewalController;
use App\Http\Controllers\ExpirydateController;
use App\Http\Controllers\FiscalyearController;



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



Auth::routes([
    'register' => true,
]);


Route::middleware(['auth'])->group(function () {

    // Route::get('/', function () {
    //     return view('pages.product.index');
    //     // return redirect('/product');
    // });
    // Route::get('/', [ProductController::class, 'index']);

    Route::get('/',[HomeController::class, 'index'])->name('home');
    Route::get('/profile',[HomeController::class, 'profile'])->name('profile');
    Route::get('/report-view',[ReportviewController::class, 'index'])->name('report-view');

    Route::group(['prefix' => 'user', 'as' => 'user.'], function () {
        Route::get('/', [UserController::class, 'index'])->name('index');
        Route::get('/create', [UserController::class, 'create'])->name('create');
        Route::post('/', [UserController::class, 'store'])->name('store');
        Route::get('/{user:id}/edit', [UserController::class, 'edit'])->name('edit');
        Route::put('/{user:id}', [UserController::class, 'update'])->name('update');
        Route::delete('/{user:id}', [UserController::class, 'destroy'])->name('delete');
        Route::get('/change-password', [UserController::class, 'changePassword'])->name('changePassword');
        Route::post('/update-password', [UserController::class, 'updatePassword'])->name('updatePassword');
    });

    Route::group(['prefix' => 'category', 'as' => 'category.'], function () {
        Route::get('/', [CategoryController::class, 'index'])->name('index');
        // Route::get('/create', [CategoryController::class, 'create'])->name('create');
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
    Route::group(['prefix' => 'fiscalyear', 'as' => 'fiscalyear.'], function () {
        Route::get('/', [FiscalyearController::class, 'index'])->name('index');
        Route::get('/create', [LabController::class, 'create'])->name('create');
        Route::post('/', [FiscalyearController::class, 'store'])->name('store');
        Route::get('/{fiscalyear:id}/edit', [FiscalyearController::class, 'edit'])->name('edit');
        Route::put('/{fiscalyear:id}', [FiscalyearController::class, 'update'])->name('update');
        Route::delete('/{fiscalyear:id}', [FiscalyearController::class, 'destroy'])->name('delete');
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
        // Route::get('/create', [ManufacturerauthorityController::class, 'create'])->name('create');
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

    Route::group(['prefix' => 'expirydate', 'as' => 'expirydate.'], function () {
        Route::get('/', [ExpirydateController::class, 'index'])->name('index');
        Route::get('/create', [ExpirydateController::class, 'create'])->name('create');
        Route::post('/', [ExpirydateController::class, 'store'])->name('store');
        Route::get('/{expirydate:id}/edit', [ExpirydateController::class, 'edit'])->name('edit');
        Route::put('/{expirydate:id}', [ExpirydateController::class, 'update'])->name('update');
        Route::delete('/{expirydate:id}', [ExpirydateController::class, 'destroy'])->name('delete');
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
        Route::get('/{product:id}/display', [ProductController::class, 'display'])->name('display');
        Route::put('/{product:id}', [ProductController::class, 'update'])->name('update');
        Route::delete('/{product:id}', [ProductController::class, 'destroy'])->name('delete');
    });

    Route::group(['prefix' => 'report', 'as' => 'report.'], function () {
        Route::get('/', [ReportController::class, 'index'])->name('index');
        Route::get('/create', [ReportController::class, 'create'])->name('create');
        Route::post('/', [ReportController::class, 'store'])->name('store');
        Route::get('/{report:id}/edit', [ReportController::class, 'edit'])->name('edit');
        Route::get('/{report:id}/pdf', [ReportController::class, 'generatePdf'])->name('pdf');
        Route::put('/{report:id}', [ReportController::class, 'update'])->name('update');
        Route::delete('/{report:id}', [ReportController::class, 'destroy'])->name('delete');
    });

    Route::group(['prefix' => 'renew', 'as' => 'renew.'], function () {
        Route::get('/', [RenewController::class, 'index'])->name('index');
        Route::get('/create', [RenewController::class, 'create'])->name('create');
        Route::post('/', [RenewController::class, 'store'])->name('store');
        Route::get('/{renew:id}/edit', [RenewController::class, 'edit'])->name('edit');
        Route::get('/{renew:id}/pdf', [RenewController::class, 'generatePdf'])->name('pdf');
        Route::put('/{renew:id}', [RenewController::class, 'update'])->name('update');
        Route::delete('/{renew:id}', [RenewController::class, 'destroy'])->name('delete');
    });

    Route::group(['prefix' => 'registration', 'as' => 'registration.'], function () {
        Route::get('/', [RegistrationController::class, 'index'])->name('index');
        Route::get('/create', [RegistrationController::class, 'create'])->name('create');
        Route::post('/', [RegistrationController::class, 'store'])->name('store');
        Route::get('/{registration:id}/edit', [RegistrationController::class, 'edit'])->name('edit');
        Route::get('/{registration:id}/pdf', [RegistrationController::class, 'generatePdf'])->name('pdf');
        Route::put('/{registration:id}', [RegistrationController::class, 'update'])->name('update');
        Route::delete('/{registration:id}', [RegistrationController::class, 'destroy'])->name('delete');
    });

    Route::group(['prefix' => 'renewal', 'as' => 'renewal.'], function () {
        Route::get('/', [RenewalController::class, 'index'])->name('index');
        Route::get('/create', [RenewalController::class, 'create'])->name('create');
        Route::post('/', [RenewalController::class, 'store'])->name('store');
        Route::get('/{renewal:id}/edit', [RenewalController::class, 'edit'])->name('edit');
        Route::get('/{renewal:id}/pdf', [RenewalController::class, 'generatePdf'])->name('pdf');
        Route::put('/{renewal:id}', [RenewalController::class, 'update'])->name('update');
        Route::delete('/{renewal:id}', [RenewalController::class, 'destroy'])->name('delete');
    });


    Route::group(['prefix' => 'reportview', 'as' => 'reportview.'], function () {
        Route::get('/', [ReportviewController::class, 'display'])->name('display');
    });

});
