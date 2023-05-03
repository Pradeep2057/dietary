@extends('layouts.app')

@section('content')
    <form class="row g-3" action="{{ route('type-of-product.update', $producttype) }}" method="post">
    @csrf
    @method('PUT')
    <div class="col-auto">
        <label for="staticEmail2">Product Type Name</label>
        <input type="text"  class="form-control" id="staticEmail2" name="name" value="{{ $producttype->name }}">
    </div>
    <div class="col-auto">
        <button type="submit" class="btn btn-primary mb-3">Update</button>
    </div>
    </form>
@endsection