@extends('layouts.main')
@section('title', 'Create Dose')

@section('content')
<div class="add-heading">
    <h3 class="heading-cm">Dose</h3>
    <p><a href="{{ route('dose.index')}}"> <i class="fa-solid fa-plus"></i>View All</a></p>
</div>

<form action="{{ route('dose.store') }}" method="POST" class="form-cm">
@csrf
    <div class="row mb-3">
        <div class="col-md-6">
            <label for="" class="form-label cm">Dose Name</label>
            <input type="text" class="form-control cm" placeholder="Enter dose name" name="name">
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Create</button>
</form>
@endsection

