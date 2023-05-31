@extends('layouts.main')
@section('title', 'Edit Production Renew Report')

@section('content')
<div class="add-heading">
    <h3 class="heading-cm"> 
        <a href="{{ route('renew.index')}}" class="nav-icon me-2">
            <i class="fa-solid fa-angle-left"></i> 
        </a>
        Certificate<span class="sub-nav ms-2" > > Tippani Renew > Edit</span>
    </h3>
    <p><a href="{{ route('renew.index')}}"> <i class="fa-regular fa-eye"></i>View Certificates</a></p>
</div>

<form action="{{ route('renew.update', $renew) }}" method="post" class="form-cm">
    <div class="col-md-12">
        <h3 class="create-form-heading">Edit Certificate</h3>
    </div>
    @csrf
    @method('PUT')
    <div class="row mb-3">
        <div class="col-md-3">
            <label for="" class="form-label cm">Product Name</label>
            <select class="form-select kit-form-control mySelect @error('product_id') is-invalid @enderror" name="product_id" aria-label="Default select example">
            @foreach ($products as $product)
            <option value="{{ $product->id }}" @if($product->id == $selectedProduct->id) selected @endif>
                    {{ $product->name }}
            </option>
            @endforeach
            </select>
        </div>
        <div class="col-md-3">
            <label for="" class="form-label cm">Application Number and Date</label>
            <input type="text" class="form-control cm @error('application_number') is-invalid @enderror" placeholder="Enter application number and date" name="application_number" value="{{  $renew->application_number }}">
        </div>
        <div class="col-md-3">
            <label for="" class="form-label cm">Date of Grant</label>
            <input type="text" class="form-control cm date-picker @error('date_of_grant') is-invalid @enderror" data-single="1" placeholder="Select Date" name="date_of_grant" value="{{ $renew->date_of_grant }}">
        </div>
        <div class="col-md-3">
            <label for="" class="form-label cm">Renew Valid Till</label>
            <input type="text" class="form-control cm date-picker  @error('renew_valid') is-invalid @enderror" data-single="1" placeholder="Select Date" name="renew_valid" value="{{ $renew->renew_valid }}">
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-4">
            <label for="" class="form-label cm">Certificate Validity from</label>
            <input type="text" class="form-control cm date-picker @error('validity_from') is-invalid @enderror" data-single="1" placeholder="Select Date" name="validity_from" value="{{ $renew->validity_from }}">
        </div>

        <div class="col-md-4">
            <label for="" class="form-label cm"> Certificate Validity to</label>
            <input type="text" class="form-control cm date-picker @error('validity_to') is-invalid @enderror" data-single="1" placeholder="Select Date" name="validity_to" value="{{ $renew->validity_to }}">
        </div>
        <div class="col-md-4">
            <label for="" class="form-label cm">GMP Validity upto </label>
            <input type="date" class="form-control cm @error('gmp_validity') is-invalid @enderror" placeholder="Enter GMP Validity upto" name="gmp_validity" value="{{ $renew->gmp_validity }}">
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-4">
            <label for="" class="form-label cm">Prepared By</label>
            <input type="text" class="form-control cm @error('prepared_by') is-invalid @enderror" placeholder="Enter Prepared By" name="prepared_by" value="{{ $renew->prepared_by }}">
        </div>
        <div class="col-md-4">
            <label for="" class="form-label cm">Post</label>
            <input type="text" class="form-control cm @error('post') is-invalid @enderror" placeholder="Enter Post" name="post" value="{{ $renew->post }}">
        </div>
        <div class="col-md-4">
            <label for="" class="form-label cm">Date of Preparation</label>
            <input type="text" class="form-control cm date-picker @error('date_of_preparation') is-invalid @enderror" data-single="1" placeholder="Select Date" name="date_of_preparation" value="{{ $renew->date_of_preparation }}">
        </div>
    </div>


    
    @if(Auth::user()->role!=2)
    <div class="row">
        <div class="col-md-12 text-end"><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Proceed</button></div>
    </div>
    @endif
    

    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered approval-modal">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Remarks</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                @if(Auth::user()->role==2)
                <input type="text" class="form-control cm" placeholder="Enter payment voucher number" name="voucher_number" value="" hidden>
                <input type="number" class="form-control cm" placeholder="Enter payment voucher number" name="voucher_amount" value="" hidden>
                @else
                    <div class="row">
                        <div class="mb-3 col-md-12">
                            <label for="" class="form-label cm">Voucher Number</label>
                            <input type="text" class="form-control cm" placeholder="Enter payment voucher number" name="voucher_number" value="{{ $renew->voucher_number }}" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 col-md-12">
                            <label for="" class="form-label cm">Voucher Amount</label>
                            <input type="number" class="form-control cm" placeholder="Enter paid amount" name="voucher_amount" value="{{ $renew->voucher_amount }}" required>
                        </div>
                    </div>
                @endif
            </div>
            @if(Auth::user()->role==1)
            <div class="modal-footer">
                <button type="submit" name="verify" class="btn btn-primary">Update</button>
            </div>
            @elseif(Auth::user()->role==0)
            <div class="modal-footer">
                <button type="submit" name="verify" class="btn btn-primary">Update</button>
            </div>
            @endif
            </div>
        </div>
    </div>

    @if(Auth::user()->role==2)
    <div class="row">
        <div class="col-md-12 text-end"><button type="submit" class="btn btn-primary" >Update</button></div>
    </div>
    @endif
</form>
@endsection


@section('custom-js')
    <script src="{{ asset('datepicker/nepali-date-picker.min.js') }}"></script>
    <script>
		jQuery(document).ready(function () {
			$('.date-picker').nepaliDatePicker();
		})
	</script>
@endsection