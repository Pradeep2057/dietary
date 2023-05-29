@extends('layouts.main')
@section('title', 'Edit Production Report')

@section('content')
<div class="add-heading">
    <h3 class="heading-cm"> 
        <a href="{{ route('report.index')}}" class="nav-icon me-2">
            <i class="fa-solid fa-angle-left"></i>
        </a>
        Certificate<span class="sub-nav ms-2" > > Tippani Registration > Edit</span>
    </h3>
    <p><a href="{{ route('report.index')}}"> <i class="fa-regular fa-eye"></i>View Certificates</a></p>
</div>

<form action="{{ route('report.update', $report) }}" method="post" class="form-cm">
    <div class="col-md-12">
        <h3 class="create-form-heading">Edit Certificate</h3>
    </div>
    @csrf
    @method('PUT')
    <div class="row mb-3">
        <div class="col-md-4">
            <label for="" class="form-label cm">Product Name</label>
            <select class="form-select kit-form-control mySelect" name="product_id" aria-label="Default select example">
            @foreach ($products as $product)
            <option value="{{ $product->id }}" @if($product->id == $selectedProduct->id) selected @endif>
                    {{ $product->name }}
            </option>
            @endforeach
            </select>
        </div>
        <div class="col-md-4">
            <label for="" class="form-label cm">Application Number and Date</label>
            <input type="text" class="form-control cm" placeholder="Enter application number and date" name="application_number" value="{{ $report->application_number }}">
        </div>
        <div class="col-md-4">
            <label for="" class="form-label cm">Date of Grant</label>
            <input type="date" class="form-control cm" placeholder="Enter Date of Grant" name="date_of_grant" value="{{ $report->date_of_grant }}">
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-4">
            <label for="" class="form-label cm">Certificate Validity from</label>
            <input type="date" class="form-control cm" placeholder="Enter Certificate Validity from" name="validity_from" value="{{ $report->validity_from }}">
        </div>

        <div class="col-md-4">
            <label for="" class="form-label cm"> Certificate Validity to</label>
            <input type="date" class="form-control cm" placeholder="Enter Certificate Validity to" name="validity_to" value="{{ $report->validity_to }}">
        </div>
        <div class="col-md-4">
            <label for="" class="form-label cm">GMP Validity upto </label>
            <input type="date" class="form-control cm" placeholder="Enter GMP Validity upto" name="gmp_validity" value="{{ $report->gmp_validity }}">
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-4">
            <label for="" class="form-label cm">Prepared By</label>
            <input type="text" class="form-control cm" placeholder="Enter Prepared By" name="prepared_by" value="{{ $report->prepared_by }}">
        </div>
        <div class="col-md-4">
            <label for="" class="form-label cm">Post</label>
            <input type="text" class="form-control cm" placeholder="Enter Post" name="post" value="{{ $report->post }}">
        </div>
        <div class="col-md-4">
            <label for="" class="form-label cm">Date of Preparation</label>
            <input type="date" class="form-control cm" placeholder="Select Date" name="date_of_preparation" value="{{ $report->date_of_preparation }}">
        </div>
    </div>

    
    
    <button type="submit" class="btn btn-primary">Update</button>
</form>
@endsection