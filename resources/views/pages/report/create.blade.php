@extends('layouts.main')
@section('title', 'Create Production Report')

@section('content')
<div class="add-heading">
    <h3 class="heading-cm"> 
        <a href="{{ route('report.index')}}" class="nav-icon me-2">
        <i class="fa-solid fa-angle-left"></i> 
        </a>
        Certificate<span class="sub-nav ms-2" > > Registration > Create</span>
    </h3>
    <p><a href="{{ route('report.index')}}">View Certificates</a></p>
</div>

<form action="{{ route('report.store') }}" method="POST" class="form-cm">
    @csrf
    <div class="row mb-3">
        <div class="col-md-4">
            <label for="" class="form-label cm">Product Name</label>
            <select class="form-select kit-form-control mySelect" name="product_id" aria-label="Default select example">
                <option value="1" selected disabled>Select Product</option>
                @foreach ($products as $product)
                <option value="{{ $product->id }}">{{ $product->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-4">
            <label for="" class="form-label cm">Application Number and Date</label>
            <input type="text" class="form-control cm" placeholder="Enter application number and date" name="application_number">
        </div>
        <div class="col-md-4">
            <label for="" class="form-label cm">Date of Grant</label>
            <input type="text" class="form-control cm date-picker" data-single="1" placeholder="Select Date" name="date_of_grant">
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-4">
            <label for="" class="form-label cm">Certificate Validity from</label>
            <input type="text" class="form-control cm date-picker" data-single="1" placeholder="Select Date" name="validity_from">
        </div>

        <div class="col-md-4">
            <label for="" class="form-label cm"> Certificate Validity to</label>
            <input type="text" class="form-control cm date-picker" data-single="1" placeholder="Select Date" name="validity_to">
        </div>
        <div class="col-md-4">
            <label for="" class="form-label cm">GMP Validity upto </label>
            <input type="date" class="form-control cm" placeholder="Select Date" name="gmp_validity">
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-4">
            <label for="" class="form-label cm">Prepared By</label>
            <input type="text" class="form-control cm" placeholder="Enter Prepared By" name="prepared_by">
        </div>
        <div class="col-md-4">
            <label for="" class="form-label cm">Post</label>
            <input type="text" class="form-control cm" placeholder="Enter Post" name="post">
        </div>
        <div class="col-md-4">
            <label for="" class="form-label cm">Date of Preparation</label>
            <input type="text" class="form-control cm date-picker" data-single="1" placeholder="Select Date" name="date_of_preparation">
        </div>
    </div>
    
    @if(Auth::user()->role==2)
    <div class="row">
        <div class="col-md-12 text-end"><button type="submit" class="btn btn-primary" >Send for approval</button></div>
    </div>
    @else
    <div class="row">
        <div class="col-md-12 text-end"><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">Proceed</button></div>
    </div>
    @endif
    

    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered approval-modal">
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Payment Details</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                    <div class="row">
                        <div class="mb-3 col-md-12">
                            <label for="" class="form-label cm">Voucher Number</label>
                            <input type="text" class="form-control cm" placeholder="Enter payment voucher number" name="voucher_number">
                        </div>
                    </div>
                    <div class="row">
                        <div class="mb-3 col-md-12">
                            <label for="" class="form-label cm">Voucher Amount</label>
                            <input type="text" class="form-control cm" placeholder="Enter paid amount" name="voucher_amount">
                        </div>
                    </div>
            </div>
            @if(Auth::user()->role==1)
            <div class="modal-footer">
                <button type="submit" name="verify" class="btn btn-primary">Send for approval</button>
            </div>
            @elseif(Auth::user()->role==0)
            <div class="modal-footer">
                <button type="submit" name="verify" class="btn btn-primary">Verify</button>
            </div>
            @endif
            </div>
        </div>
    </div>

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
