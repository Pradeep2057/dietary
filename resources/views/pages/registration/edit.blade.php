@extends('layouts.main')
@section('title', 'Edit Product Registration Report')

@section('content')
<div class="add-heading">
    <h3 class="heading-cm"> 
        <a href="{{ route('registration.index')}}" class="nav-icon me-2">
            <i class="fa-solid fa-angle-left"></i>
        </a>
        Certificate<span class="sub-nav ms-2" > > Product Registration > Edit</span>
    </h3>
    <p><a href="{{ route('registration.index')}}">View All</a></p>
</div>

<form action="{{ route('registration.update', $registration) }}" method="POST" class="form-cm">
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
            <input type="text" class="form-control cm" placeholder="Enter application number and date" name="application_number" value="{{  $registration->application_number}}">
        </div>
        <div class="col-md-4">
            <label for="" class="form-label cm">Date of Approval</label>
            <input type="date" class="form-control cm" placeholder="Enter Certificate Validity from"  value="{{ $registration->approval }}" name="approval">
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-6">
            <label for="" class="form-label cm">Validity</label>
            <input type="date" class="form-control cm" placeholder="Enter validity date" value="{{ $registration->validity }}" name="validity">
        </div>
        <div class="col-md-6">
            <label for="" class="form-label cm">Date of Preparation</label>
            <input type="date" class="form-control cm" placeholder="Select Date" name="date_of_preparation" value="{{ $registration->date_of_preparation }}">
        </div>
    </div>   
    
    <div class="row mb-3">
        @if(Auth::user()->role==0 || Auth::user()->role==1)
        <div class="mb-3 col-md-4">
            <label for="" class="form-label cm">Status</label>
            <select class="form-select kit-form-control" aria-label="Default select example" name="status">
                <option value="Processing" @if($registration->status == 'Processing') selected @endif>Processing</option>
                <option value="Pending" @if($registration->status == 'Pending') selected @endif>Pending</option>
                @if(Auth::user()->role==0)
                <option value="Verified" @if($registration->status == 'Pending') selected @endif>Verified</option>
                @endif
            </select>
        </div>
        @endif
    </div>
    
    <button type="submit" class="btn btn-primary">Update</button>
</form>
@endsection