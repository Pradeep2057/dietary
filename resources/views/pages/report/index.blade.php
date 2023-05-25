@extends('layouts.main')
@section('title', 'Production Report')
@section('content')

<div class="add-heading">
    <h3 class="heading-cm"> 
        <a href="{{ route('home')}}" class="nav-icon me-2">
            <i class="fa-solid fa-angle-left"></i> 
        </a>
        Certificate<span class="sub-nav ms-2" > > Tippani Registration</span>
    </h3>
    <p><a href="{{ route('report.create')}}"> <i class="fa-solid fa-plus"></i> Create Certificate</a></p>
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
        <div class="col-md-3">
            <select id="status" class="form-select kit-form-control">
                <option value="" disabled selected>Select Status</option>
                <option value="Processing">Processing</option>
                <option value="Pending">Pending</option>
                <option value="Verified">Verified</option>
            </select>
        </div>
        
        <div class="col-md-3">
            <input type="text" class="form-control cm" id="min" name="min" placeholder="From">
        </div>
        <div class="col-md-3">
            <input type="text" class="form-control cm" id="max" name="max" placeholder="To">
        </div>
        <div class="col-md-3">
            <button id="reset">Reset</button>
        </div>
    </div>

    <table id="sampleTable" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>S No.</th>
                <th>Product Registration No.</th>
                <th>Product Name</th>
                <th>Validity From</th>
                <th>Validity To</th>
                <th>Status</th>
                <th>Created Date</th>
                <th>Action</th>
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
                <td>{{ $report->validity_from }}</td>
                <td>{{ $report->validity_to }}</td>
                <td><div class="@if($report->status == 'Pending') pending @elseif($report->status == 'Processing') processing @else verified @endif">{{ $report->status}}</div></td>
                <td>{{ $report->created_at->format('Y-m-d') }}</td>

                <td>
                    <div class="d-flex kit-action-com">
                        @if((auth()->user()->role == 0 || auth()->user()->role == 1) && $report->status == 'Verified' )
                        <div class="action-btn-view">
                            <a href="{{ route('report.pdf', $report->id) }}" method="get">Tippani</a>
                        </div>

                        <div class="action-btn-view">
                            <a href="{{ route('report.certificate', $report->id) }}" method="get">Certificate</a>
                        </div>

                        <div class="action-btn-view">
                            <a href="{{ route('report.print', $report->id) }}" method="get">Print Certificate</a>
                        </div>
                        @endif

                        @if(auth()->user()->role == 2)
                        <div class="action-btn-view">
                            <a href="{{ route('report.pdf', $report->id) }}" method="get">View</a>
                        </div>
                        @endif

                        @if (auth()->user()->role == 2 && $report->status == 'Processing' )
                        <div class="action-btn-pen">
                        <a href="{{ route('report.edit', $report->id) }}" method="put"><span class="material-symbols-outlined">
                                edit
                                </span></a>
                        </div>
                        @endif
                        
                        @if(auth()->user()->role == 1 || auth()->user()->role == 0 )
                        <div class="action-btn-pen">
                        <a href="{{ route('report.edit', $report->id) }}" method="put"><span class="material-symbols-outlined">
                                edit
                                </span></a>
                        </div>
                        @endif


                        @if (auth()->user()->role == 0 || auth()->user()->role == 1)
                        <form class="action-btn-dlt" action="{{ route('report.delete', $report->id) }}" method="post">
                            @csrf
                            @method('delete')
                            <button type="submit">
                                <i class="fa-regular fa-trash-can"></i>
                            </button>
                        </form>
                        @endif
                    </div>
                </td>
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
            var date = new Date(data[6]);
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
                        columns: [0, 1, 2, 3, 4, 5, 6]
                    }
                },
                {
                    extend: 'csv',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6]
                    }
                },
                {
                    extend: 'excel',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6]
                    }
                },
                {
                    extend: 'pdf',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6]
                    }
                },
                {
                    extend: 'print',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6]
                    }
                }
            ],
            columnDefs: [
            {
                targets: -1,
                visible: true,
            }
        ]
        });

        $('#status').on('change', function() {
            var type = $(this).val();
            table.columns(5).search(type).draw();
        });


        $('#reset').on('click', function() {
            $('#min').val('');
            $('#max').val('');

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

