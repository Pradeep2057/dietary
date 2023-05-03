<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Importer;
use App\Models\Manufacturer;
use App\Models\Agency;
use App\Models\Producttype;
use App\Models\Productform;
use App\Models\Dose;
use App\Models\Size;
use App\Models\Ingredient;
use App\Models\Lab;
use App\Models\Capital;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    
    public function index()
    {
        return view('pages.product.index',[
            'products'    => Product::all(),
        ]);
    }

    public function create(Product $product)
    {
        $this->authorize('create', $product);
        return view('pages.product.create', [
            'importers'    => Importer::all(),
            'manufactures'    => Manufacturer::all(),
            'agencies'    => Agency::all(),
            'producttypes'    => Producttype::all(),
            'productforms'    => Productform::all(),
            'doses'    => Dose::all(),
            'sizes'    => Size::all(),
            'ingredients'    => Ingredient::all(),
            'labs'    => Lab::all(),
            'capitals'    => Capital::all(),
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
        ]);
        $product = new Product;
        $product->name = $validatedData['name'];
        $product->status = $request->status;
        $product->health_claim = $request->health_claim;
        $product->nutritional_claim = $request->nutritional_claim;
        $product->expirydate_claim = $request->expirydate_claim;
        $product->medical_statement = $request->medical_statement;
        $product->diagnose_statement = $request->diagnose_statement;
        $product->dietary_supplement = $request->dietary_supplement;
        $product->product_specification = $request->product_specification;
        $product->specification_rational = $request->specification_rational;
        $product->analysis_method = $request->analysis_method;
        $product->process_flow = $request->process_flow;
        $product->gmp_certificate = $request->gmp_certificate;
        $product->gmp_validity_upto = $request->gmp_validity_upto;
        $product->coa_inhouse = $request->coa_inhouse;
        $product->coa_thirdparty = $request->coa_thirdparty;
        $product->coa_product_standard = $request->coa_product_standard;
        $product->authorization_letter = $request->authorization_letter;
        $product->sale_certificate = $request->sale_certificate;
        $product->product_label = $request->product_label;
        $product->product_registration_certificate = $request->product_registration_certificate;
        $product->composition = $request->composition;
        $product->overall_openion = $request->overall_openion;
        $product->importer_id = $request->importer_id;
        $product->manufacturer_id = $request->manufacturer_id;
        $product->gmp_id = $request->gmp_id;
        $product->product_type = $request->product_type;
        $product->dose_id = $request->dose_id;
        $product->size_id = $request->size_id;
        $product->ingredient_id = $request->ingredient_id;
        $product->lab_id = $request->lab_id;
        $product->capital_id = $request->capital_id;
        $product->author_id = auth()->user()->id;
        $product->save();
        return redirect()->route('product.index')->with('successct', 'Product created successfully.');
    }

    public function edit(Product $product)
    {
        $this->authorize('update', $product);
        $selectedImporter = $product->importer;
        $selectedManufacturer = $product->Manufacturer;
        $selectedAgency = $product->agency;
        $selectedProducttype = $product->producttype;
        $selectedProductform = $product->productform;
        $selectedDose = $product->dose;
        $selectedSize = $product->size;
        $selectedIngredient = $product->ingredient;
        $selectedLab = $product->lab;
        $selectedCapital = $product->capital;
        return view('pages.product.edit',[
            'product'            => $product,
            'importers'    => Importer::all(),
            'manufactures'    => Manufacturer::all(),
            'agencies'    => Agency::all(),
            'producttypes'    => Producttype::all(),
            'productforms'    => Productform::all(),
            'doses'    => Dose::all(),
            'sizes'    => Size::all(),
            'ingredients'    => Ingredient::all(),
            'labs'    => Lab::all(),
            'capitals'    => Capital::all(),
            'selectedImporter'  => $selectedImporter,
            'selectedManufacturer'  => $selectedManufacturer,
            'selectedAgency'  => $selectedAgency,
            'selectedProducttype'  => $selectedProducttype,
            'selectedProductform'  => $selectedProductform,
            'selectedDose'  => $selectedDose,
            'selectedSize'  => $selectedSize,
            'selectedIngredient'  => $selectedIngredient,
            'selectedLab'  => $selectedLab,
            'selectedCapital'  => $selectedCapital,
        ]);
    }

    public function update(Request $request, Product $product)
    {
        $this->authorize('update', $product);

        $validatedData = $request->validate([
            'name' => 'required|max:255',
        ]);
        $product->name = $validatedData['name'];
        $product->status = $request->status;
        $product->health_claim = $request->health_claim;
        $product->nutritional_claim = $request->nutritional_claim;
        $product->expirydate_claim = $request->expirydate_claim;
        $product->medical_statement = $request->medical_statement;
        $product->diagnose_statement = $request->diagnose_statement;
        $product->dietary_supplement = $request->dietary_supplement;
        $product->product_specification = $request->product_specification;
        $product->specification_rational = $request->specification_rational;
        $product->analysis_method = $request->analysis_method;
        $product->process_flow = $request->process_flow;
        $product->gmp_certificate = $request->gmp_certificate;
        $product->gmp_validity_upto = $request->gmp_validity_upto;
        $product->coa_inhouse = $request->coa_inhouse;
        $product->coa_thirdparty = $request->coa_thirdparty;
        $product->coa_product_standard = $request->coa_product_standard;
        $product->authorization_letter = $request->authorization_letter;
        $product->sale_certificate = $request->sale_certificate;
        $product->product_label = $request->product_label;
        $product->product_registration_certificate = $request->product_registration_certificate;
        $product->composition = $request->composition;
        $product->overall_openion = $request->overall_openion;
        $product->importer_id = $request->importer_id;
        $product->manufacturer_id = $request->manufacturer_id;
        $product->gmp_id = $request->gmp_id;
        $product->product_type = $request->product_type;
        $product->dose_id = $request->dose_id;
        $product->size_id = $request->size_id;
        $product->ingredient_id = $request->ingredient_id;
        $product->lab_id = $request->lab_id;
        $product->capital_id = $request->capital_id;
        $product->save();
        return redirect()->route('product.index')->with('successup', 'Product updated successfully.');;
    }


    public function destroy(Product $product)
    {
        $this->authorize('delete', $product);
        $product->delete();
        return redirect()->route('product.index')->with('successdt', 'Product deleted successfully.');;
    }
}
