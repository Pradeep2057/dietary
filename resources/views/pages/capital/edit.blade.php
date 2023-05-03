@extends('layouts.app')

@section('content')
    <form class="row g-3" action="{{ route('capital.update', $capital) }}" method="post">
    @csrf
    @method('PUT')
    <div class="col-auto">
        <label for="staticEmail2">Capital Amount</label>
        <input type="text"  class="form-control" id="staticEmail2" name="name" value="{{ $capital->name }}">
    </div>
    <div class="col-auto">
        <label for="inputPassword2">Amount</label>
        <input type="text" class="form-control" id="inputPassword2" name="amount" value="{{ $capital->amount }}">
    </div>
    <div class="col-auto">
        <button type="submit" class="btn btn-primary mb-3">Create</button>
    </div>
    </form>
@endsection