@extends('layouts.main')
@section('title', 'Manufacture')
@section('content')

<div class="add-heading">
    <h3 class="heading-cm"> 
        <a href="{{ route('home')}}" class="nav-icon me-2">
            <i class="fa-solid fa-angle-left"></i> 
        </a>
        Manufacturer<span class="sub-nav ms-2" > > All</span>
    </h3>
    <p><a href="{{ route('manufacturer.create')}}"> <i class="fa-solid fa-plus"></i> Add Manufacturer</a></p>
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

    @if(!empty($manufacturers))

    <div class="row mb-4 filter-row filters">
        <div class="col-md-4">
            <select id="authority" class="form-select kit-form-control">
                <option value="" disabled selected>Select Registration Authority</option>
                @foreach ($manufacturers->unique('manufacturerauthority.name') as $manufacturer)
                <option value="{{ $manufacturer->manufacturerauthority->name }}">{{ $manufacturer->manufacturerauthority->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2">
            <select id="country" class="form-select kit-form-control">
                <option value="" disabled selected>Select Country</option>
                @foreach ($manufacturers->unique('country.name') as $manufacturer)
                <option value="{{ $manufacturer->country->name }}">{{ $manufacturer->country->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2">
            <input type="text" class="form-control cm" id="min" name="min" placeholder="From">
        </div>
        <div class="col-md-2">
            <input type="text" class="form-control cm" id="max" name="max" placeholder="To">
        </div>
        <div class="col-md-2">
            <button id="reset">Reset</button>
        </div>
    </div>

    <table id="sampleTable" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>S No.</th>
                <th>Manufacturer Name</th>
                <th>Registration Number</th>
                <th>Registartion Validity</th>
                <th>Registration Authority</th>
                <th>Country</th>
                <th>Created Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        @php
            $i = 1;
        @endphp
        @foreach ($manufacturers as $manufacturer)
            <tr>
                <td>{{ $i }}</td>
                <td>{{ $manufacturer->name }} </td>
                <td>{{ $manufacturer->registration_number }} </td>
                <td>{{ $manufacturer->registration_validity }} </td>
                <td>{{ $manufacturer->manufacturerauthority->name }} </td>
                <td>{{ $manufacturer->country->name }} </td>
                <td>{{ $manufacturer->created_at->format('Y-m-d') }} </td>

                <td>
                    <div class="d-flex kit-action-com">
                        <!-- <div class="action-btn-view">
                            <a href="viewproductiontype.html">
                                View
                            </a>
                        </div> -->
                        
                        <div class="action-btn-pen">
                        <a href="{{ route('manufacturer.edit', $manufacturer->id) }}" method="put"><span class="material-symbols-outlined">
                                edit
                                </span></a>
                        </div>
                        

                        @if (auth()->user()->role == 0)
                        <form class="action-btn-dlt" action="{{ route('manufacturer.delete', $manufacturer->id) }}" method="post">
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
        <p>No manufacturer!</p>
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


        $('#authority').on('change', function() {
            var type = $(this).val();
            table.columns(4).search(type).draw();
        });
        $('#country').on('change', function() {
            var type = $(this).val();
            table.columns(5).search(type).draw();
        });

        $('#reset').on('click', function() {
            $('#min').val('');
            $('#max').val('');
            $('#authority').val('');
            $('#country').val('');

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





