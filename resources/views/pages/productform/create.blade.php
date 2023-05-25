@extends('layouts.main')
@section('title', 'Create Product Form')

@section('content')
<div class="add-heading">
    <h3 class="heading-cm">Create Product Form</h3>
    <p><a href="{{ route('form-of-product.index')}}"> <i class="fa-solid fa-plus"></i>View All</a></p>
</div>

<form action="{{ route('form-of-product.store') }}" method="POST" class="form-cm">
@csrf
    <div class="row mb-3">
        <div class="col-md-6">
            <label for="" class="form-label cm">Product Form Name</label>
            <input type="text" class="form-control cm" placeholder="Enter Product Type Name" name="name">
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Create</button>
</form>
@endsection

