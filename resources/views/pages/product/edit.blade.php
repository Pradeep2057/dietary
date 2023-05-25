@extends('layouts.main')
@section('title', 'Edit Product')

@section('content')
<div class="add-heading">
    <h3 class="heading-cm"> 
        <a href="{{ route('product.index')}}" class="nav-icon me-2">
            <i class="fa-solid fa-angle-left"></i> 
        </a>
        Products<span class="sub-nav ms-2" > > Edit</span>
    </h3>
    <p><a href="{{ route('product.index')}}">View All</a></p>
</div>

<form action="{{ route('product.update', $product) }}" method="post" class="form-cm" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="row mb-2">
        <div class="mb-3 col-md-6">
            <label for="" class="form-label cm">Name of Product</label>
            <input type="text" class="form-control cm" placeholder="Enter Name of Product" name="name"
                value="{{ $product->name }}">
        </div>
        <div class="mb-3 col-md-6">
            <label for="" class="form-label cm">Type of Product</label>
            <select name="product_type" class="form-select kit-form-control">
                @foreach ($producttypes as $producttype)
                <option value="{{ $producttype->id }}" @if($producttype->id == $selectedProducttype->id) selected
                    @endif>{{ $producttype->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="row">
        <div class="mb-3 col-md-6">
            <label for="" class="form-label cm">Form of Product</label>
            <select name="product_form" class="form-select kit-form-control">
                @foreach ($productforms as $productform)
                <option value="{{ $productform->id }}" @if($productform->id == $selectedProductform->id) selected
                    @endif>{{ $productform->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3 col-md-6">
            <label for="" class="form-label cm">Dose specified</label>
            <select name="dose_id" class="form-select kit-form-control" aria-label="Default select example">
                @foreach ($doses as $dose)
                <option value="{{ $dose->id }}" @if($dose->id == $selectedDose->id) selected @endif>{{ $dose->name }}
                </option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="row">
        <div class="mb-3 col-md-6">
            <label for="" class="form-label cm">Size of pack</label>
            <select name="size_id" class="form-select kit-form-control">
                @foreach ($sizes as $size)
                <option value="{{ $size->id }}" @if($size->id == $selectedSize->id) selected @endif>{{ $size->name }}
                </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3 col-md-6">
            <label for="" class="form-label cm">Expirydate Claim</label>
            <select name="expirydate_claim" class="form-select kit-form-control mySelect">
            <option value="1" selected disabled>Select</option>
            @foreach ($expirydates as $expirydate)
                <option value="{{ $expirydate->id }}" @if($expirydate->id == $selectedExpirydate->id) selected
                    @endif>{{ $expirydate->name }}</option>
            @endforeach
            </select>
        </div>
    </div>
    <div class="row">
        <div class="mb-3 col-md-6">
            <label for="" class="form-label cm">Name of Importer</label>
            <select name="importers[]" class="form-select kit-form-control multipleselect" multiple="multiple" multiple>
                @foreach ($importers as $importer)
                <option value="{{ $importer->id }}" @if(in_array($importer->id, $selectedImporters)) selected
                    @endif>{{ $importer->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3 col-md-6">
            <label for="" class="form-label cm">Name of Manufacturer</label>
            <select name="manufacturer_id" class="form-select kit-form-control">
                @foreach ($manufactures as $manufacturer)
                <option value="{{ $manufacturer->id }}" @if($manufacturer->id == $selectedManufacturer->id) selected
                    @endif>{{ $manufacturer->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="row">
        <div class="mb-3 col-md-6">
            <label for="" class="form-label cm">Lab</label>
            <select name="lab_id" class="form-select kit-form-control">
                @foreach ($labs as $lab)
                <option value="{{ $lab->id }}" @if($lab->id == $selectedLab->id) selected @endif>{{ $lab->name }}
                </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3 col-md-6">
            <label for="" class="form-label cm">Capital of firm</label>
            <select name="capital_id" class="form-select kit-form-control">
                @foreach ($capitals as $capital)
                <option value="{{ $capital->id }}" @if($capital->id == $selectedCapital->id) selected
                    @endif>{{ $capital->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="row">
        <div class="mb-3 col-md-4">
            <label for="" class="form-label cm">GMP certificate</label>
            <select class="form-select kit-form-control" aria-label="Default select example" name="gmp_certificate">
                <option value="Attached" @if($product->gmp_certificate == 'Attached') selected @endif>Attached</option>
                <option value="Not Attached" @if($product->gmp_certificate == 'Not Attached') selected @endif>Not
                    Attached</option>
            </select>
        </div>

        <div class="mb-3 col-md-4">
            <label for="" class="form-label cm">GMP certifing agency</label>
            <select name="gmp_id" class="form-select kit-form-control">
                @foreach ($agencies as $agency)
                <option value="{{ $agency->id }}" @if($agency->id == $selectedAgency->id) selected
                    @endif>{{ $agency->name }}</option>
                @endforeach
            </select>
        </div>
        
        <div class="mb-3 col-md-4">
            <label for="" class="form-label cm">GMP certificate validity upto</label>
            <input type="date" class="form-control cm" placeholder="Select GMP certificate validity upto"
                name="gmp_validity_upto" value="{{ $product->gmp_validity_upto }}">
        </div>
    </div>
    <div class="row">
        <div class="mb-3 col-md-6">
            <label for="" class="form-label cm">Composition</label>
            <select class="form-select kit-form-control multipleselect" name="compositions[]" multiple="multiple" multiple> 
                @foreach ($ingredients as $ingredient)
                <option value="{{ $ingredient->id }}" @if(in_array($ingredient->id, $selectedCompositions)) selected
                    @endif>
                    {{ $ingredient->name }}
                </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3 col-md-6">
            <label for="" class="form-label cm">Ingredients</label>
            <select class="form-select kit-form-control multipleselect" name="ingredients[]" multiple="multiple" multiple>
                @foreach ($ingredients as $ingredient)
                <option value="{{ $ingredient->id }}" @if(in_array($ingredient->id, $selectedIngredients)) selected
                    @endif>
                    {{ $ingredient->name }}
                </option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="row">
        <div class="mb-3 col-md-6">
            <label for="" class="form-label cm">Units per ingredients</label>
            <input type="text" class="form-control cm" placeholder="Enter unit per ingedients(Capsule, 5 Gram etc.)" name="ingredient_unit" value="{{ $product->ingredient_unit }}">
        </div>

        <div class="mb-3 col-md-6">
            <label for="" class="form-label cm">Label of product</label>
            <select class="form-select kit-form-control" aria-label="Default select example" name="product_label">
                <option value="Provided" @if($product->product_label == 'Provided') selected @endif>Provided</option>
                <option value="Not Provided" @if($product->product_label == 'Not Provided') selected @endif>Not Provided
                </option>
            </select>
        </div>
    </div>
    <div class="row @if(Auth::user()->role!=0 || Auth::user()->role!=1) mb-5 @endif">
        <div class="col-md-12 mb-3">
        <label for="" class="form-label cm">Selected Product Label Images</label>
            @foreach ($product->images as $image)
            <div>
                <img src="{{ Storage::url($image->label_image) }}" alt="{{ $product->name }}">
                <label for="remove_image_{{ $image->id }}">Remove</label>
                <input type="checkbox" name="remove_images[]" id="remove_image_{{ $image->id }}"
                    value="{{ $image->id }}">
            </div>
            @endforeach
        </div>
        <div class="col-md-12 mb-3">
            <label for="new_images">Add New Images:</label>
            <input type="file" class="form-control cm" name="new_images[]" id="new_images" multiple>
        </div>
    </div>
    @if(Auth::user()->role==0 || Auth::user()->role==1)
    <div class="row">
        <div class="mb-3 col-md-6">
            <label for="" class="form-label cm">Fisical Year</label>
            <input type="text" class="form-control cm" placeholder="Enter Name of Product" name="fy"
                value="{{ $product->fy }}">
        </div>
        <div class="mb-3 col-md-6">
            <label for="" class="form-label cm">Voucher Number</label>
            <input type="text" class="form-control cm" placeholder="Enter payment voucher number" name="voucher_number" value="{{ $product->voucher_number }}">
        </div>
    </div>
    <div class="row mb-5">
        <div class="mb-3 col-md-6">
            <label for="" class="form-label cm">Voucher Amount</label>
            <input type="text" class="form-control cm" placeholder="Enter paid amount" name="voucher_number" value="{{ $product->voucher_amount }}">
        </div>
        <div class="mb-3 col-md-6">
            <label for="" class="form-label cm">Status</label>
            <select class="form-select kit-form-control" aria-label="Default select example" name="status">
                <option value="Pending" @if($product->status == 'Pending') selected @endif>Pending</option>
                <option value="Verified" @if($product->status == 'Verified') selected @endif>Verified</option>
            </select>
        </div>
    </div>
    @endif
    <div class="row">
        <div class="mb-3 col-md-6">
            <label for="" class="form-label cm">Product specification</label>
            <select class="form-select kit-form-control" aria-label="Default select example"
                name="product_specification">
                <option value="Provided" @if($product->product_specification == 'Provided') selected @endif>Provided
                </option>
                <option value="Not Provided" @if($product->product_specification == 'Not Provided') selected @endif>Not
                    Provided</option>
            </select>
        </div>
        <div class="mb-3 col-md-6">
            <label for="" class="form-label cm">Product registration certificate</label>
            <select class="form-select kit-form-control" aria-label="Default select example"
                name="product_registration_certificate">
                <option value="Provided" @if($product->product_registration_certificate == 'Provided') selected
                    @endif>Provided</option>
                <option value="Not Provided" @if($product->product_registration_certificate == 'Not Provided') selected
                    @endif>Not Provided</option>
            </select>
        </div>
    </div>
    <div class="row">
        <div class="mb-3 col-md-6">
            <label for="" class="form-label cm">Health Claim</label>
            <select class="form-select kit-form-control" aria-label="Default select example" name="health_claim">
                <option value="Allowed" @if($product->health_claim == 'Allowed') selected @endif>Allowed</option>
                <option value="Not Allowed" @if($product->health_claim == 'Not Allowed') selected @endif>Not Allowed
                </option>
            </select>
        </div>
        <div class="mb-3 col-md-6">
            <label for="" class="form-label cm">Nutritional Claim</label>
            <select class="form-select kit-form-control" aria-label="Default select example" name="nutritional_claim">
                <option value="Verified" @if($product->nutritional_claim == 'Verified') selected @endif>Verified
                </option>
                <option value="Not Verified" @if($product->nutritional_claim == 'Not Provided') selected @endif>Not
                    Verified</option>
            </select>
        </div>
    </div>
    <div class="row">
        <div class="mb-3 col-md-6">
            <label for="" class="form-label cm">Statement of Not for medical use</label>
            <select class="form-select kit-form-control" aria-label="Default select example" name="medical_statement">
                <option value="Stated" @if($product->medical_statement == 'Stated') selected @endif>Stated</option>
                <option value="Not Stated" @if($product->medical_statement == 'Not Stated') selected @endif>Not Stated
                </option>
            </select>
        </div>
        <div class="mb-3 col-md-6">
            <label for="" class="form-label cm">This product is not intended to treat, cure or diagnose</label>
            <select class="form-select kit-form-control" aria-label="Default select example" name="diagnose_statement">
                <option value="Mentioned" @if($product->diagnose_statement == 'Mentioned') selected @endif>Mentioned
                </option>
                <option value="Not Mentioned" @if($product->diagnose_statement == 'Not Mentioned') selected @endif>Not
                    Mentioned</option>
            </select>
        </div>
    </div>
    <div class="row">
        <div class="mb-3 col-md-6">
            <label for="" class="form-label cm">Dietary supplement or similar</label>
            <select class="form-select kit-form-control" aria-label="Default select example" name="dietary_supplement">
                <option value="Mentioned" @if($product->dietary_supplement == 'Mentioned') selected @endif>Mentioned
                </option>
                <option value="Not Mentioned" @if($product->dietary_supplement == 'Not Mentioned') selected @endif>Not
                    Mentioned</option>
            </select>
        </div>
        <div class="mb-3 col-md-6">
            <label for="" class="form-label cm">Specification rational</label>
            <select class="form-select kit-form-control" aria-label="Default select example"
                name="specification_rational">
                <option value="Mentioned" @if($product->specification_rational == 'Mentioned') selected @endif>Mentioned
                </option>
                <option value="Not Mentioned" @if($product->specification_rational == 'Not Mentioned') selected
                    @endif>Not Mentioned</option>
            </select>
        </div>
    </div>
    <div class="row">
        <div class="mb-3 col-md-6">
            <label for="" class="form-label cm">Active ingredients analysis method</label>
            <select class="form-select kit-form-control" aria-label="Default select example" name="analysis_method">
                <option value="Mentioned" @if($product->analysis_method == 'Mentioned') selected @endif>Mentioned
                </option>
                <option value="Not Mentioned" @if($product->analysis_method == 'Not Mentioned') selected @endif>Not
                    Mentioned</option>
            </select>
        </div>
        <div class="mb-3 col-md-6">
            <label for="" class="form-label cm">Process flow chart</label>
            <select class="form-select kit-form-control" aria-label="Default select example" name="process_flow">
                <option value="Attached" @if($product->process_flow == 'Attached') selected @endif>Attached</option>
                <option value="Not Attached" @if($product->process_flow == 'Not Attached') selected @endif>Not Attached
                </option>
            </select>
        </div>
    </div>
    
    <div class="row">
        <div class="mb-3 col-md-4">
            <label for="" class="form-label cm">COA inhouse</label>
            <select class="form-select kit-form-control" aria-label="Default select example" name="coa_inhouse">
                <option value="Attached" @if($product->coa_inhouse == 'Attached') selected @endif>Attached</option>
                <option value="Not Attached" @if($product->coa_inhouse == 'Not Attached') selected @endif>Not Attached
                </option>
            </select>
        </div>
        <div class="mb-3 col-md-4">
            <label for="" class="form-label cm">COA thirdparty</label>
            <select class="form-select kit-form-control" aria-label="Default select example" name="coa_thirdparty">
                <option value="Attached" @if($product->coa_thirdparty == 'Attached') selected @endif>Attached</option>
                <option value="Not Attached" @if($product->coa_thirdparty == 'Not Attached') selected @endif>Not
                    Attached</option>
            </select>
        </div>
        <div class="mb-3 col-md-4">
            <label for="" class="form-label cm">COA Product Standard</label>
            <select class="form-select kit-form-control" aria-label="Default select example"
                name="coa_product_standard">
                <option value="Compiles" @if($product->coa_product_standard == 'Compiles') selected @endif>Compiles
                </option>
                <option value="Not Compiles" @if($product->coa_product_standard == 'Not Compiles') selected @endif>Not
                    Compiles</option>
            </select>
        </div>
    </div>
    <div class="row">
        <div class="mb-3 col-md-6">
            <label for="" class="form-label cm">Free sale certificate</label>
            <select class="form-select kit-form-control" aria-label="Default select example" name="sale_certificate">
                <option value="Attached" @if($product->sale_certificate == 'Attached') selected @endif>Attached</option>
                <option value="Not Attached" @if($product->sale_certificate == 'Not Attached') selected @endif>Not
                    Attached</option>
            </select>
        </div>
        <div class="mb-3 col-md-6">
            <label for="" class="form-label cm">Authorization letter</label>
            <select class="form-select kit-form-control" aria-label="Default select example"
                name="authorization_letter">
                <option value="Provided and Attached" @if($product->authorization_letter == 'Provided and Attached')
                    selected @endif>Provided and attached</option>
                <option value="Not Provided" @if($product->authorization_letter == 'Not Provided') selected @endif>Not
                    Provided</option>
            </select>
        </div>
    </div>



    <div class="row">
        <div class="mb-3 col-md-6">
            <label for="" class="form-label cm">Overall opinion</label>
            <select class="form-select kit-form-control" aria-label="Default select example" name="overall_openion">
                <option value="Recommend for approval" @if($product->overall_openion == 'Recommend for approval')
                    selected @endif>Recommend for approval</option>
                <option value="Not Recommend for approval" @if($product->overall_openion == 'Not Recommend for
                    approval') selected @endif>Not Recommend for approval</option>
            </select>
        </div>
    </div>

    <div class="row">
        <div class="mb-3 col-md-12">
            <label for="" class="form-label cm">Remarks (if any)</label>
            <textarea name="remarks"  class="form-control cm" cols="30" rows="4" value="{{ $product->remarks }}"></textarea>
        </div>
    </div>
   
    <button type="submit" class="btn btn-primary">Update</button>
</form>
@endsection