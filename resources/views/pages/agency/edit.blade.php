@extends('layouts.app')

@section('content')
    <form class="row g-3" action="{{ route('agency.update', $agency) }}" method="post">
    @csrf
    @method('PUT')
    <div class="col-auto">
        <label for="staticEmail2">Agency Name</label>
        <input type="text"  class="form-control" id="staticEmail2" name="name" value="{{ $agency->name }}">
    </div>
    <div class="col-auto">
        <label for="inputPassword2">Address</label>
        <input type="text" class="form-control" id="inputPassword2" name="address" value="{{ $agency->address }}">
    </div>
    <div class="col-auto">
        <label for="inputPassword2">Description</label>
        <input type="text" class="form-control" id="inputPassword2" name="description" value="{{ $agency->description }}">
    </div>
    <div class="col-auto">
        <button type="submit" class="btn btn-primary mb-3">Update</button>
    </div>
    </form>
@endsection