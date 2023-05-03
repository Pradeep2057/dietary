@extends('layouts.app')

@section('content')
    <form class="row g-3" action="{{ route('importer.store') }}" method="POST">
    @csrf
    <div class="col-auto">
        <label for="staticEmail2">Importer Name</label>
        <input type="text"  class="form-control" id="staticEmail2" name="name">
    </div>
    <div class="col-auto">
        <label for="inputPassword2">Address</label>
        <input type="text" class="form-control" id="inputPassword2" name="address">
    </div>
    <div class="col-auto">
        <label for="inputPassword2">PAN No</label>
        <input type="text" class="form-control" id="inputPassword2" name="pan">
    </div>
    <div class="col-auto">
        <label for="inputPassword2">Firm No</label>
        <input type="text" class="form-control" id="inputPassword2" name="firm_no">
    </div>
    <div class="col-auto">
        <label for="inputPassword2">Exim Code</label>
        <input type="text" class="form-control" id="inputPassword2" name="exim_code">
    </div>
    <div class="col-auto">
        <label for="inputPassword2">Contact Number</label>
        <input type="text" class="form-control" id="inputPassword2" name="contact_number">
    </div>
    <div class="col-auto">
        <label for="inputPassword2">Contact Person</label>
        <input type="text" class="form-control" id="inputPassword2" name="contact_person">
    </div>
    <div class="col-auto">
        <button type="submit" class="btn btn-primary mb-3">Create</button>
    </div>
    </form>
@endsection