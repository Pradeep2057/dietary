@extends('layouts.main')
@section('title', 'Create Nutrient Category')

@section('content')
<div class="add-heading">
    <h3 class="heading-cm">Nutrient Category</h3>
    <p><a href="{{ route('nutrient-category.index')}}"> <i class="fa-solid fa-plus"></i>View All</a></p>
</div>

<form action="{{ route('nutrient-category.store') }}" method="POST" class="form-cm">
@csrf
    <div class="row mb-3">
        <div class="col-md-6">
            <label for="" class="form-label cm">Nutrient Category Name</label>
            <input type="text" class="form-control cm" placeholder="Enter nutrient category name" name="name">
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Create</button>
</form>
@endsection

