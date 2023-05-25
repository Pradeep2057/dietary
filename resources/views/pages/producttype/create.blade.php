@extends('layouts.main')
@section('title', 'Create Product Type')

@section('content')
<div class="add-heading">
    <h3 class="heading-cm">Create Product Type</h3>
    <p><a href="{{ route('type-of-product.index')}}"> <i class="fa-solid fa-plus"></i>View All</a></p>
</div>

<form action="{{ route('type-of-product.store') }}" method="POST" class="form-cm">
@csrf
    <div class="row mb-3">
        <div class="col-md-6">
            <label for="" class="form-label cm">Product Type Name</label>
            <input type="text" class="form-control cm" placeholder="Enter Product Type Name" name="name">
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Create</button>
</form>
@endsection

