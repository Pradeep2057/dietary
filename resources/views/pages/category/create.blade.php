@extends('layouts.app')

@section('content')
    <form class="row g-3" action="{{ route('category.store') }}" method="POST">
    @csrf
    <div class="col-auto">
        <label for="staticEmail2">Category Name</label>
        <input type="text"  class="form-control" id="staticEmail2" name="name">
    </div>
    <div class="col-auto">
        <label for="inputPassword2">Remarks</label>
        <input type="text" class="form-control" id="inputPassword2" name="remarks">
    </div>
    <div class="col-auto">
        <button type="submit" class="btn btn-primary mb-3">Create</button>
    </div>
    </form>
@endsection