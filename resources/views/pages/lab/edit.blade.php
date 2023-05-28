@extends('layouts.main')
@section('title', 'Edit Lab')

@section('content')
<div class="add-heading">
    <h3 class="heading-cm">Lab</h3>
    <p><a href="{{ route('lab.index')}}"> <i class="fa-solid fa-plus"></i>View All</a></p>
</div>

<form class="form-cm"  action="{{ route('lab.update', $lab) }}" method="post">
    @csrf
    @method('PUT')
    <div class="row mb-3">
    <div class="col-md-6">
        <label for="" class="form-label cm">Lab Name</label>
        <input type="text" class="form-control cm" placeholder="Enter Lab Name" name="name" value="{{ $lab->name }}">
    </div>
    <div class="col-md-6">
        <label for="" class="form-label cm">Recognized Agency</label>
        <input type="text" class="form-control cm" placeholder="Enter Recognized Agency" name="recognized_agency" value="{{ $lab->recognized_agency }}">
    </div>

    </div>
    <div class="row mb-3">
        <div class="col-md-6">
            <label for="" class="form-label cm">Website</label>
            <input type="text" class="form-control cm" placeholder="Enter Lab Name" name="website" value="{{ $lab->website }}">
        </div>
        <div class="col-md-6">
            <label for="" class="form-label cm"> Country</label>
            <select class="form-select kit-form-control mySelect" aria-label="Default select example" name="country_id">
                <option value="1" selected disabled>Select</option>
                @foreach ($countries as $country)
                @if($selectedCountry != null)
                <option value="{{ $country->id }}" @if($country->id == $selectedCountry->id) selected @endif>
                        {{ $country->name }}
                </option>
                @else
                <option value="{{ $country->id }}">
                        {{ $country->name }}
                </option>
                @endif
                @endforeach
            </select>
        </div>

    </div>
    <button type="submit" class="btn btn-primary">Update</button>
</form>
@endsection

