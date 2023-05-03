@extends('layouts.app')

@section('content')
    <form class="row g-3" action="{{ route('country.store') }}" method="POST">
    @csrf
    <div class="col-auto">
        <label for="staticEmail2">Country Name</label>
        <input type="text"  class="form-control" id="staticEmail2" name="name">
    </div>
    <div class="col-auto">
        <label for="staticEmail2">Country Population</label>
        <input type="text"  class="form-control" id="staticEmail2" name="population">
    </div>
    <div class="col-auto">
        <label for="inputPassword2">Area</label>
        <input type="text" class="form-control" id="inputPassword2" name="area">
    </div>
    <div class="col-auto">
        <button type="submit" class="btn btn-primary mb-3">Create</button>
    </div>
    </form>
@endsection