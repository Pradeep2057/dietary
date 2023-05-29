@extends('layouts.main')
@section('title', 'Create Lab')

@section('content')
<div class="add-heading">
    <h3 class="heading-cm">
        <a href="{{ route('lab.index')}}" class="nav-icon me-2">
            <i class="fa-solid fa-angle-left"></i> 
        </a>
        Lab<span class="sub-nav ms-2" > > Create</span>
    </h3>
    <p><a href="{{ route('lab.index')}}"> <i class="fa-regular fa-eye"></i>View Labs</a></p>
</div>

<form action="{{ route('lab.store') }}" method="POST" class="form-cm">
    <div class="col-md-12">
        <h3 class="create-form-heading">Create Lab</h3>
    </div>
    @csrf
    <div class="row mb-3">
    <div class="col-md-6">
        <label for="" class="form-label cm">Lab Name</label>
        <input type="text" class="form-control cm" placeholder="Enter Lab Name" name="name">
    </div>
    <div class="col-md-6">
        <label for="" class="form-label cm">Recognized Agency</label>
        <input type="text" class="form-control cm" placeholder="Enter Recognized Agency" name="recognized_agency">
    </div>

    </div>
    <div class="row mb-3">
        <div class="col-md-6">
            <label for="" class="form-label cm">Website</label>
            <input type="text" class="form-control cm" placeholder="Enter Lab Name" name="website">
        </div>
        <div class="col-md-6">
            <label for="" class="form-label cm"> Country</label>
            <select class="form-select kit-form-control mySelect" aria-label="Default select example" name="country_id">
                <option value="1" selected disabled>Select</option>
                @foreach ($countries as $country)
                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                @endforeach
            </select>
        </div>

    </div>
    <button type="submit" class="btn btn-primary">Create</button>
</form>
@endsection