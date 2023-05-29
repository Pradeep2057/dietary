@extends('layouts.main')
@section('title', 'View Renew Certificate')

@section('content')
<div class="add-heading">
    <h3 class="heading-cm">
        <a href="{{ route('renew.index')}}" class="nav-icon me-2">
            <i class="fa-solid fa-angle-left"></i>
        </a>
        Certificate<span class="sub-nav ms-2"> > Renewal > 
            @foreach ($products as $product)
                @if($product->id == $selectedProduct->id)
                    {{ $product->name }}
                @endif
            @endforeach > View</span>
    </h3>
    <p><a href="{{ route('renew.index')}}">View Certificates</a></p>
</div>


<div class="product-search-form mb-3">
   <div class="row log-details">

        <div class="col-md-3">
            <div class="row">
                <p>Created By</p>
                <h4>{{ $renew->author->name }}</h4>
            </div>
            <div class="row mt-2">
                <p>Created at</p>
                <h4>{{ $renew->created_at}}</h4>
            </div>
        </div>

        @if($renew->pending_id != null)
        <div class="col-md-3">
            <div class="row">
                <p>Status changed by</p>
                <h4>{{ $renew->pending->name }}</h4>
            </div>
            <div class="row mt-2">
                <p>Status changed at</p>
                <h4>{{ $renew->pending_at }}</h4>
            </div>
        </div>
        @else
        <div class="col-md-3"></div>   
        @endif

        @if($renew->verifier_id != null)
        <div class="col-md-3">
            <div class="row">
                <p>Verified By</p>
                <h4>{{ $renew->verifier->name }}</h4>
            </div>
            <div class="row mt-2">
                <p>Rejected at</p>
                <h4>{{ $renew->verified_at }}</h4>
            </div>
        </div>
        @else
        <div class="col-md-3"></div>
        @endif
        <div class="col-md-3 log-status">
            <div class="@if($renew->status == 'Pending') pending @elseif($renew->status == 'Verified') verified @else rejected @endif">{{ $renew->status}}</div>
        </div>
   </div>
</div>


<div class="view-page">
<h3 class="create-form-heading">Certificate Details</h3>
        <div class="row">
            <div class="col-md-4">
                <h4>Name of Product</h4>
                <p>@foreach ($products as $product)
                @if($product->id == $selectedProduct->id)
                    {{ $product->name }}
                @endif
            @endforeach</p>
            </div>
            <div class="col-md-4">
                <h4>Application Number and Date</h4>
                <p>{{ $renew->application_number }}</p>
            </div>
            <div class="col-md-4">
                <h4>Date of Grant</h4>
                <p>{{ $renew->date_of_grant}}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <h4>Certifi Validity From</h4>
                <p>{{ $renew->validity_from }}</p>
            </div>
            <div class="col-md-4">
                <h4>Certificate Valid To</h4>
                <p>{{ $renew->validity_to }}</p>
            </div>
            <div class="col-md-4">
                <h4>Renew Valid Till</h4>
                <p>{{ $renew->renew_valid}}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <h4>GMP Validity Upto</h4>
                <p>{{ $renew->gmp_validity}}</p>
            </div>
            <div class="col-md-4">
                <h4>Prepared By</h4>
                <p>{{ $renew->prepared_by }}</p>
            </div>
            <div class="col-md-4">
                <h4>Post</h4>
                <p>{{ $renew->post }}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <h4>Voucher Number</h4>
                <p>{{ $renew->voucher_number}}</p>
            </div>
            <div class="col-md-4">
                <h4>Voucher Amount</h4>
                <p>{{ $renew->voucher_amount }}</p>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <h4>Date of Preparation</h4>
                <p>{{ $renew->date_of_preparation}}</p>
            </div>
        </div>
</div>




@endsection