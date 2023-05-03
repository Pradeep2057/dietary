@extends('layouts.app')

@section('content')
    <form class="row g-3" action="{{ route('size.update', $size) }}" method="post">
    @csrf
    @method('PUT')
    <div class="col-auto">
        <label for="staticEmail2">Size</label>
        <input type="text"  class="form-control" id="staticEmail2" name="name" value="{{ $size->name }}">
    </div>
    <div class="col-auto">
        <button type="submit" class="btn btn-primary mb-3">Create</button>
    </div>
    </form>
@endsection