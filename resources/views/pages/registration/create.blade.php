@extends('layouts.main')
@section('title', 'Create Product Registration Report')

@section('content')
<div class="add-heading">
    <h3 class="heading-cm"> 
        <a href="{{ route('registration.index')}}" class="nav-icon me-2">
            <i class="fa-solid fa-angle-left"></i> 
        </a>
        Certificate<span class="sub-nav ms-2" > > Product Registration > Create</span>
    </h3>
    <p><a href="{{ route('registration.index')}}">View All</a></p>
</div>

<form action="{{ route('registration.store') }}" method="POST" class="form-cm">
    
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
            <label for="" class="form-label cm">Date of Approval</label>
            <input type="date" class="form-control cm" placeholder="Enter Certificate Validity from" name="approval">
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-6">
            <label for="" class="form-label cm">Validity</label>
            <input type="date" class="form-control cm" placeholder="Enter validity date" name="validity">
        </div>
        <div class="col-md-6">
            <label for="" class="form-label cm">Date of Preparation</label>
            <input type="date" class="form-control cm" placeholder="Select Date" name="date_of_preparation">
        </div>
    </div> 
    <button type="submit" class="btn btn-primary">Create</button>
</form>
@endsection