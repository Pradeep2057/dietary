@extends('layouts.app')

@section('content')
    <form class="row g-3" action="{{ route('manufacturer.store') }}" method="POST">
    @csrf
    <div class="col-auto">
        <label for="staticEmail2">Manufacturer Name</label>
        <input type="text"  class="form-control" id="staticEmail2" name="name">
    </div>
    <div class="col-auto">
        <label for="inputPassword2">Registration Number</label>
        <input type="text" class="form-control" id="inputPassword2" name="registration_number">
    </div>
    <div class="col-auto">
        <label for="inputPassword2">Registration Authority</label>
        <!-- <input type="text" class="form-control" id="inputPassword2" name="registration_authority"> -->
        <select name="registration_authority" id="country">
        @foreach ($manufacturerauthorities as $manufacturerauthority)
            <option value="{{ $manufacturerauthority->id }}">{{ $manufacturerauthority->name }}</option>
        @endforeach
        </select>
    </div>
    <div class="col-auto">
        <label for="inputPassword2">Registration Validity</label>
        <input type="date" class="form-control" id="inputPassword2" name="registration_validity">
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