@extends('layouts.app')

@section('content')
    <form class="row g-3" action="{{ route('dose.store') }}" method="POST">
    @csrf
    <div class="col-auto">
        <label for="staticEmail2">Dose Name</label>
        <input type="text"  class="form-control" id="staticEmail2" name="name">
    </div>
    <div class="col-auto">
        <button type="submit" class="btn btn-primary mb-3">Create</button>
    </div>
    </form>
@endsection