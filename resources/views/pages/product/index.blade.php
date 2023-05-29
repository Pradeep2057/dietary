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

    @if(!empty($products))

    <div class="row mb-4 filter-row filters">
        <div class="row mb-2">
            <div class="col-md-3">
                <select id="product_type" class="form-select kit-form-control">
                    <option value="" disabled selected>Select Type</option>
                    @foreach ($products->unique('producttype.name') as $product)
                    <option value="{{ $product->producttype->name }}">{{ $product->producttype->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <select id="product_form" class="form-select kit-form-control">
                    <option value="" disabled selected>Select Form</option>
                    @foreach ($products->unique('productform.name') as $product)
                    <option value="{{ $product->productform->name }}">{{ $product->productform->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <select id="manufacturer" class="form-select kit-form-control">
                    <option value="" disabled selected>Select Manufacturer</option>
                    @foreach ($products->unique('manufacturer.name') as $product)
                    <option value="{{ $product->manufacturer->name }}">{{ $product->manufacturer->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <select id="importer" class="form-select kit-form-control">
                    <option value="" disabled selected>Select Importer</option>
                    @foreach ($importers->unique('name') as $importer)
                    <option value="{{ $importer->name }}">{{ $importer->name }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-md-3">
                <select id="status" class="form-select kit-form-control">
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
                <th>Lab</th>
                <th>Status</th>
                <th>Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @php
            $i = 1;
            @endphp
            @foreach ($products as $product)
                <tr>
                    <td>{{ $i }}</td>
                    <td>{{ $product->registration }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->producttype->name }}</td>
                    <td>{{ $product->productform->name }}</td>
                    <td>{{ $product->manufacturer->name }}</td>
                    <td>
                        @foreach ($product->importers as $importer)
                            {{ $importer->name }}
                        @endforeach
                    </td>
                    <td>{{ $product->lab->name }}</td>
                    <td ><div class="@if($product->status == 'Pending') pending @elseif($product->status == 'Verified') verified @else rejected @endif">{{ $product->status}}</div></td>
                    <td>{{ $product->created_at->format('Y-m-d') }}</td>

                    <td>
                        <div class="d-flex kit-action-com">
                            <div class="action-btn-view">
                                <a href="{{ route('product.display', $product->id) }}">
                                    <span class="material-symbols-outlined">
                                        visibility
                                        </span>
                                </a>
                            </div>

                            @if (auth()->user()->role == 2 && $product->status == 'Pending')
                            <div class="action-btn-pen">
                                <a href="{{ route('product.edit', $product->id) }}" method="put"><span class="material-symbols-outlined">
                                    edit
                                    </span></a>
                            </div>
                            @elseif (auth()->user()->role == 0 || auth()->user()->role == 1 )
                            <div class="action-btn-pen">
                                <a href="{{ route('product.edit', $product->id) }}" method="put"><span class="material-symbols-outlined">
                                    edit
                                    </span></a>
                            </div>
                            @else
                            @endif

                            @if (auth()->user()->role == 0)
                            <form class="action-btn-dlt" action="{{ route('product.delete', $product->id) }}" method="post">
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
            <p>No product!</p>
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
            var date = new Date(data[9]);
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
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9]
                    }
                },
                {
                    extend: 'csv',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9]
                    }
                },
                {
                    extend: 'excel',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9]
                    }
                },
                {
                    extend: 'pdf',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9]
                    }
                },
                {
                    extend: 'print',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8, 9]
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


        $('#product_type').on('change', function() {
            var type = $(this).val();
            table.columns(3).search(type).draw();
        });
        $('#product_form').on('change', function() {
            var type = $(this).val();
            table.columns(4).search(type).draw();
        });
        $('#manufacturer').on('change', function() {
            var type = $(this).val();
            table.columns(5).search(type).draw();
        });
        $('#importer').on('change', function() {
            var type = $(this).val();
            table.columns(6).search(type).draw();
        });

        $('#status').on('change', function() {
            var type = $(this).val();
            table.columns(8).search(type).draw();
        });

        $('#min, #max').on('change', function() {
            table.draw();
        });

        $('#reset').on('click', function() {
            $('#min').val('');
            $('#max').val('');
            $('#product_type').val('');
            $('#product_form').val('');
            $('#manufacturer').val('');
            $('#importer').val('');
            $('#status').val('');

            table.columns().search('').draw();
            minDate.val('');
            maxDate.val('');
            table.draw();
        });

    });
</script>
@endsection