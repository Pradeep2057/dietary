@extends('layouts.main')
@section('title', 'View Product')

@section('content')
<div class="add-heading">
    <h3 class="heading-cm">
        <a href="{{ route('product.index')}}" class="nav-icon me-2">
            <i class="fa-solid fa-angle-left"></i>
        </a>
        Products<span class="sub-nav ms-2"> > {{ $product->name }} > View</span>
    </h3>
    <p><a href="{{ route('product.index')}}">View Products</a></p>
</div>

<div class="product-search-form mb-3">
   <div class="row log-details">
    <div class="col-md-2">
        <p>Created By</p>
        <h4>{{ $product->author->name }}</h4>
    </div>
    <div class="col-md-2">
        <p>Created at</p>
        <h4>{{ $product->created_at}}</h4>
    </div>
    @if($product->status == 'Verified')
    <div class="col-md-2">
        <p>Verified By</p>
        <h4>{{ $product->verifier->name }}</h4>
    </div>
    <div class="col-md-2">
        <p>Verified at</p>
        <h4>{{ $product->verified_at }}</h4>
    </div>
    @elseif($product->status == 'Rejected')
    <div class="col-md-2">
        <p>Rejected By</p>
        <h4>{{ $product->verifier->name }}</h4>
    </div>
    <div class="col-md-2">
        <p>Rejected at</p>
        <h4>{{ $product->verified_at }}</h4>
    </div>
    @else
    <div class="col-md-4"></div>
    @endif
    <div class="col-md-4 log-status">
        <div class="@if($product->status == 'Pending') pending @elseif($product->status == 'Verified') verified @else rejected @endif">{{ $product->status}}</div>
    </div>
   </div>
</div>

