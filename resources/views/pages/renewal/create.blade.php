@extends('layouts.main')
@section('title', 'Create Product Renewal Certificate')

@section('content')
<div class="add-heading">
    <h3 class="heading-cm"> 
        <a href="{{ route('renewal.index')}}" class="nav-icon me-2">
            <i class="fa-solid fa-angle-left"></i>
        </a>
        Certificate<span class="sub-nav ms-2" > > Product Renewal > Create</span>
    </h3>
    <p><a href="{{ route('renewal.index')}}">View All</a></p>
</div>

<form action="{{ route('renewal.store') }}" method="POST" class="form-cm">
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
            <label for="" class="form-label cm">Valid From</label>
            <input type="date" class="form-control cm" placeholder="Enter Certificate Validity from" name="valid_from">
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-6">
            <label for="" class="form-label cm">Valid To</label>
            <input type="date" class="form-control cm" placeholder="Enter validity date" name="valid_to">
        </div>
        <div class="col-md-6">
            <label for="" class="form-label cm">Date of Preparation</label>
            <input type="date" class="form-control cm" placeholder="Select Date" name="date_of_preparation">
        </div>
    </div> 
    <button type="submit" class="btn btn-primary">Create</button>
</form>
@endsection