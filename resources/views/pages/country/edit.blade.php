@extends('layouts.app')

@section('content')
    <form class="row g-3" action="{{ route('country.update', $country) }}" method="post">
    @csrf
    @method('PUT')
    <div class="col-auto">
        <label for="staticEmail2">Country Name</label>
        <input type="text"  class="form-control" id="staticEmail2" name="name" value="{{ $country->name }}">
    </div>
    <div class="col-auto">
        <label for="staticEmail2">Country Population</label>
        <input type="text"  class="form-control" id="staticEmail2" name="population" value="{{ $country->population }}">
    </div>
    <div class="col-auto">
        <label for="inputPassword2">Area</label>
        <input type="text" class="form-control" id="inputPassword2" name="area" value="{{ $country->area }}">
    </div>
    <div class="col-auto">
        <button type="submit" class="btn btn-primary mb-3">Update</button>
    </div>
    </form>
@endsection