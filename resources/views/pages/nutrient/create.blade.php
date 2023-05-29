@extends('layouts.main')
@section('title', 'Create Nutrient')

@section('content')
<div class="add-heading">
    <h3 class="heading-cm"> 
        <a href="{{ route('nutrient.index')}}" class="nav-icon me-2">
            <i class="fa-solid fa-angle-left"></i> 
        </a>
        Product Details<span class="sub-nav ms-2" > > Nutrient > Create</span>
    </h3>
    <p><a href="{{ route('nutrient.index')}}"> <i class="fa-regular fa-eye"></i>View Products Detail</a></p>
</div>

<form action="{{ route('nutrient.store') }}" method="POST" class="form-cm">
    <div class="col-md-12">
        <h3 class="create-form-heading">Create Product Details</h3>
    </div>
    @csrf
    <div class="row mb-3">
        <div class="col-md-6">
            <label for="" class="form-label cm"> Name</label>
            <input type="text" class="form-control cm" placeholder="Enter  Name" name="name">
        </div>
        <div class="col-md-6">
            <label for="" class="form-label cm">Common Name</label>
            <input type="text" class="form-control cm" placeholder="Enter Common Name" name="common_name">
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-6">
            <label for="" class="form-label cm"> Unit of expression</label>
            <input type="text" class="form-control cm" placeholder="Enter Unit ofexpression" name="unit_of_expression">
        </div>
        <div class="col-md-6">
            <label for="" class="form-label cm">RDA</label>
            <input type="text" class="form-control cm" placeholder="Enter RDA" name="rda">
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-6">
            <label for="" class="form-label cm">Minimum</label>
            <input type="text" class="form-control cm" placeholder="Enter Minimum" name="minimum">
        </div>
        <div class="col-md-6">
            <label for="" class="form-label cm">Permissiable Unit</label>
            <input type="text" class="form-control cm" placeholder="Enter Permissiable Unit" name="permissable_unit">
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-6">
            <label for="" class="form-label cm">Permissiable Overage</label>
            <input type="text" class="form-control cm" placeholder="Enter Permissiable Overage" name="permissable_overage">
        </div>
        <div class="col-md-6">
            <label for="" class="form-label cm">Caution </label>
            <input type="text" class="form-control cm" placeholder="Enter Caution" name="caution">
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-6">
            <label for="" class="form-label cm">Usable Part</label>
            <input type="text" class="form-control cm" placeholder="Enter Usable Part" name="usable_part">
        </div>
        <div class="col-md-6">
            <label for="" class="form-label cm">Nutrient Category </label>
            <select name="nutrient_category" class="form-select kit-form-control mySelect" aria-label="Default select example">
            <option value=" " selected disabled>Select Nutrient Category</option>   
            @foreach ($nutrientcategories as $nutrientcategory)
                <option value="{{ $nutrientcategory->id }}">{{ $nutrientcategory->name }}</option>
            @endforeach
            </select>
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Create</button>
</form>
@endsection