@extends('layouts.main')
@section('title', 'Edit manufacturer')

@section('content')
<div class="add-heading">
    <h3 class="heading-cm"> 
        <a href="{{ route('manufacturer.index')}}" class="nav-icon me-2">
            <i class="fa-solid fa-angle-left"></i> 
        </a>
        Manufacturer<span class="sub-nav ms-2" > > Edit</span>
    </h3>
    <p><a href="{{ route('manufacturer.index')}}"> <i class="fa-regular fa-eye"></i>View Manufacturers</a></p>
</div>

<form class="form-cm" action="{{ route('manufacturer.update', $manufacturer) }}" method="post">
    <div class="col-md-12">
        <h3 class="create-form-heading">Edit Manufacturer</h3>
    </div>
    @csrf
    @method('PUT')
    <div class="row mb-3">
        <div class="col-md-6">
            <label for="" class="form-label cm">Manufacture Name</label>
            <input type="text" class="form-control cm" placeholder="Enter Manufacture Name" name="name"
                value="{{ $manufacturer->name }}">
        </div>
        <div class="col-md-6">
            <label for="" class="form-label cm">Registration Number</label>
            <input type="text" class="form-control cm" placeholder="Enter Registration Number"
                name="registration_number" value="{{ $manufacturer->registration_number }}">
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-6">
            <label for="" class="form-label cm">Registration Authority</label>
            <select class="form-select kit-form-control mySelect" aria-label="Default select example"
                name="registration_authority">
                @if($selectedManufacturerauthority != null)
                @foreach ($manufacturerauthorities as $manufacturerauthority)
                <option value="{{ $manufacturerauthority->id }}" @if($manufacturerauthority->id == $selectedManufacturerauthority->id) selected @endif>
                    {{ $manufacturerauthority->name }}
                </option>
                @endforeach
                @else
                <option value=" " selected disabled>Select Registration Authority</option>
                @foreach ($manufacturerauthorities as $manufacturerauthority)
                <option value="{{ $manufacturerauthority->id }}">
                    {{ $manufacturerauthority->name }}
                </option>
                @endforeach
                @endif
                
            </select>
        </div>
        <div class="col-md-6">
            <label for="" class="form-label cm">Registartion Validity</label>
            <input type="date" class="form-control cm" placeholder="Enter Firm No." name="registration_validity" value="{{ $manufacturer->registration_validity }}">
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-12">
            <label for="" class="form-label cm"> Country</label>
            <select class="form-select kit-form-control mySelect" aria-label="Default select example" name="country_id">
            @if($selectedCountry != null)
            @foreach ($countries as $country)
            <option value="{{ $country->id }}" @if($country->id == $selectedCountry->id) selected @endif>
                {{ $country->name }}
            </option>
            @endforeach
            @else
            <option value=" " selected disabled>Select Country</option>
            @foreach ($countries as $country)
            <option value="{{ $country->id }}">
                {{ $country->name }}
            </option>
            @endforeach
            @endif
            </select>
        </div>

    </div>
    <button type="submit" class="btn btn-primary">Update</button>
</form>
@endsection