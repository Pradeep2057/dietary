@extends('layouts.main')
@section('title', 'Create Ingredient')

@section('content')
<div class="add-heading">
    <h3 class="heading-cm">Ingredient</h3>
    <p><a href="{{ route('ingredient.index')}}"> <i class="fa-solid fa-plus"></i>View All</a></p>
</div>

<form action="{{ route('ingredient.store') }}" method="POST" class="form-cm">
@csrf
    <div class="row mb-3">
        <div class="col-md-6">
            <label for="" class="form-label cm">Ingredient Name</label>
            <input type="text" class="form-control cm" placeholder="Enter ingredient name" name="name">
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Create</button>
</form>
@endsection

