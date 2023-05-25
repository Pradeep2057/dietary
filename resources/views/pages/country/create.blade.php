@extends('layouts.main')
@section('title', 'Create Country')

@section('content')
<div class="add-heading">
    <h3 class="heading-cm">Country</h3>
    <p><a href="{{ route('country.index')}}"> <i class="fa-solid fa-plus"></i>View All</a></p>
</div>

<form action="{{ route('country.store') }}" method="POST" class="form-cm">
@csrf
    <div class="row mb-3">
        <div class="col-md-4">
            <label for="" class="form-label cm">Country Name</label>
            <input type="text" class="form-control cm" placeholder="Enter dose name" name="name">
        </div>
        <div class="col-md-4">
            <label for="" class="form-label cm">Country Population</label>
            <input type="text" class="form-control cm" placeholder="Enter dose name" name="population">
        </div>
        <div class="col-md-4">
            <label for="" class="form-label cm">Country Area</label>
            <input type="text" class="form-control cm" placeholder="Enter dose name" name="area">
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Create</button>
</form>
@endsection