<div class="view-page mb-4">
<h3 class="create-form-heading">Product Details</h3>
        <div class="row">
            <div class="col-md-4">
                <h4>Name of Product</h4>
                <p>{{ $product->name }}</p>
            </div>
            <div class="col-md-4">
                <h4>Registration No.</h4>
                <p>{{ $product->registration }}</p>
            </div>
            <div class="col-md-4">
                <h4>Type of Product</h4>
                @if($selectedProducttype)
                <p>
                @foreach ($producttypes as $producttype)
                    @if($producttype->id == $selectedProducttype->id) 
                        {{ $producttype->name }}
                    @endif
                @endforeach
                </p>
                @else
                <p>-</p>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <h4>Form of Product</h4>
                @if($selectedProductform)
                <p>
                @foreach ($productforms as $productform)
                    @if($productform->id == $selectedProductform->id) 
                        {{ $productform->name }}
                    @endif
                @endforeach
                </p>
                @else
                <p>-</p>
                @endif
            </div>
            <div class="col-md-4">
                <h4>Dose specified</h4>
                @if($selectedDose)
                <p>
                @foreach ($doses as $dose)
                    @if($dose->id == $selectedDose->id) {{ $dose->name }} @endif
                @endforeach
                </p>
                @else
                <p>-</p>
                @endif
            </div>
            <div class="col-md-4">
                <h4>Size of pack</h4>
                @if($selectedSize)
                <p>
                @foreach ($sizes as $size)
                    @if($size->id == $selectedSize->id) {{ $size->name }} @endif
                @endforeach
                </p>
                @else
                <p>-</p>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <h4>Expirydate Claim</h4>
                @if($selectedExpirydate)
                <p>
                @foreach ($expirydates as $expirydate)
                    @if($expirydate->id == $selectedExpirydate->id) {{ $expirydate->name }}@endif
                @endforeach
                </p>
                @else
                <p>-</p>
                @endif
            </div>
            <div class="col-md-4">
                <h4>Name of Importer</h4>
                @if($selectedImporters)
                <p>
                @foreach ($importers as $importer)
                    @if(in_array($importer->id, $selectedImporters)) {{ $importer->name }} @endif
                @endforeach
                </p>
                @else
                <p>-</p>
                @endif
            </div>
            <div class="col-md-4">
                <h4>Name of Manufacturer</h4>
                @if($selectedManufacturer)
                <p>
                @foreach ($manufactures as $manufacturer)
                    @if($manufacturer->id == $selectedManufacturer->id) {{ $manufacturer->name }} @endif
                @endforeach
                </p>
                @else
                <p>-</p>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <h4>Lab</h4>
                @if($selectedLab)
                <p>
                @foreach ($labs as $lab)
                    @if($lab->id == $selectedLab->id) {{ $lab->name }} @endif
                @endforeach
                </p>
                @else 
                <p>-</p>
                @endif
            </div>
            <div class="col-md-4">
                <h4>Capital of firm</h4>
                @if($selectedCapital)
                <p>
                @foreach ($capitals as $capital)
                    @if($capital->id == $selectedCapital->id) {{ $capital->name }} @endif
                @endforeach
                </p>
                @else
                <p>-</p>
                @endif
            </div>
            <div class="col-md-4">
                <h4>Unit per ingredients</h4>
                <p>{{ $product->ingredient_unit }}</p>
            </div>
        </div>
        <div class="row mb-4">
            <div class="col-md-12">
                <h4>Ingredients</h4>
                <p>{{ $product->ingredients }}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <h4>GMP certifying agency</h4>
                @if($selectedAgency)
                <p>
                @foreach ($agencies as $agency)
                @if($agency->id == $selectedAgency->id) {{ $agency->name }} @endif
                @endforeach
                </p>
                @else
                <p>-</p>
                @endif
            </div>
            <div class="col-md-4">
                <h4>GMP certificate</h4>
                <p>{{ $product->gmp_certificate }}</p>
            </div>
            <div class="col-md-4">
                <h4>GMP certificate validity upto</h4>
                <p>{{ $product->gmp_validity_upto }}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <h4>Label of product</h4>
                <p>{{ $product->product_label }}</p>
            </div>
        </div>
        <div class="row product-image-row my-5">
            <h4>Image of Product Label</h4>
            @foreach ($product->images as $image)
            <div class="col-md-3">
                <img src="{{ asset(str_replace('public', 'storage', $image->label_image)) }}" alt="{{ $product->name }}">
            </div>
            @endforeach
        </div>
        <div class="row">
            <div class="col-md-4">
                <h4>Overall opinion</h4>
                <p>{{ $product->overall_openion }}</p>
            </div>
            @if(Auth::user()->role==0 || Auth::user()->role==1)
            <div class="col-md-4">
                <h4>Voucher Number</h4>
                <p>{{ $product->voucher_no }}</p>
            </div>
            <div class="col-md-4">
                <h4>Voucher Amount</h4>
                <p>{{ $product->voucher_amount }}</p>
            </div>
            @endif
        </div>
        <div class="row">
            <div class="col-md-4">
                <h4>Product specification</h4>
                <p>{{ $product->product_specification }}</p>
            </div>
            <div class="col-md-4">
                <h4>Product registration certificate</h4>
                <p>{{ $product->product_registration_certificate }}</p>
            </div>
            <div class="col-md-4">
                <h4>Health Claim</h4>
                <p>{{ $product->health_claim }}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <h4>Nutritional Claim</h4>
                <p>{{ $product->nutritional_claim }}</p>
            </div>
            <div class="col-md-4">
                <h4>Statement of Not for medical use</h4>
                <p>{{ $product->medical_statement }}</p>
            </div>
            <div class="col-md-4">
                <h4>Process flow chart</h4>
                <p>{{ $product->process_flow }}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <h4>This product is not intended to treat, cure or diagonase</h4>
                <p>{{ $product->diagnose_statement }}</p>
            </div>
            <div class="col-md-4">
                <h4>Dietary supplement or similar</h4>
                <p>{{ $product->dietary_supplement }}</p>
            </div>
            <div class="col-md-4">
                <h4>Specification rational</h4>
                <p>{{ $product->specification_rational }}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <h4>COA inhouse </h4>
                <p>{{ $product->coa_inhouse }}</p>
            </div>
            <div class="col-md-4">
                <h4>COA thirdparty</h4>
                <p>{{ $product->coa_thirdparty }}</p>
            </div>
            <div class="col-md-4">
                <h4>COA Product Standard</h4>
                <p>{{ $product->coa_product_standard }}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <h4>Active ingredients analysis method</h4>
                <p>{{ $product->analysis_method }}</p>
            </div>
            <div class="col-md-4">
                <h4>Free sale certificate</h4>
                <p>{{ $product->sale_certificate }}</p>
            </div>
            <div class="col-md-4">
                <h4>Authorization letter</h4>
                <p>{{ $product->authorization_letter }}</p>
            </div>
        </div>
        <div class="row remarks-border">
            <div class="col-md-6">
                <h4>Remarks by <br><span class="remarks-by">Data Entry Operator ({{ $product->author->name }})</span></h4>
                <p>@if($product->remarks != null){{ $product->remarks }} @else N/A @endif</p>
            </div>
            @if($product->remarks_1 != null)
            <div class="col-md-6">
                <h4>Remarks by <br><span class="remarks-by">Verifier ({{ $product->verifier->name }})</span></h4>
                <p>{{ $product->remarks_1 }}</p>
            </div>
            @endif
        </div>
</div>

@endsection