@extends('layouts.main')
@section('title', 'Production Report')
@section('content')

<div class="add-heading">
    <h3 class="heading-cm"> 
        <a href="{{ route('home')}}" class="nav-icon me-2">
            <i class="fa-solid fa-angle-left"></i> 
        </a>
        Product Certificates
    </h3>
</div>

<div class="table-row">
    @if(session('successct'))
    <div class="alert alert-success alert-dismissible fade show">
        {{ session('successct') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    @if(session('successup'))
    <div class="alert alert-info alert-dismissible fade show">
        {{ session('successup') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    @if(session('successdt'))
    <div class="alert alert-danger alert-dismissible fade show">
        {{ session('successdt') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    @if(!empty($reports))

    <div class="row mb-4 filter-row filters">
        <div class="col-md-4">
            <select id="certificate" class="form-select kit-form-control">
                <option value="" disabled selected>Select Certificate Type</option>
                <option value="Product Registration">Product Registration</option>
                <option value="Product Renewal">Product Renewal</option>
            </select>
        </div>
        <div class="col-md-3">
            <input type="text" class="form-control cm" id="min" name="min" placeholder="From">
        </div>
        <div class="col-md-3">
            <input type="text" class="form-control cm" id="max" name="max" placeholder="To">
        </div>
        <div class="col-md-2">
            <button id="reset">Reset</button>
        </div>
    </div>

    <table id="sampleTable" class="table hover-table" style="width:100%">
        <thead>
            <tr>
                <th>S No.</th>
                <th>Product Registration No.</th>
                <th>Product Name</th>
                <th>Certificate Category</th>
                <th>Created Date</th>
            </tr>
        </thead>
        <tbody>
            @php
            $i = 1;
            @endphp
            @foreach ($reports as $report)
            <tr>
                <td>{{ $i }}</td>
                <td>{{ $report->product->registration }}</td>
                <td>{{ $report->product->name }}</td>
                <td>{{ $report->certificate_category }}</td>
                <td>{{ $report->created_at->format('Y-m-d') }}</td>
            </tr>
            @php
            $i++;
            @endphp
            @endforeach
            @else
            <p>No report!</p>
            @endif
            @endsection
        </tbody>
    </table>
</div>

@section('custom-js')
<script>
var minDate, maxDate;

$.fn.dataTable.ext.search.push(
    function(settings, data, dataIndex) {
        var min = minDate.val();
        var max = maxDate.val();
        var date = new Date(data[4]);
        if (
            (min === null && max === null) ||
            (min === null && date <= max) ||
            (min <= date && max === null) ||
            (min <= date && date <= max)
        ) {
            return true;
        }
        return false;
    }
);

$(document).ready(function() {
    minDate = new DateTime($('#min'), {
        format: 'YYYY-MM-DD'
    });

    maxDate = new DateTime($('#max'), {
        format: 'YYYY-MM-DD'
    });

    var table = $('#sampleTable').DataTable({
        dom: 'Bfrtip',
        buttons: [{
                extend: 'copy',
                // text: '<span class="material-symbols-outlined">content_copy</span> Copy',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4]
                }
            },
            {
                extend: 'csv',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4]
                }
            },
            {
                extend: 'excel',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4]
                }
            },
            {
                extend: 'pdf',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4]
                }
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: [0, 1, 2, 3, 4]
                }
            }
        ],
        columnDefs: [{
            targets: -1,
            visible: true,
        }]
    });

    $('#certificate').on('change', function() {
        var type = $(this).val();
        table.columns(3).search(type).draw();
    });

    $('#reset').on('click', function() {
        $('#min').val('');
        $('#max').val('');
        $('#certificate').val('');

        table.columns().search('').draw();
        minDate.val('');
        maxDate.val('');
        table.draw();
    });

    $('#min, #max').on('change', function() {
        table.draw();
    });

});
</script>
@endsection