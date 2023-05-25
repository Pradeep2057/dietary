@extends('layouts.main')
@section('title', 'Create Size Form')

@section('content')
<div class="add-heading">
    <h3 class="heading-cm">Certifying Agency</h3>
    <p><a href="{{ route('agency.index')}}"> <i class="fa-solid fa-plus"></i>View All</a></p>
</div>

<form action="{{ route('agency.store') }}" method="POST" class="form-cm">
@csrf
    <div class="row mb-3">
        <div class="col-md-6">
            <label for="" class="form-label cm">Agency Name</label>
            <input type="text" class="form-control cm" placeholder="Enter Size Name" name="name">
        </div>
        <div class="col-md-6">
            <label for="" class="form-label cm">Agency Address</label>
            <input type="text" class="form-control cm" placeholder="Enter Size Name" name="address">
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-12">
            <label for="" class="form-label cm">Agency Description</label>
            <textarea type="text" class="form-control cm" placeholder="Enter Size Name" name="description" style="height: 120px;"></textarea>
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Create</button>
</form>
@endsection

