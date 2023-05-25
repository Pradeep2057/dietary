@extends('layouts.main')
@section('title', 'Create Importer')

@section('content')
<div class="add-heading">
    <h3 class="heading-cm">Importer</h3>
    <p><a href="{{ route('importer.index')}}"> <i class="fa-solid fa-plus"></i>View All</a></p>
</div>

<form action="{{ route('importer.store') }}" method="POST" class="form-cm">
    @csrf
    <div class="row mb-3">
        <div class="col-md-6">
            <label for="" class="form-label cm">Name of Importer</label>
            <input type="text" class="form-control cm" placeholder="Enter Name of Importer" name="name">
        </div>
        <div class="col-md-6">
            <label for="" class="form-label cm">Address</label>
            <input type="text" class="form-control cm" placeholder="Enter Address" name="address">
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-6">
            <label for="" class="form-label cm">PAN No.</label>
            <input type="text" class="form-control cm" placeholder="Enter PAN No." name="pan">
        </div>
        <div class="col-md-6">
            <label for="" class="form-label cm">Firm No.</label>
            <input type="text" class="form-control cm" placeholder="Enter Firm No." name="firm_no">
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-6">
            <label for="" class="form-label cm">Exim Code.</label>
            <input type="text" class="form-control cm" placeholder="Enter Exim Code." name="exim_code">
        </div>
        <div class="col-md-6">
            <label for="" class="form-label cm">Contact Number</label>
            <input type="tel" class="form-control cm" placeholder="Enter Contact Number" name="contact_number">
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-12">
            <label for="" class="form-label cm">Contact Person</label>
            <input type="text" class="form-control cm" placeholder="Enter Contact Person " name="contact_person">
        </div>

    </div>
    <button type="submit" class="btn btn-primary">Create</button>
</form>
@endsection