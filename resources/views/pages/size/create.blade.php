@extends('layouts.main')
@section('title', 'Create Size Form')

@section('content')
<div class="add-heading">
    <h3 class="heading-cm">Size</h3>
    <p><a href="{{ route('size.index')}}"> <i class="fa-solid fa-plus"></i>View All</a></p>
</div>

<form action="{{ route('size.store') }}" method="POST" class="form-cm">
@csrf
    <div class="row mb-3">
        <div class="col-md-6">
            <label for="" class="form-label cm">Size Name</label>
            <input type="text" class="form-control cm" placeholder="Enter Size Name" name="name">
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Create</button>
</form>
@endsection

