@extends('layouts.main')
@section('title', 'Add Manufacturer')

@section('content')
<div class="add-heading">
    <h3 class="heading-cm"> 
        <a href="{{ route('manufacturer.index')}}" class="nav-icon me-2">
            <i class="fa-solid fa-angle-left"></i> 
        </a>
        Manufacturer<span class="sub-nav ms-2" > > Create</span>
    </h3>
    <p><a href="{{ route('manufacturer.index')}}"> <i class="fa-regular fa-eye"></i>View Manufacturers</a></p>
</div>

<form action="{{ route('manufacturer.store') }}" method="POST" class="form-cm">
    <div class="col-md-12">
        <h3 class="create-form-heading">Create Manufacturer</h3>
    </div>
    @csrf
    <div class="row mb-3">
        <div class="col-md-6">
            <label for="" class="form-label cm">Manufacture Name</label>
            <input type="text" class="form-control cm" placeholder="Enter Manufacture Name" name="name">
        </div>
        <div class="col-md-6">
            <label for="" class="form-label cm">Registration Number</label>
            <input type="text" class="form-control cm" placeholder="Enter Registration Number"
                name="registration_number">
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-6">
            <label for="" class="form-label cm">Registration Authority</label>
            <select class="form-select kit-form-control mySelect" aria-label="Default select example"
                name="registration_authority">
                <option value=" " selected disabled>Select Registration Authority</option>
                @foreach ($manufacturerauthorities as $manufacturerauthority)
                <option value="{{ $manufacturerauthority->id }}">{{ $manufacturerauthority->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-6">
            <label for="" class="form-label cm">Registartion Validity</label>
            <input type="date" class="form-control cm" placeholder="Enter Firm No." name="registration_validity">
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-12">
            <label for="" class="form-label cm"> Country</label>
            <select class="form-select kit-form-control mySelect" name="country_id" aria-label="Default select example">
                <option value=" " selected disabled>Select Country</option>
                @foreach ($countries as $country)
                <option value="{{ $country->id }}">{{ $country->name }}</option>
                @endforeach
            </select>
        </div>

    </div>

    <button type="submit" class="btn btn-primary">Create</button>
</form>
@endsection