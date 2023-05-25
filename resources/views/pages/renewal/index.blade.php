@extends('layouts.main')
@section('title', 'Product Registration Renewal Certificate')
@section('content')

<div class="add-heading">
    <h3 class="heading-cm"> 
        <a href="{{ route('home')}}" class="nav-icon me-2">
            <i class="fa-solid fa-angle-left"></i>
        </a>
        Certificate<span class="sub-nav ms-2" > > Product Renewal</span>
    </h3>
    <p><a href="{{ route('renewal.create')}}"> <i class="fa-solid fa-plus"></i> Create Certificate</a></p>
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

    @if(!empty($renewals))

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
                <th>Valid From</th>
                <th>Valid To</th>
                <th>Status</th>
                <th>Created Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        @php
            $i = 1;
        @endphp
        @foreach ($renewals as $renewal)
            <tr>
                <td>{{ $i }}</td>
                <td>{{ $renewal->product->registration }}</td>
                <td>{{ $renewal->product->name }}</td>
                <td>{{ $renewal->valid_from }}</td>
                <td>{{ $renewal->valid_to }}</td>
                <td><div class="@if($renewal->status == 'Pending') pending @elseif($renewal->status == 'Processing') processing @else verified @endif">{{ $renewal->status }}</div></td>
                <td>{{ $renewal->created_at->format('Y-m-d') }}</td>

                <td>
                    <div class="d-flex kit-action-com">
                        @if((auth()->user()->role == 0 || auth()->user()->role == 1) && $renewal->status == 'Verified' )
                        <div class="action-btn-view">
                            <a href="{{ route('renewal.pdf', $renewal->id) }}" method="get">Generate PDF</a>
                        </div>
                        @endif
                        
                        @if(auth()->user()->role == 2)
                        <div class="action-btn-pen">
                        <a href="" method="put"><button>View</button></a>
                        </div>
                        @endif

                        @if (auth()->user()->role == 2 && $renewal->status == 'Processing' )
                        <div class="action-btn-pen">
                        <a href="{{ route('renewal.edit', $renewal->id) }}" method="put"><span class="material-symbols-outlined">
                                edit
                                </span></a>
                        </div>
                        @endif

                        @if(auth()->user()->role == 1 || auth()->user()->role == 0 )
                        <div class="action-btn-pen">
                        <a href="{{ route('renewal.edit', $renewal->id) }}" method="put"><span class="material-symbols-outlined">
                                edit
                                </span></a>
                        </div>
                        @endif

                        @if (auth()->user()->role == 0 || auth()->user()->role == 1)
                        <form class="action-btn-dlt" action="{{ route('renewal.delete', $renewal->id) }}" method="post">
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
        <p>No renewal!</p>
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
            table.columns(6).search(type).draw();
        });


        $('#reset').on('click', function() {
            $('#min').val('');
            $('#max').val('');
            $('#status').val('');

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

