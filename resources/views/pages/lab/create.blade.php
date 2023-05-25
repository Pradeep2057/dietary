@extends('layouts.main')
@section('title', 'Create Lab')

@section('content')
<div class="add-heading">
    <h3 class="heading-cm">Lab</h3>
    <p><a href="{{ route('lab.index')}}"> <i class="fa-solid fa-plus"></i>View All</a></p>
</div>

<form action="{{ route('lab.store') }}" method="POST" class="form-cm">
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