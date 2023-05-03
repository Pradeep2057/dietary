@extends('layouts.app')

@section('content')
    <form class="row g-3" action="{{ route('importer.update', $importer) }}" method="post">
    @csrf
    @method('PUT')
    <div class="col-auto">
        <label for="staticEmail2">Importer Name</label>
        <input type="text"  class="form-control" id="staticEmail2" name="name" value="{{ $importer->name }}">
    </div>
    <div class="col-auto">
        <label for="inputPassword2">Address</label>
        <input type="text" class="form-control" id="inputPassword2" name="address" value="{{ $importer->address }}">
    </div>
    <div class="col-auto">
        <label for="inputPassword2">PAN No</label>
        <input type="text" class="form-control" id="inputPassword2" name="pan" value="{{ $importer->pan }}">
    </div>
    <div class="col-auto">
        <label for="inputPassword2">Firm No</label>
        <input type="text" class="form-control" id="inputPassword2" name="firm_no" value="{{ $importer->firm_no }}">
    </div>
    <div class="col-auto">
        <label for="inputPassword2">Exim Code</label>
        <input type="text" class="form-control" id="inputPassword2" name="exim_code" value="{{ $importer->exim_code }}">
    </div>
    <div class="col-auto">
        <label for="inputPassword2">Contact Number</label>
        <input type="text" class="form-control" id="inputPassword2" name="contact_number" value="{{ $importer->contact_number }}">
    </div>
    <div class="col-auto">
        <label for="inputPassword2">Contact Person</label>
        <input type="text" class="form-control" id="inputPassword2" name="contact_person" value="{{ $importer->contact_person }}">
    </div>
    <div class="col-auto">
        <button type="submit" class="btn btn-primary mb-3">Update</button>
    </div>
    </form>
@endsection