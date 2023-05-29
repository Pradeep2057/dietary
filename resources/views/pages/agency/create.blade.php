@extends('layouts.main')
@section('title', 'Create Size Form')

@section('content')
<div class="add-heading">
    <h3 class="heading-cm">
        <a href="{{ route('agency.index')}}" class="nav-icon me-2">
            <i class="fa-solid fa-angle-left"></i> 
        </a>
        Certifying Agency <span class="sub-nav ms-2" > > Create</span>
    </h3>
    <p><a href="{{ route('agency.index')}}"> <i class="fa-regular fa-eye"></i>View Certifying Agencies</a></p>
</div>

<form action="{{ route('agency.store') }}" method="POST" class="form-cm">
    <div class="col-md-12">
        <h3 class="create-form-heading">Create Certifying Agency</h3>
    </div>
@csrf
    <div class="row mb-3">
        <div class="col-md-6">
            <label for="" class="form-label cm">Agency Name</label>
            <input type="text" class="form-control cm" placeholder="Enter Size Name" name="name">
        </div>
        <div class="col-md-6">
            <label for="" class="form-label cm">Agency Address</label>
            <input type="text" class="form-control cm" placeholder="Enter Size Name" name="address">
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-12">
            <label for="" class="form-label cm">Agency Description</label>
            <textarea type="text" class="form-control cm" placeholder="Enter Size Name" name="description" style="height: 120px;"></textarea>
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Create</button>
</form>
@endsection

