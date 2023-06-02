<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;


use Carbon\Carbon;
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

use Yajra\DataTables\Facades\DataTables;


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
            'producttypes' => Producttype::all(),
            'productforms' => Productform::all(),
            'manufacturers' => Manufacturer::all(),
            'labs'    => Lab::all(),
        ]);
    }



    public function data(Request $request)
    {
        $data = Product::with('Producttype', 'Productform', 'Manufacturer', 'Importer', 'Lab');

        if ($request->input('status')) {
            $status = $request->input('status');
            $data->where('status', $status);
        }

        if ($request->input('product_type')) {
            $type = $request->input('product_type');
            $data->where('product_type', $type);
        }

        if ($request->input('product_form')) {
            $form = $request->input('product_form');
            $data->where('product_form', $form);
        }

        if ($request->input('manufacturer')) {
            $manufacturer = $request->input('manufacturer');
            $data->where('manufacturer_id', $manufacturer);
        }

        if ($request->input('min')) {
            $fromDate = $request->input('min');
            $data->whereDate('created_at', '>=', $fromDate);
        }
    
        if ($request->input('max')) {
            $toDate = $request->input('max');
            $data->whereDate('created_at', '<=', $toDate);
        }

        if ($request->input('lab')) {
            $lab = $request->input('lab');
            $data->where('lab_id', $lab);
        }

        if ($request->input('search')) {
            $searchValue = $request->input('search');
            $data->where(function ($query) use ($searchValue) {
                $query->where('name', 'LIKE', '%' . $searchValue . '%')
                    ->orWhere('registration', 'LIKE', '%' . $searchValue . '%')
                    ->orWhere('ingredients', 'LIKE', '%' . $searchValue . '%')
                    ->orWhere('ingredient_unit', 'LIKE', '%' . $searchValue . '%');
            });
        }

        $query = $data->latest();

        
       

        if ($request->ajax()) {

            return Datatables::of($query)
                ->addColumn('DT_RowIndex', function ($row) {
                    return $row->getKey() + 1;
                })
                ->addColumn('registration', function($row) {
                    return $row->registration; 
                })
                ->addColumn('name', function($row) {
                    return $row->name; 
                })
                ->addColumn('product_type', function($row) {
                    return $row->Producttype->name ?? "N/A" ;
                })
                ->addColumn('product_form', function($row) {
                    return $row->Productform->name ?? "N/A"; 
                })
                ->addColumn('manufacturer', function($row) {
                    return $row->Manufacturer->name ?? "N/A"; 
                })
                ->addColumn('importer', function($row) {
                    $importerNames = $row->importers->pluck('name')->implode(', ');
                    return $importerNames ?: "N/A"; 
                })
                ->addColumn('lab', function($row) {
                    return $row->Lab->name ?? "N/A"; 
                })
                ->addColumn('status', function($row) {
                    $statusClass = '';
                    if ($row->status == 'Pending') {
                        $statusClass = 'pending';
                    } elseif ($row->status == 'Verified') {
                        $statusClass = 'verified';
                    } else {
                        $statusClass = 'rejected';
                    }
                    return '<div class="' . $statusClass . '">' . $row->status . '</div>';
                })
                ->addColumn('created_at', function($row) {
                    return $row->created_at->format('Y-m-d');
                })

                ->addColumn('action', function($row) {
                    $html = '<div class="d-flex kit-action-com">';
                    $html .= '<div class="action-btn-view">';
                    $html .= '<a href="'.route('product.display', $row->id).'">';
                    $html .= '<span class="material-symbols-outlined">visibility</span>';
                    $html .= '</a>';
                    $html .= '</div>';
    
                    if (auth()->user()->role == 2 && $row->status == 'Pending') {
                        $html .= '<div class="action-btn-pen">';
                        $html .= '<a href="'.route('product.edit', $row->id).'" method="put">';
                        $html .= '<span class="material-symbols-outlined">edit</span>';
                        $html .= '</a>';
                        $html .= '</div>';
                    } elseif (auth()->user()->role == 0 || auth()->user()->role == 1) {
                        $html .= '<div class="action-btn-pen">';
                        $html .= '<a href="'.route('product.edit', $row->id).'" method="put">';
                        $html .= '<span class="material-symbols-outlined">edit</span>';
                        $html .= '</a>';
                        $html .= '</div>';
                    }
    
                    if (auth()->user()->role == 0) {
                        $html .= '<form class="action-btn-dlt" action="'.route('product.delete', $row->id).'" method="post">';
                        $html .= csrf_field();
                        $html .= method_field('delete');
                        $html .= '<button type="button" data-bs-toggle="modal" data-bs-target="#staticBackdrop">';
                        $html .= '<i class="fa-regular fa-trash-can"></i>';
                        $html .= '</button>';
                        $html .= '<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered confirmation-modal">
                            <div class="modal-content">
                           
                            <div class="modal-body delete-body">
                            <span class="material-symbols-outlined delete-icon">cancel</span>
                                <h3 class="mb-2">Are you sure ?</h3>
                                <p>Do you really want to delete this product ?<br>
                                This will also delete the certificate related to it.</p>
                            </div>
                            <div class="modal-footer d-flex justify-content-center">
                            <div class="row d-flex">
                                <div class="col-md-12">
                                    <button type="button"  class="btn cancel-btn" data-bs-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-danger delete-btn">Delete</button>
                                </div>
                            </div>
                                
                            </div>
                            </div>
                        </div>
                    </div>';
                        $html .= '</form>';
                    }
    
                    $html .= '</div>';
    
                    return $html;
                })
                ->rawColumns(['action', 'status'])
                ->make(true);
        }
    }


    public function create(Product $product)
    {
        $this->authorize('create', $product);
        return view('pages.product.create', [
            'products' => Product::all(),
            'importers'    => Importer::all(),
            'manufacturers'    => Manufacturer::all(),
            'agencies'    => Agency::all(),
            'producttypes'    => Producttype::all(),
            'productforms'    => Productform::all(),
            'doses'    => Dose::all(),
            'sizes'    => Size::all(),
            'ingredients'    => Ingredient::all(),
            'labs'    => Lab::all(),
            'capitals'    => Capital::all(),
            'expirydates'    => Expirydate::all(),
            'templateProduct' => null
        ]);
    }

    public function fill(Request $request)
    {
        $productId = $request->input('productId');
        $templateProduct = Product::find($productId);
        
        $templateImporters = $templateProduct->importers->pluck('id')->toArray();

        $templateManufacturer = $templateProduct->Manufacturer;
        $templateAgency = $templateProduct->agency;
        $templateProducttype = $templateProduct->producttype;
        $templateProductform = $templateProduct->productform;
        $templateDose = $templateProduct->dose;
        $templateSize = $templateProduct->size;
        $templateLab = $templateProduct->lab;
        $templateCapital = $templateProduct->capital;
        $templateExpirydate = $templateProduct->expirydate;
        $templateIngredients = $templateProduct->ingredients;
        $templateIngredientsunit = $templateProduct->ingredient_unit;

        return view('pages.product.create', [
            'products' => Product::all(),
            'importers'    => Importer::all(),
            'manufacturers'    => Manufacturer::all(),
            'agencies'    => Agency::all(),
            'producttypes'    => Producttype::all(),
            'productforms'    => Productform::all(),
            'doses'    => Dose::all(),
            'sizes'    => Size::all(),
            'ingredients'    => Ingredient::all(),
            'labs'    => Lab::all(),
            'capitals'    => Capital::all(),
            'expirydates'    => Expirydate::all(),
            'templateProduct' => $templateProduct,
            'templateImporters' => $templateImporters,
            'templateManufacturer' => $templateManufacturer,
            'templateAgency' => $templateAgency,
            'templateProducttype' => $templateProducttype,
            'templateProductform' => $templateProductform,
            'templateDose' => $templateDose,
            'templateSize' => $templateSize,
            'templateExpirydate' => $templateExpirydate,
            'templateLab' => $templateLab,
            'templateCapital'=>$templateCapital,
            'templateIngredients'=>$templateIngredients,
            'templateIngredientsunit'=>$templateIngredientsunit,
        ]);
    }



    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255|unique:products',
            'product_type' => 'required | not_in:all',
            'product_form' => 'required | not_in:all',
            'dose_id' => 'required | not_in:all',
            'size_id' => 'required | not_in:all',
            'manufacturer_id' => 'required | not_in:all',
            'lab_id' => 'required | not_in:all',
            'gmp_id' => 'required | not_in:all',
            'capital_id' => 'required | not_in:all',
            'gmp_validity_upto' => 'required | date',
        ]);

        $product = new Product;
        $product->name = $validatedData['name'];

        if (Auth::user()->role == 0 || Auth::user()->role == 1) {
            $product->status = 'Verified';
            $product->verifier_id = Auth::user()->id;
            $product->verified_at = Carbon::now()->toDateTimeString();
        }else{
            $product->status = 'Pending';
        }

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
        if($request->remarks1){
            $product->remarks_1 = $request->remarks1;
        }


        $product->product_registration_certificate = $request->product_registration_certificate;
        $product->overall_openion = $request->overall_openion;
        $product->manufacturer_id = $request->manufacturer_id;
        $product->gmp_id = $request->gmp_id;
        $product->product_type = $request->product_type;
        $product->product_form = $request->product_form;
        $product->dose_id = $request->dose_id;
        $product->size_id = $request->size_id;
        $product->lab_id = $request->lab_id;
        $product->capital_id = $request->capital_id;
        $product->ingredients = $request->ingredients;
        // $product->compositions = $request->compositions;
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
            'selectedLab'  => $selectedLab,
            'selectedCapital'  => $selectedCapital,
            'selectedImporters'  => $selectedImporters,
            'selectedExpirydate' =>$selectedExpirydate,
        ]);
    }




    public function update(Request $request, Product $product)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'product_type' => 'required | not_in:all',
            'product_form' => 'required | not_in:all',
            'dose_id' => 'required | not_in:all',
            'size_id' => 'required | not_in:all',
            'manufacturer_id' => 'required | not_in:all',
            'lab_id' => 'required | not_in:all',
            'gmp_id' => 'required | not_in:all',
            'capital_id' => 'required | not_in:all',
            'gmp_validity_upto' => 'required | date',
        ]);

            
        $isFyUpdated = ($request->fy != $product->fy);

        if ($isFyUpdated) {
            $lastProduct = Product::where('fy', $request->fy)
                           ->orderByDesc('code')
                           ->first();
            if ($lastProduct) {
                $product->code = $lastProduct->code + 1;
            } else {
                $product->code = 1;
            }
            $product->registration = '01' . $request->fy . str_pad($product->code, 4, '0', STR_PAD_LEFT);
        }
       

        $product->name = $validatedData['name'];

        $product->fy = $request->fy;
        $product->health_claim = $request->health_claim;
        $product->ingredient_unit = $request->ingredient_unit;
        // $product->voucher_no = $request->voucher_number;
        // $product->voucher_amount = $request->voucher_amount;

        if($request->remarks){
            $product->remarks = $request->remarks;
        }

        if($request->remarks1){
            $product->remarks_1 = $request->remarks1;
        }

        if ($request->has('verify')) {
            if (Auth::user()->role == 0 || Auth::user()->role == 1) {
                $product->status = 'Verified';
                $product->verifier_id = Auth::user()->id;
                $product->verified_at = Carbon::now()->toDateTimeString();
            }else{
                $product->status = 'Pending';
            }
        }elseif ($request->has('reject')){
            if (Auth::user()->role == 0 || Auth::user()->role == 1) {
                $product->status = 'Rejected';
                $product->verifier_id = Auth::user()->id;
                $product->verified_at = Carbon::now()->toDateTimeString();;
            }else{
                $product->status = 'Pending';
            }
        }
        

        $product->nutritional_claim = $request->nutritional_claim;
        $product->expirydate_id = $request->expirydate_claim;
        $product->category_id = $request->cat;
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
        // $product->compositions=$request->compositions;
        $product->overall_openion = $request->overall_openion;
        $product->importers()->sync($request->input('importers'));
        $product->manufacturer_id = $request->manufacturer_id;
        $product->gmp_id = $request->gmp_id;
        $product->product_type = $request->product_type;
        $product->product_form = $request->product_form;
        $product->dose_id = $request->dose_id;
        $product->size_id = $request->size_id;
        // $product->ingredients()->sync($request->input('ingredients'));
        $product->ingredients=$request->ingredients;
        $product->lab_id = $request->lab_id;
        $product->capital_id = $request->capital_id;

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

        return redirect()->route('product.index')->with('successup', 'Product updated successfully.');
    }


    public function destroy(Product $product)
    {
        $this->authorize('delete', $product);
        $product->delete();
        return redirect()->route('product.index')->with('successdt', 'Product deleted successfully.');
    }


}