@extends('layouts.app')

@section('content')
    <form class="row g-3" action="{{ route('category.update', $category) }}" method="post">
    @csrf
    @method('PUT')
    <div class="col-auto">
        <label for="staticEmail2">Category Name</label>
        <input type="text"  class="form-control" id="staticEmail2" name="name" value="{{ $category->name }}">
    </div>
    <div class="col-auto">
        <label for="inputPassword2">Remarks</label>
        <input type="text" class="form-control" id="inputPassword2" name="remarks" value="{{ $category->remarks }}">
    </div>
    <div class="col-auto">
        <button type="submit" class="btn btn-primary mb-3">Create</button>
    </div>
    </form>
@endsection