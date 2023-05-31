@extends('layouts.main')
@section('title', 'Create Product Type')

@section('content')
<div class="add-heading">
    <h3 class="heading-cm">
        <a href="{{ route('product.index')}}" class="nav-icon me-2">
            <i class="fa-solid fa-angle-left"></i>
        </a>
        Products<span class="sub-nav ms-2"> > Create</span>
    </h3>
    <p><a href="{{ route('product.index')}}"><i class="fa-regular fa-eye"></i>View Products</a></p>
</div>


<form action="{{ route('product.fill') }}" method="GET" class="mb-3 product-search-form">
    <div class="row">
        <div class="col-md-8" style="position: relative">
            <span class="material-symbols-outlined prd-search">
                search
                </span>
            <select name="productId" class="form-select kit-form-control mySelect" id="prev_product">
                <option value="0" selected disabled>Select similar product</option>
                @foreach ($products as $product)
                <option value="{{ $product->id }}">{{ $product->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2">
            <button type="submit" class="btn btn-primary w-100" >Fill</button>
        </div>
        <div class="col-md-2">
            <input type="reset" value="Reset Form" id="reset">
        </div>
    </div>
</form>





<form action="{{ route('product.store') }}" method="POST" class="form-cm" enctype="multipart/form-data" id="myForm">
    <div class="col-md-12">
        <h3 class="create-form-heading">Create Product</h3>
    </div>
    @csrf
    <div class="accordion" id="accordionPanelsStayOpenExample">
        <div class="accordion-item mb-4">
          <h2 class="accordion-header cm">
            <button class="accordion-button cm " type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="true" aria-controls="panelsStayOpen-collapseOne">
              Product Details
            </button>
          </h2>
          <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show ">
            <div class="accordion-body w-100 ms-0 mt-4">
                <div class="row mb-2">
                    <div class="mb-3 col-md-6">
                        <label for="" class="form-label cm">Name of Product</label>
                        <input type="text" class="form-control cm @error('name') is-invalid @enderror" placeholder="Enter Name of Product" name="name"
                        @if($templateProduct)
                            value="{{ $templateProduct ? $templateProduct->name : '' }}"
                        @else
                            value="{{ old('name') }}"
                        @endif>
                        @error('name')
                            <small style="color: #ff0000;">{{ $message }}</small>
                        @enderror
                    </div>
                    
                    <div class="mb-3 col-md-6">
                        <label for="" class="form-label cm">Type of Product</label>
                        <select name="product_type" class="form-select kit-form-control mySelect @error('product_type') is-invalid @enderror" value="{{old('product_type')}}">
                            <option value="all" selected disabled>Select product type</option>
                            @foreach ($producttypes as $producttype)
                            <option value="{{ $producttype->id }}"
                                {{ $templateProduct && $templateProducttype->id == $producttype->id ? 'selected' : '' }}>
                                {{ $producttype->name }}</option>
                            @endforeach
                        </select>
                        @error('product_type')
                            <small style="color: #ff0000;">{{ $message }}</small>
                        @enderror
                    </div>
            
                </div>
                <div class="row">
                    <div class="mb-3 col-md-6">
                        <label for="" class="form-label cm">Form of Product</label>
                        <select name="product_form" class="form-select kit-form-control mySelect @error('product_form') is-invalid @enderror">
                            <option value="all" selected disabled>Select product form</option>
                            @foreach ($productforms as $productform)
                            <option value="{{ $productform->id }}"
                                {{ $templateProduct && $templateProductform->id == $productform->id ? 'selected' : '' }}>
                                {{ $productform->name }}</option>
                            @endforeach
                        </select>
                        @error('product_form')
                            <small style="color: #ff0000;">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="" class="form-label cm">Dose specified</label>
                        <select name="dose_id" class="form-select kit-form-control mySelect @error('dose_id') is-invalid @enderror" aria-label="Default select example">
                            <option value="all" selected disabled>Select dose</option>
                            @foreach ($doses as $dose)
                            <option value="{{ $dose->id }}"
                                {{ $templateProduct && $templateDose->id == $dose->id ? 'selected' : '' }}>{{ $dose->name }}
                            </option>
                            @endforeach
                        </select>
                        @error('dose_id')
                            <small style="color: #ff0000;">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="row mb-2">
                    <div class="mb-3 col-md-6">
                        <label for="" class="form-label cm">Size of pack</label>
                        <select name="size_id" class="form-select kit-form-control mySelect @error('size_id') is-invalid @enderror">
                            <option value="all" selected disabled>Select size</option>
                            @foreach ($sizes as $size)
                            <option value="{{ $size->id }}"
                                {{ $templateProduct && $templateSize->id == $size->id ? 'selected' : '' }}>{{ $size->name }}
                            </option>
                            @endforeach
                        </select>
                        @error('size_id')
                            <small style="color: #ff0000;">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="" class="form-label cm">Expirydate Claim</label>
                        <select name="expirydate_claim" class="form-select kit-form-control mySelect">
                            <option value="all" selected disabled>Select expiry date</option>
                            @foreach ($expirydates as $expirydate)
                            <option value="{{ $expirydate->id }}"
                                {{ $templateProduct && $templateExpirydate->id == $expirydate->id ? 'selected' : '' }}>
                                {{ $expirydate->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row">

                    <div class="mb-3 col-md-6">
                        <label for="" class="form-label cm">Name of Importer</label>
                        <select name="importers[]" class="form-select kit-form-control multipleselect" multiple="multiple" multiple>
                            @foreach ($importers as $importer)
                                <option value="{{ $importer->id }}" @if($templateProduct && (in_array($importer->id, $templateImporters))) selected @endif>{{ $importer->name }} </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3 col-md-6">
                        <label for="" class="form-label cm">Name of Manufacturer</label>
                        <select name="manufacturer_id" class="form-select kit-form-control mySelect @error('manufacturer_id') is-invalid @enderror">
                            <option value="all" selected disabled>Select Manufacturer</option>
                            @foreach ($manufacturers as $manufacturer)
                            <option value="{{ $manufacturer->id }}" {{ $templateProduct && $templateManufacturer->id == $manufacturer->id ? 'selected' : '' }}>{{ $manufacturer->name }}</option>
                            @endforeach
                        </select>
                        @error('manufacturer_id')
                            <small style="color: #ff0000;">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="mb-3 col-md-6">
                        <label for="" class="form-label cm">Lab</label>
                        <select name="lab_id" class="form-select kit-form-control mySelect @error('lab_id') is-invalid @enderror">
                            <option value="all" selected disabled>Select Lab</option>
                            @foreach ($labs as $lab)
                            <option value="{{ $lab->id }}" {{ $templateProduct && $templateLab->id == $lab->id ? 'selected' : '' }}>{{ $lab->name }}</option>
                            @endforeach
                        </select>
                        @error('lab_id')
                            <small style="color: #ff0000;">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="" class="form-label cm">Capital of firm</label>
                        <select name="capital_id" class="form-select kit-form-control mySelect @error('capital_id') is-invalid @enderror">
                            <option value="all" selected disabled>Select Capital</option>
                            @foreach ($capitals as $capital)
                            <option value="{{ $capital->id }}" {{ $templateProduct && $templateCapital->id == $capital->id ? 'selected' : '' }}>{{ $capital->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            
                <div class="row">
                    <div class="mb-3 col-md-4">
                        <label for="" class="form-label cm">GMP certificate</label>
                        <select class="form-select kit-form-control" aria-label="Default select example" name="gmp_certificate">
                            <option value="Attached" selected>Attached</option>
                            <option value="Not Attached">Not Attached</option>
                        </select>
                    </div>
                    <div class="mb-3 col-md-4">
                        <label for="" class="form-label cm">GMP Certifying Agency</label>
                        <select name="gmp_id" class="form-select kit-form-control mySelect @error('gmp_id') is-invalid @enderror" require>
                            <option value="all" selected disabled>Select GMP Certifying Agency</option>
                            @foreach ($agencies as $agency)
                            <option value="{{ $agency->id }}">{{ $agency->name }}</option>
                            @endforeach
                        </select>
                        @error('gmp_id')
                            <small style="color: #ff0000;">{{ $message }}</small>
                        @enderror
                    </div>
                    <div class="mb-3 col-md-4">
                        <label for="" class="form-label cm">GMP certificate validity upto</label>
                        <input type="date" class="form-control cm @error('gmp_validity_upto') is-invalid @enderror" placeholder="Select GMP certificate validity upto"
                            name="gmp_validity_upto">
                    </div>
                </div>
                <div class="row">
                    <div class="mb-3 col-md-12">
                        <label for="" class="form-label cm">Active ingredients and its quantity</label>
                        <textarea name="ingredients" class="form-control cm @error('ingredients') is-invalid @enderror" cols="30" rows="4">@if($templateProduct){{ $templateIngredients }} @else {{ old('ingredients')}}@endif</textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="mb-3 col-md-6">
                        <label for="" class="form-label cm">Units per ingredients</label>
                        <input type="text" class="form-control cm @error('ingredient_unit') is-invalid @enderror" placeholder="Enter unit per ingedients(Capsule, 5 Gram etc.)"
                            name="ingredient_unit" value="@if($templateProduct){{ $templateIngredientsunit }} @else {{ old('ingredient_unit')}} @endif">
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="" class="form-label cm">Label of product</label>
                        <select class="form-select kit-form-control" aria-label="Default select example" name="product_label">
                            <option value="Provided" selected>Provided</option>
                            <option value="Not Provided">Not Provided</option>
                        </select>
                    </div>
                </div>
                <div class="row mb-5">
                    <div class="mb-3 col-md-12">
                        <label for="" class="form-label cm">Image of Product Label</label>
                        <input type="file" class="form-control cm" name="images[]" multiple>
                    </div>
                </div>            </div>
          </div>
        </div>
        <div class="accordion-item">
          <h2 class="accordion-header cm">
            <button class="accordion-button cm collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseTwo" aria-expanded="false" aria-controls="panelsStayOpen-collapseTwo">
             Add More Details
            </button>
          </h2>
          <div id="panelsStayOpen-collapseTwo" class="accordion-collapse collapse">
            <div class="accordion-body w-100 ms-0 mt-4">

                <div class="row">
                    <div class="mb-3 col-md-6">
                        <label for="" class="form-label cm">Product specification</label>
                        <select class="form-select kit-form-control" aria-label="Default select example"
                            name="product_specification">
                            <option value="Provided" selected>Provided</option>
                            <option value="Not Provided">Not Provided</option>
                        </select>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="" class="form-label cm">Product registration certificate</label>
                        <select class="form-select kit-form-control" aria-label="Default select example"
                            name="product_registration_certificate">
                            <option value="Provided" selected>Provided</option>
                            <option value="Not Provided">Not Provided</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="mb-3 col-md-6">
                        <label for="" class="form-label cm">Health Claim</label>
                        <select class="form-select kit-form-control" aria-label="Default select example" name="health_claim">
                            <option value="Allowed" selected>Allowed</option>
                            <option value="Not Allowed">Not Allowed</option>
                        </select>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="" class="form-label cm">Nutritional Claim</label>
                        <select class="form-select kit-form-control" aria-label="Default select example" name="nutritional_claim">
                            <option value="Verified" selected>Verified</option>
                            <option value="Not Verified">Not Verified</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="mb-3 col-md-6">
                        <label for="" class="form-label cm">Statement of Not for medical use</label>
                        <select class="form-select kit-form-control" aria-label="Default select example" name="medical_statement">
                            <option value="Stated" selected>Stated</option>
                            <option value="Not Stated">Not Stated</option>
                        </select>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="" class="form-label cm">Process flow chart</label>
                        <select class="form-select kit-form-control" aria-label="Default select example" name="process_flow">
                            <option value="Attached" selected>Attached</option>
                            <option value="Not Attached">Not Attached</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="mb-3 col-md-6">
                        <label for="" class="form-label cm">This product is not intended to treat, cure or diagnose</label>
                        <select class="form-select kit-form-control" aria-label="Default select example" name="diagnose_statement">
                            <option value="Mentioned" selected>Mentioned</option>
                            <option value="Not Mentioned">Not Mentioned</option>
                        </select>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="" class="form-label cm">Dietary supplement or similar</label>
                        <select class="form-select kit-form-control" aria-label="Default select example" name="dietary_supplement">
                            <option value="Mentioned" selected>Mentioned</option>
                            <option value="Not Mentioned">Not Mentioned</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="mb-3 col-md-6">
                        <label for="" class="form-label cm">Specification rational</label>
                        <select class="form-select kit-form-control" aria-label="Default select example"
                            name="specification_rational">
                            <option value="Mentioned" selected>Mentioned</option>
                            <option value="Not Mentioned">Not Mentioned</option>
                        </select>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="" class="form-label cm">Active ingredients analysis method</label>
                        <select class="form-select kit-form-control" aria-label="Default select example" name="analysis_method">
                            <option value="Mentioned" selected>Mentioned</option>
                            <option value="Not Mentioned">Not Mentioned</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="mb-3 col-md-4">
                        <label for="" class="form-label cm">COA inhouse</label>
                        <select class="form-select kit-form-control" aria-label="Default select example" name="coa_inhouse">
                            <option value="Attached" selected>Attached</option>
                            <option value="Not Attached">Not Attached</option>
                        </select>
                    </div>
                    <div class="mb-3 col-md-4">
                        <label for="" class="form-label cm">COA thirdparty</label>
                        <select class="form-select kit-form-control " aria-label="Default select example" name="coa_thirdparty">
                            <option value="Attached" selected>Attached</option>
                            <option value="Not Attached">Not Attached</option>
                        </select>
                    </div>
                    <div class="mb-3 col-md-4">
                        <label for="" class="form-label cm">COA Product Standard</label>
                        <select class="form-select kit-form-control" aria-label="Default select example"
                            name="coa_product_standard">
                            <option value="Compiles" selected>Compiles</option>
                            <option value="Not Compiles">Not Compiles</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="mb-3 col-md-6">
                        <label for="" class="form-label cm">Free sale certificate</label>
                        <select class="form-select kit-form-control" aria-label="Default select example" name="sale_certificate">
                            <option value="Attached" selected>Attached</option>
                            <option value="Not Attached">Not Attached</option>
                        </select>
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="" class="form-label cm">Authorization letter</label>
                        <select class="form-select kit-form-control" aria-label="Default select example"
                            name="authorization_letter">
                            <option value="Provided and Attached" selected>Provided and attached</option>
                            <option value="Not Provided">Not Provided</option>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="mb-3 col-md-12">
                        <label for="" class="form-label cm">Overall opinion</label>
                        <select class="form-select kit-form-control" aria-label="Default select example" name="overall_openion">
                            <option value="Recommend for approval" selected>Recommend for approval</option>
                            <option value="Not Recommend for approval">Not Recommend for approval</option>
                        </select>
                    </div>
                </div>
                
                </div>
          </div>
        </div>
      </div>
      <div class="row mt-3">
            <div class="col-md-12 text-end"><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Proceed</button></div>
      </div>

   

    

    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered approval-modal">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Remarks</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            @if(Auth::user()->role==2)
            <div class="modal-body">
                <div class="row">
                    <div class="mb-3 col-md-12">
                        <label for="" class="form-label cm">Remarks (if any)</label>
                        <textarea name="remarks" class="form-control cm" cols="30" rows="4" required></textarea>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Send for Approval</button>
            </div>
            @else
            <div class="modal-body">
                    <div class="row">
                    <div class="mb-3 col-md-12">
                        <label for="" class="form-label cm">Remarks (if any)</label>
                        <textarea name="remarks1" class="form-control cm" cols="30" rows="4" required></textarea>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="submit" name="reject" class="btn btn-primary reject-btn">Reject</button>
                <button type="submit" name="verify" class="btn btn-primary">Verify</button>
            </div>
            @endif
            </div>
        </div>
    </div>
</form>
@endsection


@section ('custom-js')
<script>
    $(document).ready(function() {
      $("#reset").on("click", function () {
        $('#myForm')[0].reset();
        $('#myForm input[type="text"]').val('');
        $('.form-select').val('0').trigger('change.select2'); 
        $("select").each(function() {
          $(this).val($(this).find("option:first").val());
        }); 
      });
    });

</script>
@endsection

