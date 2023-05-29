@extends('layouts.main')
@section('title', 'Importer')
@section('content')

<div class="add-heading">
    <h3 class="heading-cm"> 
        <a href="{{ route('home')}}" class="nav-icon me-2">
            <i class="fa-solid fa-angle-left"></i> 
        </a>
        Importer
    </h3>
    <p><a href="{{ route('importer.create')}}"> <i class="fa-solid fa-plus"></i>Add Importer</a></p>
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

    @if(!empty($importers))

    <div class="row mb-4 filter-row filters">
        <div class="col-md-5">
            <input type="text" class="form-control cm" id="min" name="min" placeholder="From">
        </div>
        <div class="col-md-5">
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
                <th>Name of Importer</th>
                <th>Address</th>
                <th>PAN No.</th>
                <th>Firm No.</th>
                <th>Exim Code</th>
                <th>Contact Number</th>
                <th>Contact Person</th>
                <th>Created Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        @php
            $i = 1;
        @endphp
        @foreach ($importers as $importer)
            <tr>
                <td>{{ $i }}</td>
                <td>{{ $importer->name }}</td>
                <td>{{ $importer->address }}</td>
                <td>{{ $importer->pan }}</td>
                <td>{{ $importer->firm_no }}</td>
                <td>{{ $importer->exim_code }}</td>
                <td>{{ $importer->contact_number }}</td>
                <td>{{ $importer->contact_person }}</td>
                <td>{{ $importer->created_at->format('Y-m-d') }}</td>
                <td>
                <div class="d-flex kit-action-com">
                        <!-- <div class="action-btn-view">
                            <a href="viewproductiontype.html">
                                View
                            </a>
                        </div> -->
                        
                        <div class="action-btn-pen">
                        <a href="{{ route('importer.edit', $importer->id) }}" method="put"><span class="material-symbols-outlined">
                            edit
                            </span></a>
                        </div>
                        

                        @if (auth()->user()->role == 0)
                        <form class="action-btn-dlt" action="{{ route('importer.delete', $importer->id) }}" method="post">
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
        <p>No importers!</p>
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
            var date = new Date(data[8]);
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
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]
                    }
                },
                {
                    extend: 'csv',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]
                    }
                },
                {
                    extend: 'excel',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]
                    }
                },
                {
                    extend: 'pdf',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]
                    }
                },
                {
                    extend: 'print',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]
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