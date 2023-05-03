@extends('layouts.app')

@section('content')
    <form class="row g-3" action="{{ route('nutrient-category.update', $nutrientcategory) }}" method="post">
    @csrf
    @method('PUT')
    <div class="col-auto">
        <label for="staticEmail2">Nutrient Category Name</label>
        <input type="text"  class="form-control" id="staticEmail2" name="name" value="{{ $nutrientcategory->name }}">
    </div>
    <div class="col-auto">
        <button type="submit" class="btn btn-primary mb-3">Create</button>
    </div>
    </form>
@endsection