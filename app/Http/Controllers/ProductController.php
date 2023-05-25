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
use App\Models\Image;
use App\Models\Expirydate;
use App\Models\Fiscalyear;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
            'importers'    => Importer::all(),
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
            'expirydates'    => Expirydate::all(),
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
        // $product->fy = $request->fy;
        $fiscalyear = Fiscalyear::where('id',1)->first();
        $product->fy =  $fiscalyear->name;
        $lastProduct = Product::where('fy', $product->fy)->orderByDesc('code')->first();
        if ($lastProduct && $lastProduct->fy == $product->fy) {
            $product->code = $lastProduct->code + 1;
        } else {
            $product->code = 1;
        }
        $product->registration = '01'.$product->fy.str_pad($product->code, 4, '0', STR_PAD_LEFT);
        $product->health_claim = $request->health_claim;
        $product->ingredient_unit = $request->ingredient_unit;
        $product->nutritional_claim = $request->nutritional_claim;
        $product->expirydate_id = $request->expirydate_claim;
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
        if($request->remarks){
            $product->remarks = $request->remarks;
        }
        $product->product_registration_certificate = $request->product_registration_certificate;
        $product->overall_openion = $request->overall_openion;
        // $product->importer_id = $request->importer_id;
        $product->manufacturer_id = $request->manufacturer_id;
        $product->gmp_id = $request->gmp_id;
        $product->product_type = $request->product_type;
        $product->product_form = $request->product_form;
        $product->dose_id = $request->dose_id;
        $product->size_id = $request->size_id;
        $product->lab_id = $request->lab_id;
        $product->capital_id = $request->capital_id;
        $product->author_id = auth()->user()->id;

        $product->save();

        if ($lastProduct && $lastProduct->fy == $product->fy) {
            $products = Product::where('fy', $product->fy)->where('id', '>', $product->id)->orderBy('code')->get();
            $code = $product->code + 1;
        
            foreach ($products as $i => $prod) {
                $prod->code = $code;
                $prod->registration = '01' . $prod->fy . str_pad($prod->code, 4, '0', STR_PAD_LEFT);
                $prod->save();
                $code++;
            }
        }

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $label_image = $image->store('public/product_image');
                $image = new Image;
                $image->label_image = $label_image;
                $product->images()->save($image);
            }
        }
        $product->ingredients()->sync($request->input('ingredients'));
        $product->compositions()->sync($request->input('compositions'));
        $product->importers()->sync($request->input('importers'));
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
        $selectedExpirydate = $product->expirydate;
        $selectedIngredients = $product->ingredients->pluck('id')->toArray();
        $selectedCompositions = $product->compositions->pluck('id')->toArray();
        $selectedImporters = $product->importers->pluck('id')->toArray();
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
            'expirydates'    => Expirydate::all(),
            'selectedImporter'  => $selectedImporter,
            'selectedManufacturer'  => $selectedManufacturer,
            'selectedAgency'  => $selectedAgency,
            'selectedProducttype'  => $selectedProducttype,
            'selectedProductform'  => $selectedProductform,
            'selectedDose'  => $selectedDose,
            'selectedSize'  => $selectedSize,
            'selectedIngredients'  => $selectedIngredients,
            'selectedCompositions' => $selectedCompositions,
            'selectedLab'  => $selectedLab,
            'selectedCapital'  => $selectedCapital,
            'selectedImporters'  => $selectedImporters,
            'selectedExpirydate' =>$selectedExpirydate,
        ]);
    }

    public function display(Product $product)
    {
        $this->authorize('display', $product);
        $selectedImporter = $product->importer;
        $selectedManufacturer = $product->Manufacturer;
        $selectedAgency = $product->agency;
        $selectedProducttype = $product->producttype;
        $selectedProductform = $product->productform;
        $selectedDose = $product->dose;
        $selectedSize = $product->size;
        $selectedExpirydate = $product->expirydate;
        $selectedIngredients = $product->ingredients->pluck('id')->toArray();
        $selectedCompositions = $product->compositions->pluck('id')->toArray();
        $selectedImporters = $product->importers->pluck('id')->toArray();
        $selectedLab = $product->lab;
        $selectedCapital = $product->capital;
        return view('pages.product.display',[
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
            'expirydates'    => Expirydate::all(),
            'selectedImporter'  => $selectedImporter,
            'selectedManufacturer'  => $selectedManufacturer,
            'selectedAgency'  => $selectedAgency,
            'selectedProducttype'  => $selectedProducttype,
            'selectedProductform'  => $selectedProductform,
            'selectedDose'  => $selectedDose,
            'selectedSize'  => $selectedSize,
            'selectedIngredients'  => $selectedIngredients,
            'selectedCompositions' => $selectedCompositions,
            'selectedLab'  => $selectedLab,
            'selectedCapital'  => $selectedCapital,
            'selectedImporters'  => $selectedImporters,
            'selectedExpirydate' =>$selectedExpirydate,
        ]);
    }




    public function update(Request $request, Product $product)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
        ]);

        $isFyUpdated = ($request->fy != $product->fy);

        if ($isFyUpdated || is_null($product->fy)) {
            $lastProduct = Product::where('fy', $request->fy)->orderByDesc('code')->first();
            if ($lastProduct) {
                $product->code = $lastProduct->code + 1;
            } else {
                $product->code = 1;
            }
            $product->registration = '01' . $request->fy . str_pad($product->code, 4, '0', STR_PAD_LEFT);
        }

        $product->name = $validatedData['name'];
        if($request->status){
            $product->status = $request->status;
        }else{
            $product->status = 'Pending';
        }
        
        $product->fy = $request->fy;
        $product->health_claim = $request->health_claim;
        $product->ingredient_unit = $request->ingredient_unit;

        $product->voucher_no = $request->voucher_number;
        $product->voucher_amount = $request->voucher_amount;

        if($request->remarks){
            $product->remarks = $request->remarks;
        }

        $product->nutritional_claim = $request->nutritional_claim;
        $product->expirydate_id = $request->expirydate_claim;
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
        $product->compositions()->sync($request->input('compositions'));
        $product->overall_openion = $request->overall_openion;
        // $product->importer_id = $request->importer_id;
        $product->importers()->sync($request->input('importers'));
        $product->manufacturer_id = $request->manufacturer_id;
        $product->gmp_id = $request->gmp_id;
        $product->product_type = $request->product_type;
        $product->product_form = $request->product_form;
        $product->dose_id = $request->dose_id;
        $product->size_id = $request->size_id;
        $product->ingredients()->sync($request->input('ingredients'));
        $product->lab_id = $request->lab_id;
        $product->capital_id = $request->capital_id;
        $product->author_id = auth()->user()->id;

        if ($request->has('remove_images')) {
            foreach ($request->remove_images as $imageId) {
                $image = Image::findOrFail($imageId);
                Storage::delete('public/product_image/' . $image->label_image);
                $image->delete();
            }
        }

        $product->save();

        if ($request->hasFile('new_images')) {
            foreach ($request->file('new_images') as $newImage) {
                $label_image = $newImage->store('public/product_image');
                $image = new Image;
                $image->label_image = $label_image;
                $product->images()->save($image);
            }
        }

        return redirect()->route('product.index')->with('successup', 'Product edited successfully.');
    }


    public function destroy(Product $product)
    {
        $this->authorize('delete', $product);
        $product->delete();
        return redirect()->route('product.index')->with('successdt', 'Product deleted successfully.');
    }


}