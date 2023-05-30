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
                    <option value="" disabled selected>Select Type</option>
                    @foreach ($producttypes->unique('name') as $producttype)
                    <option value="{{ $producttype->name }}">{{ $producttype->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <select id="product_form" name="product_form" class="form-select kit-form-control">
                    <option value="" disabled selected>Select Form</option>
                    @foreach ($productforms->unique('name') as $productform)
                    <option value="{{ $productform->name }}">{{ $productform->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <select id="manufacturer"  name="manufacturer" class="form-select kit-form-control">
                    <option value="" disabled selected>Select Manufacturer</option>
                    @foreach ($manufacturers->unique('name') as $manufacturer)
                    <option value="{{ $manufacturer->name }}">{{ $manufacturer->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <select id="importer" name="importer" class="form-select kit-form-control">
                    <option value="" disabled selected>Select Importer</option>
                    @foreach ($importers->unique('name') as $importer)
                    <option value="{{ $importer->name }}">{{ $importer->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <select id="status" name="status" class="form-select kit-form-control">
                    <option value="" disabled selected>Select Status</option>
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
                <th>Importer</th>
                <th>Status</th>
                <th>Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
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
            ajax: "{{ route('product.data') }}",
            columns: [
                {data: 'DT_RowIndex', name: 'DT_RowIndex', title: 'S.No'},
                {data: 'registration', name: 'registration' ,orderable: false, searchable: true},
                {data: 'name', name: 'name' ,orderable: false, searchable: true},
                {data: 'product_type', name: 'product_type' ,orderable: false, searchable: true},
                {data: 'product_form', name: 'product_form' ,orderable: false, searchable: true},
                {data: 'manufacturer', name: 'manufacturer' ,orderable: false, searchable: true},
                {data: 'importer', name: 'importer' ,orderable: false, searchable: true},
                {data: 'status', name: 'status' ,orderable: false, searchable: true},
                {data: 'created_at', name: 'created_at' ,orderable: false, searchable: true},
                {data: 'action', name: 'action', orderable: false, searchable: true},
            ],

            initComplete: function () {
                applyFilters();
            }
        });

        $('#product_type, #product_form, #manufacturer, #importer, #status, #min, #max').on('change', function () {
            applyFilters();
        });

        $('#reset').on('click', function () {
            resetFilters();
        });

        function applyFilters() {
            var product_type = $('#product_type').val();
            var product_form = $('#product_form').val();
            var manufacturer = $('#manufacturer').val();
            var importer = $('#importer').val();
            var status = $('#status').val();
            var min = $('#min').val();
            var max = $('#max').val();

            table.column(3).search(product_type);
            table.column(4).search(product_form);
            table.column(5).search(manufacturer);
            table.column(6).search(importer);
            table.column(7).search(status);

            if (min !== '') {
                table.column(8).min(min);
            } else {
                table.column(8).search('');
            }

            if (max !== '') {
                table.column(8).max(max);
            } else {
                table.column(8).search('');
            }

            table.draw();
        }

        function resetFilters() {
            $('#product_type, #product_form, #manufacturer, #importer, #status, #min, #max').val('');
            table.columns().search('').draw();
        }

    });

</script>

@endsection