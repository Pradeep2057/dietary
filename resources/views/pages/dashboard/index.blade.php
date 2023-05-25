@extends('layouts.main')
@section('title', 'Dashboard')
@section('reporttitle', 'View Report')

@section('content')
<div class="add-heading">
    <h3 class="heading-cm">Dashboard</h3>
</div>

@if(Auth::user()->role==0)
@if(session('fy'))
<div class="form-cm-notice">
    <div class="alert alert-info alert-dismissible fade show">
        {{ session('fy') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
</div>
@endif
@endif


<div class="table-row row mb-5 row-cols-1 row-cols-md-4">
    <div class="col g-0 ">
        <div class="kit-card-db h-100">
            <div class="card-body">
                <p class="date">
                    @php
                    use Carbon\Carbon;
                    $todaydate = Carbon::now();
                    $date = Carbon::parse($todaydate);
                    $formattedDate = $date->format('D j M, Y');
                    echo $formattedDate;
                    @endphp
                </p>
                <h5>Total Product</h5>
                <h1>
                    @php
                    use App\Models\Product;
                    $productcount = Product::all()->count();
                    echo $productcount;
                    @endphp
                </h1>
            </div>
        </div>
    </div>
    <div class="col ">
        <div class="kit-card-db h-100">
            <div class="card-body">
                <p class="date">
                    @php
                    echo $formattedDate;
                    @endphp
                </p>
                <h5>Total Importer</h5>
                <h1>
                    @php
                    use App\Models\Importer;
                    $importercount = Importer::all()->count();
                    echo $importercount;
                    @endphp
                </h1>
            </div>
        </div>
    </div>
    <div class="col g-0" style="padding-right:12px;">
        <div class="kit-card-db h-100">
            <div class="card-body">
                <p class="date">
                    @php
                    echo $formattedDate;
                    @endphp
                </p>
                <h5>Total Manufacturer</h5>
                <h1>
                    @php
                    use App\Models\Manufacturer;
                    $manufacturercount = Manufacturer::all()->count();
                    echo $manufacturercount;
                    @endphp
                </h1>
            </div>
        </div>
    </div>
    <div class="col g-0">
        <div class="kit-card-db h-100">
            <h5 class="db-npdate">
                <i class="fa-regular fa-calendar me-2"></i>
                @php
                use Pratiksh\Nepalidate\Facades\NepaliDate;
                $npdate = NepaliDate::create(\Carbon\Carbon::now())->toFormattedNepaliDate();
                echo $npdate;
                @endphp
            </h5>
            @foreach ($fiscalyears as $fiscalyear)
            <ul class="list-group mt-2" style="list-style-type: none;">
                <li class="list-group-item d-flex justify-content-between align-items-start">
                    <div class="ms-2 me-auto">
                        <div class="fw-bold">Fiscal Year</div>
                        {{ $fiscalyear->name }}
                    </div>
                    @if(Auth::user()->role==0)
                    <a href="{{ route('fiscalyear.edit', $fiscalyear->id)}}"><span
                            class="badge npdate-badge bg-primary">Edit</span></a>
                    @endif
                </li>
            </ul>
            @endforeach
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