@extends('layouts.main')
@section('title', 'Product Type')
@section('content')

<div class="add-heading">
    <h3 class="heading-cm"> 
        <a href="{{ route('home')}}" class="nav-icon me-2">
            <i class="fa-solid fa-angle-left"></i> 
        </a>
        Product Details<span class="sub-nav ms-2" > > Nutrient</span>
    </h3>
    <p><a href="{{ route('nutrient.create')}}"> <i class="fa-solid fa-plus"></i> Add Nutrient</a></p>
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

    @if(!empty($nutrients))

    <div class="row mb-4 filter-row filters">
        <div class="col-md-4">
            <select id="nutrientcategory" class="form-select kit-form-control">
                <option value="" disabled selected>Select Nutrient Category </option>
                @foreach ($nutrients->unique('nutrientcategory.name') as $nutrient)
                @if($nutrient->nutrientcategory != null)
                    <option value="{{ $nutrient->nutrientcategory->name }}">{{ $nutrient->nutrientcategory->name }}</option>
                @endif
                @endforeach
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
                <th>Name</th>
                <th>Common Name</th>
                <th>Unit of expression</th>
                <th>RDA</th>
                <th>Minimum</th>
                <th>Permissiable Unit</th>
                <th>Permissiable Overage</th>
                <th>Caution</th>
                <th>Usable Part</th>
                <th>Nutrient Category</th>
                <th>Created Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @php
            $i = 1;
            @endphp
            @foreach ($nutrients as $nutrient)
            <tr>
                <td>{{ $i }}</td>
                <td>{{ $nutrient->name }} </td>
                <td>{{ $nutrient->common_name }} </td>

                @if(!empty($nutrient->unit_of_expression))
                <td>{{ $nutrient->unit_of_expression }} </td>
                @else
                <td>N/A</td>
                @endif
                
                <td>{{ $nutrient->rda }} </td>
                <td>{{ $nutrient->minimum }} </td>

                @if(!empty($nutrient->permissable_unit))
                <td>{{ $nutrient->permissable_unit }} </td>
                @else
                <td>N/A</td>
                @endif
                
                @if(!empty($nutrient->permissable_overage))
                <td>{{ $nutrient->permissable_overage }} </td>
                @else
                <td>N/A</td>
                @endif
                
                @if(!empty($nutrient->caution))
                <td>{{ $nutrient->caution }} </td>
                @else
                <td>N/A</td>
                @endif

                @if(!empty($nutrient->usable_part))
                <td>{{ $nutrient->usable_part }} </td>
                @else
                <td>N/A</td>
                @endif

            
                @if($nutrient->nutrientcategory != null)
                <td>{{ $nutrient->nutrientcategory->name }} </td>
                @else
                <td>N/A</td>
                @endif
                <td>{{ $nutrient->created_at->format('Y-m-d') }} </td>

                <td>
                    <div class="d-flex kit-action-com">
                        <!-- <div class="action-btn-view">
                            <a href="viewproductiontype.html">
                                View
                            </a>
                        </div> -->
                        
                        <div class="action-btn-pen">
                            <a href="{{ route('nutrient.edit', $nutrient->id) }}"
                                method="put"><span class="material-symbols-outlined">
                                edit
                                </span></a>
                        </div>
                        

                        @if (auth()->user()->role == 0)
                        <form class="action-btn-dlt" action="{{ route('nutrient.delete', $nutrient->id) }}"
                            method="post">
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
            <p>No nutrient!</p>
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
            var date = new Date(data[11]);
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
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11]
                    }
                },
                {
                    extend: 'csv',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11]
                    }
                },
                {
                    extend: 'excel',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11]
                    }
                },
                {
                    extend: 'pdf',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11]
                    }
                },
                {
                    extend: 'print',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11]
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


        $('#nutrientcategory').on('change', function() {
            var type = $(this).val();
            table.columns(10).search(type).draw();
        });

        $('#reset').on('click', function() {
            $('#min').val('');
            $('#max').val('');
            $('#nutrientcategory').val('');

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