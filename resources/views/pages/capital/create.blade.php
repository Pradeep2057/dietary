@extends('layouts.main')
@section('title', 'Create Capital')

@section('content')
<div class="add-heading">
    <h3 class="heading-cm">
        <a href="{{ route('capital.index')}}" class="nav-icon me-2">
            <i class="fa-solid fa-angle-left"></i> 
        </a>
        Manufacturer<span class="sub-nav ms-2" > > Capital > Create</span>
    </h3>
    <p><a href="{{ route('capital.index')}}"> <i class="fa-regular fa-eye"></i>View Capital</a></p>
</div>

<form action="{{ route('capital.store') }}" method="POST" class="form-cm">
@csrf
    <div class="row mb-3">
        <div class="col-md-6">
            <label for="" class="form-label cm">Capital Amount</label>
            <input type="text" class="form-control cm @error('name') is-invalid @enderror" placeholder="Enter dose name" name="name">
        </div>
        <div class="col-md-6">
            <label for="" class="form-label cm">Cost</label>
            <input type="text" class="form-control cm @error('amount') is-invalid @enderror" placeholder="Enter dose name" name="amount">
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Create</button>
</form>
@endsection

