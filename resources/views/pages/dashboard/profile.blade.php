@extends('layouts.main')
@section('title', 'Dashboard')
@section('reporttitle', 'View Report')

@section('content')
<div class="add-heading">
    <h3 class="heading-cm">Dashboard</h3>
</div>

<div class="form-cm">
    <div class="row userprofile-das">
        <div class="col-md-6 userprofile-das-left">
            <div class="me-3 userprofile-das-div"> <img
                    src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name) }}&rounded=true&background=FB802C&color=ffffff&size=28&bold=true"
                    alt=""></div>

            <div class="userprofile-text">
                <h3 class="username"> {{ Auth::user()->name }}</h3>
                <p class="username-sm"> Role : <span>@if(Auth::user()->role==0)
                    Verifier
                    @elseif(Auth::user()->role==1)
                    Reviewer
                    @elseif(Auth::user()->role==2)
                    Data Entry Operator
                    @else
                    Report Viewer
                    @endif</span> </p>
            </div>
        </div>
        <div class="col-md-6 userprofile-das-right">
            <a href="{{ route('user.changePassword') }}">Change Password</a>
        </div>
    </div>
    <div class="row userprofile-details">
        <div class="userdetails-heading">
            User Details
        </div>
        <div class="col-md-4">
            <h3>User Name</h3>
            <p>{{ Auth::user()->name }}</p>
        </div>
        <div class="col-md-4">
            <h3>User Role</h3>
            <p>@if(Auth::user()->role==0)
                    Verifier
                    @elseif(Auth::user()->role==1)
                    Reviewer
                    @elseif(Auth::user()->role==2)
                    Data Entry Operator
                    @else
                    Report Viewer
                    @endif</p>
        </div>
        <div class="col-md-4">
            <h3>User Email</h3>
            <p>{{ Auth::user()->email }}</p>
        </div>
    </div>
</div>
@endsection

@section('reportcontent')
<div class="row mb-3 w-50">
    @if(session('msg'))
    <div class="alert alert-danger alert-dismissible fade show">
        {{ session('msg') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
</div>

<form action="{{ route('reportview.display') }}" method="GET" class="search-form">
    @csrf
    <div class="row mb-3">
        <div class="col-md-12">
            <label for="" class="form-label cm">Registration Number</label>
            <input type="text" class="form-control cm" placeholder="Enter registration number" name="registration_num">
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-md-12">
            <label for="" class="form-label cm">Select Certificate Type</label>
            <select name="certificate_category" class="form-select kit-form-control"
                aria-label="Default select example">
                <option value="" selected disabled>Select certificate type</option>
                <option value="Product Registration">Product Registration</option>
                <option value="Product Renewal">Product Renewal</option>
            </select>
        </div>
    </div>
    <button type="search" class="btn btn-primary">View Certificate</button>
</form>
@endsection




@section('custom-js')
<script>
$(document).ready(function() {
    $('#sampleTable').DataTable();
});
</script>
@endsection