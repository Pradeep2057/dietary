@extends('layouts.main')
@section('title', 'Product')
@section('content')

<div class="add-heading">
    <h3 class="heading-cm"> 
        <a href="{{ route('home')}}" class="nav-icon me-2">
            <i class="fa-solid fa-angle-left"></i> 
        </a>
        Products<span class="sub-nav ms-2" > > All</span>
    </h3>
    <p><a href="{{ route('product.create')}}"> <i class="fa-solid fa-plus"></i> Add Product</a></p>
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



    <div class="row mb-4 filter-row filters">
        <div class="row mb-2">
            <div class="col-md-3">
                <select id="product_type" name="product_type" class="form-select kit-form-control">
                    <option value="all" disabled selected>Select Type</option>
                    @foreach ($producttypes->unique('name') as $producttype)
                    <option value="{{ $producttype->id }}">{{ $producttype->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <select id="product_form" name="product_form" class="form-select kit-form-control">
                    <option value="all" disabled selected>Select Form</option>
                    @foreach ($productforms->unique('name') as $productform)
                    <option value="{{ $productform->id }}">{{ $productform->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <select id="manufacturer"  name="manufacturer" class="form-select kit-form-control">
                    <option value="all" disabled selected>Select Manufacturer</option>
                    @foreach ($manufacturers->unique('name') as $manufacturer)
                    <option value="{{ $manufacturer->id }}">{{ $manufacturer->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <select id="lab" name="lab" class="form-select kit-form-control">
                    <option value="all" disabled selected>Select Lab</option>
                    @foreach ($labs->unique('name') as $lab)
                    <option value="{{ $lab->id }}">{{ $lab->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <select id="status" name="status" class="form-select kit-form-control">
                    <option value="all" disabled selected>Select Status</option>
                    <option value="Pending">Pending</option>
                    <option value="Verified">Verified</option>
                </select>
            </div>
            <div class="col-md-3">
                <input type="date" class="form-control cm" id="min" name="min" placeholder="From">
            </div>
            <div class="col-md-3">
                <input type="date" class="form-control cm" id="max" name="max" placeholder="To">
            </div>
            <div class="col-md-3">
            <button id="reset">Reset</button>
            </div>
        </div>
    </div>


    <table id="sampleTable" class="table hover-table" style="width:100%">
        <thead>
            <tr>
                <th>S No.</th>
                <th>Registration No.</th>
                <th>Product Name</th>
                <th>Product Type</th>
                <th>Product Form</th>
                <th>Manufacturer</th>
                <th>Lab</th>
                <th>Importer</th>
                <th>Status</th>
                <th>Date</th>
                <th>Action</th>
            </tr>
        </thead>
    </table>

            @endsection
</div>

@section('custom-js')




<script>
    $(document).ready(function () {
        var table = $('#sampleTable').DataTable({

            drawCallback: function() {
                var api = this.api();
                var startIndex = api.context[0]._iDisplayStart;
                api.column(0, {search: 'applied', order: 'applied'}).nodes().each(function(cell, i) {
                    cell.innerHTML = startIndex + i + 1;
                });
            },

            processing: true,
            serverSide: true,
            searchable: true,
            dom: 'Bfrtipl',
            language: {
                info: '',
                lengthMenu: 'Show _MENU_ entries',
            },
            buttons: [{
                    extend: 'copy',
                    exportOptions: {
                        columns: [1, 2, 3, 4, 5, 6, 7, 8]
                    }
                },
                {
                    extend: 'csv',
                    exportOptions: {
                        columns: [1, 2, 3, 4, 5, 6, 7, 8]
                    }
                },
                {
                    extend: 'excel',
                    exportOptions: {
                        columns: [1, 2, 3, 4, 5, 6, 7, 8]
                    }
                },
                {
                    extend: 'pdf',
                    exportOptions: {
                        columns: [1, 2, 3, 4, 5, 6, 7, 8]
                    }
                },
                {
                    extend: 'print',
                    exportOptions: {
                        columns: [1, 2, 3, 4, 5, 6, 7, 8]
                    }
                }
            ],
            // ajax: "{{ route('product.data') }}",

            ajax: {
                url: "{{ route('product.data') }}",
                data: function (d) {
                    d.product_type = $('#product_type').val(),
                    d.product_form = $('#product_form').val(),
                    d.status = $('#status').val(),
                    d.manufacturer = $('#manufacturer').val(),
                    d.min = $('#min').val(),
                    d.max = $('#max').val(),
                    d.lab = $('#lab').val(),
                    d.search = $('input[type="search"]').val()
                }
            },

            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', title: 'S.No',orderable: false   },
                {data: 'registration', name: 'registration' ,orderable: false, searchable: true},
                {data: 'name', name: 'name' ,orderable: false, searchable: true},
                {data: 'product_type', name: 'product_type' ,orderable: false, searchable: true},
                {data: 'product_form', name: 'product_form' ,orderable: false, searchable: true},
                {data: 'manufacturer', name: 'manufacturer' ,orderable: false, searchable: true},
                {data: 'lab', name: 'lab' ,orderable: false, searchable: true},
                {data: 'importer', name: 'importer' ,orderable: false, searchable: true},
                {data: 'status', name: 'status' ,orderable: false, searchable: true},
                {data: 'created_at', name: 'created_at' ,orderable: false, searchable: true},
                {data: 'action', name: 'action', orderable: false, searchable: true},
            ],
        });


        $('#reset').on('click', function () {
            resetFilters();
        });

        $("#product_type").on('change', function(){
            table.draw();
        });

        $("#status").on('change', function(){
            table.draw();
        });

        $('#product_form').on('change', function() {
            table.draw();
        });

        $('#manufacturer').on('change', function() {
            table.draw();
        });

        $('#min').on('change', function() {
            table.draw();
        });

        $('#max').on('change', function() {
            table.draw();
        });

        $('#lab').on('change', function() {
            table.draw();
        });

        function resetFilters() {
            $('#product_type, #product_form, #manufacturer, #lab, #status').val('all');
            $('#min, #max').val('');
            table.columns().search('').draw();
        }

    });

</script>

@endsection