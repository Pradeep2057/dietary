@extends('layouts.main')
@section('title', 'Edit Nutrient')

@section('content')
<div class="add-heading">
    <h3 class="heading-cm"> 
        <a href="{{ route('nutrient.index')}}" class="nav-icon me-2">
            <i class="fa-solid fa-angle-left"></i> 
        </a>
        Product Details<span class="sub-nav ms-2" > > Nutrient > Edit</span>
    </h3>
    <p><a href="{{ route('nutrient.index')}}">View All</a></p>
</div>

<form action="{{ route('nutrient.update', $nutrients) }}" method="post" class="form-cm">
    @csrf
    @method('put')
    <div class="row mb-3">
        <div class="col-md-6">
            <label for="" class="form-label cm"> Name</label>
            <input type="text" class="form-control cm" placeholder="Enter  Name" name="name" value="{{ $nutrients->name }}">
        </div>
        <div class="col-md-6">
            <label for="" class="form-label cm">Common Name</label>
            <input type="text" class="form-control cm" placeholder="Enter Common Name" name="common_name" value="{{ $nutrients->common_name }}">
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-6">
            <label for="" class="form-label cm"> Unit of expression</label>
            <input type="text" class="form-control cm" placeholder="Enter Unit ofexpression" name="unit_of_expression" value="{{ $nutrients->unit_of_expression }}">
        </div>
        <div class="col-md-6">
            <label for="" class="form-label cm">RDA</label>
            <input type="text" class="form-control cm" placeholder="Enter RDA" name="rda" value="{{ $nutrients->rda }}">
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-6">
            <label for="" class="form-label cm">Minimum</label>
            <input type="text" class="form-control cm" placeholder="Enter Minimum" name="minimum" value="{{ $nutrients->minimum }}">
        </div>
        <div class="col-md-6">
            <label for="" class="form-label cm">Permissiable Unit</label>
            <input type="text" class="form-control cm" placeholder="Enter Permissiable Unit" name="permissable_unit" value="{{ $nutrients->permissable_unit }}">
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-6">
            <label for="" class="form-label cm">Permissiable Overage</label>
            <input type="text" class="form-control cm" placeholder="Enter Permissiable Overage" name="permissable_overage" value="{{ $nutrients->permissable_overage }}">
        </div>
        <div class="col-md-6">
            <label for="" class="form-label cm">Caution </label>
            <input type="text" class="form-control cm" placeholder="Enter Caution" name="caution" value="{{ $nutrients->caution }}">
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-6">
            <label for="" class="form-label cm">Usable Part</label>
            <input type="text" class="form-control cm" placeholder="Enter Usable Part" name="usable_part" value="{{ $nutrients->usable_part }}">
        </div>
        <div class="col-md-6">
            <label for="" class="form-label cm">Nutrient Category </label>
            <select name="nutrient_category" class="form-select kit-form-control mySelect" aria-label="Default select example">
            <option value=" " selected disabled>Select Nutrient Category</option>   
            @foreach ($nutrientcategories as $nutrientcategory)
                <option value="{{ $nutrientcategory->id }}" @if($nutrientcategory->id == $selectedNutrientcategory->id) selected @endif>{{ $nutrientcategory->name }}</option>
            @endforeach
            </select>
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Update</button>
</form>
@endsection