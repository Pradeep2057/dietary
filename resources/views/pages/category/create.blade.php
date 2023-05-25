@extends('layouts.main')
@section('title', 'Create Category')

@section('content')
<div class="add-heading">
    <h3 class="heading-cm">Category</h3>
    <p><a href="{{ route('category.index')}}"> <i class="fa-solid fa-plus"></i>View All</a></p>
</div>

<form action="{{ route('category.store') }}" method="POST" class="form-cm">
@csrf
    <div class="row mb-3">
        <div class="col-md-6">
            <label for="" class="form-label cm">Category Name</label>
            <input type="text" class="form-control cm" placeholder="Enter dose name" name="name">
        </div>
        <div class="col-md-6">
            <label for="" class="form-label cm">Remarks</label>
            <input type="text" class="form-control cm" placeholder="Enter dose name" name="remarks">
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Create</button>
</form>
@endsection

