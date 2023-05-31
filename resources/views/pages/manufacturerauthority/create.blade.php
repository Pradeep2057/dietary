@extends('layouts.main')
@section('title', 'Create Manufacturer Authority')

@section('content')
<div class="add-heading">
    <h3 class="heading-cm">Category</h3>
    <p><a href="{{ route('manufacturer-authority.index')}}"> <i class="fa-solid fa-plus"></i>View All</a></p>
</div>

<form action="{{ route('manufacturer-authority.store') }}" method="POST" class="form-cm">
@csrf
    <div class="row mb-3">
        <div class="col-md-6">
            <label for="" class="form-label cm">Manufacturer authority Name</label>
            <input type="text" class="form-control cm @error('name') is-invalid @enderror " placeholder="Enter manufacturer authority name" name="name">
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Create</button>
</form>
@endsection

