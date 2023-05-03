@extends('layouts.app')

@section('content')
    <form class="row g-3" action="{{ route('nutrient.store') }}" method="POST">
    @csrf
    <div class="col-auto">
        <label for="staticEmail2">Name</label>
        <input type="text"  class="form-control" id="staticEmail2" name="name">
    </div>
    <div class="col-auto">
        <label for="inputPassword2">Common Name</label>
        <input type="text" class="form-control" id="inputPassword2" name="common_name">
    </div>
    <div class="col-auto">
        <label for="inputPassword2">Unit of expression</label>
        <input type="text" class="form-control" id="inputPassword2" name="unit_of_expression">
    </div>
    <div class="col-auto">
        <label for="inputPassword2">RDA</label>
        <input type="text" class="form-control" id="inputPassword2" name="rda">
    </div>
    <div class="col-auto">
        <label for="inputPassword2">Minimum</label>
        <input type="text" class="form-control" id="inputPassword2" name="minimum">
    </div>
    <div class="col-auto">
        <label for="inputPassword2">Permissable Unit</label>
        <input type="text" class="form-control" id="inputPassword2" name="permissable_unit">
    </div>
    <div class="col-auto">
        <label for="inputPassword2">Permissable Overage</label>
        <input type="text" class="form-control" id="inputPassword2" name="permissable_overage">
    </div>
    <div class="col-auto">
        <label for="inputPassword2">Caution</label>
        <input type="text" class="form-control" id="inputPassword2" name="caution">
    </div>
    <div class="col-auto">
        <label for="inputPassword2">Usable Part</label>
        <input type="text" class="form-control" id="inputPassword2" name="usable_part">
    </div>
    <div class="col-auto">
        <label for="inputPassword2">Nutrient Category</label>
        <select name="nutrient_category">
        @foreach ($nutrientcategories as $nutrientcategory)
            <option value="{{ $nutrientcategory->id }}">{{ $nutrientcategory->name }}</option>
        @endforeach
        </select>
    </div>
    <div class="col-auto">
        <button type="submit" class="btn btn-primary mb-3">Create</button>
    </div>
    </form>
@endsection