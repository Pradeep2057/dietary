@extends('layouts.main')
@section('title', 'Lab')
@section('content')

<div class="add-heading">
    <h3 class="heading-cm">Lab</h3>
    <p><a href="{{ route('lab.create')}}"> <i class="fa-solid fa-plus"></i>Add Lab</a></p>
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

    @if(!empty($labs))
    <div class="row mb-4 filter-row filters">
        <div class="col-md-4">
            <select id="agency" class="form-select kit-form-control">
                <option value="" disabled selected>Select Recognized Agency</option>
                @foreach ($labs->unique('recognized_agency') as $lab)
                <option value="{{ $lab->recognized_agency }}">{{ $lab->recognized_agency }}</option>
                @endforeach
            </select>
        </div>
        <div class="col-md-2">
            <select id="country" class="form-select kit-form-control">
                <option value="" disabled selected>Select Country</option>
                @foreach ($labs->unique('country.name') as $lab)
                <option value="{{ $lab->country->name }}">{{ $lab->country->name }}</option>
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

    <table id="sampleTable" class="table table-striped" style="width:100%;">
        <thead>
            <tr>
                <th>S No.</th>
                <th>Lab Name</th>
                <th>Country</th>
                <th>Website</th>
                <th>Recognized Agency</th>
                <th>Created Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        @php
            $i = 1;
        @endphp
        @foreach ($labs as $lab)
            <tr>
                <td>{{ $i }}</td>
                <td>{{ $lab->name }} </td>
                <td>{{ $lab->country->name }} </td>
                <td>{{ $lab->website }} </td>
                <td>{{ $lab->recognized_agency }} </td>
                <td>{{ $lab->created_at->format('Y-m-d') }} </td>

                <td>
                    <div class="d-flex kit-action-com">
                        <!-- <div class="action-btn-view">
                            <a href="viewproductiontype.html">
                                View
                            </a>
                        </div> -->
                        
                        
                        <div class="action-btn-pen">
                        <a href="{{ route('lab.edit', $lab->id) }}" method="put"><span class="material-symbols-outlined">
                                edit
                                </span></a>
                        </div>
                        
                        

                        @if (auth()->user()->role == 0)
                        <form class="action-btn-dlt" action="{{ route('lab.delete', $lab->id) }}" method="post">
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
        <p>No labs!</p>
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
            var date = new Date(data[5]);
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
                        columns: [0, 1, 2, 3, 4, 5]
                    }
                },
                {
                    extend: 'csv',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5]
                    }
                },
                {
                    extend: 'excel',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5]
                    }
                },
                {
                    extend: 'pdf',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5]
                    }
                },
                {
                    extend: 'print',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5]
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


        $('#agency').on('change', function() {
            var type = $(this).val();
            table.columns(4).search(type).draw();
        });
        $('#country').on('change', function() {
            var type = $(this).val();
            table.columns(2).search(type).draw();
        });

        $('#reset').on('click', function() {
            $('#min').val('');
            $('#max').val('');
            $('#agency').val('');
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



