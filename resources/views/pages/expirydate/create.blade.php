@extends('layouts.main')
@section('title', 'Expiry Date')

@section('content')
<div class="add-heading">
    <h3 class="heading-cm">
        <a href="{{ route('expirydate.index')}}" class="nav-icon me-2">
            <i class="fa-solid fa-angle-left"></i> 
        </a>
        Expirydate<span class="sub-nav ms-2" > > Create</span>
    </h3>
    <p><a href="{{ route('expirydate.index')}}"> <i class="fa-regular fa-eye"></i>View Expirydate</a></p>
</div>

<form action="{{ route('expirydate.store') }}" method="POST" class="form-cm">
@csrf
    <div class="row mb-3">
        <div class="col-md-6">
            <label for="" class="form-label cm">Expiry Date</label>
            <input type="text" class="form-control cm" placeholder="Enter dose name" name="name">
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Create</button>
</form>
@endsection

