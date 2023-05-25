@extends('layouts.main')
@section('title', 'Create Capital')

@section('content')
<div class="add-heading">
    <h3 class="heading-cm">Capital</h3>
    <p><a href="{{ route('capital.index')}}"> <i class="fa-solid fa-plus"></i>View All</a></p>
</div>

<form action="{{ route('capital.store') }}" method="POST" class="form-cm">
@csrf
    <div class="row mb-3">
        <div class="col-md-6">
            <label for="" class="form-label cm">Capital Amount</label>
            <input type="text" class="form-control cm" placeholder="Enter dose name" name="name">
        </div>
        <div class="col-md-6">
            <label for="" class="form-label cm">Cost</label>
            <input type="text" class="form-control cm" placeholder="Enter dose name" name="amount">
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Create</button>
</form>
@endsection

