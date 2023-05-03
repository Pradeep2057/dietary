@extends('layouts.app')

@section('content')
    <form class="row g-3" action="{{ route('lab.store') }}" method="POST">
    @csrf
    <div class="col-auto">
        <label for="staticEmail2">Lab Name</label>
        <input type="text"  class="form-control" id="staticEmail2" name="name">
    </div>
    <div class="col-auto">
        <label for="inputPassword2">Recognized Agency</label>
        <input type="text" class="form-control" id="inputPassword2" name="recognized_agency">
    </div>
    <div class="col-auto">
        <label for="inputPassword2">Website</label>
        <input type="text" class="form-control" id="inputPassword2" name="website">
    </div>
    <div class="col-auto">
        <label for="inputPassword2">Country</label>
        <select name="country_id" id="country">
        @foreach ($countries as $country)
            <option value="{{ $country->id }}">{{ $country->name }}</option>
        @endforeach
        </select>
    </div>
    <div class="col-auto">
        <button type="submit" class="btn btn-primary mb-3">Create</button>
    </div>
    </form>
@endsection