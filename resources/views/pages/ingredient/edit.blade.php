@extends('layouts.main')
@section('title', 'Ingredient')
@section('content')

<div class="add-heading">
    <h3 class="heading-cm"> 
        <a href="{{ route('ingredient.index')}}" class="nav-icon me-2">
            <i class="fa-solid fa-angle-left"></i> 
        </a>
        Product Details<span class="sub-nav ms-2" > > Ingredient > Edit</span>
    </h3>
</div>

<div class="form-cm">
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

    <div class="row">
        <div class="col-md-3">
            <h3 class="create-form-heading">Edit Ingredient</h3>
            <form action="{{ route('ingredient.update', $ingredient) }}" method="post">
                @csrf
                @method('put')
                <div class="row mb-3">
                    <div class="col-md-12">
                        <label for="" class="form-label cm">Ingredient Name</label>
                        <input type="text" class="form-control cm" placeholder="Enter ingredient name" name="name" value="{{ $ingredient->name }}">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
        <div class="col-md-9">
            @if(!empty($ingredients))

            <table id="sampleTable" class="table table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th>S No.</th>
                        <th>Ingredient</th>
                        <th>Created Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $i = 1;
                    @endphp
                    @foreach ($ingredients as $ingredient)
                    <tr>
                        <td>{{ $i }}</td>
                        <td>{{ $ingredient->name }}</td>
                        <td>{{ $ingredient->created_at->format('Y-m-d') }}</td>

                        <td>
                            <div class="d-flex kit-action-com">
                                <!-- <div class="action-btn-view">
                                    <a href="viewproductiontype.html">
                                        View
                                    </a>
                                </div> -->
                                <div class="action-btn-pen">
                                    <a href="{{ route('ingredient.edit', $ingredient->id) }}"
                                        method="put"><button>Edit</button></a>
                                </div>

                                @if (auth()->user()->role == 0)
                                <form class="action-btn-dlt"
                                    action="{{ route('ingredient.delete', $ingredient->id) }}" method="post">
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
    </div>


</div>

@section('custom-js')
<script>
    var table = $('#sampleTable').DataTable({
        dom: 'Bfrtip',
        buttons: [{
                extend: 'copy',
                // text: '<span class="material-symbols-outlined">content_copy</span> Copy',
                exportOptions: {
                    columns: [0, 1, 2]
                }
            },
            {
                extend: 'csv',
                exportOptions: {
                    columns: [0, 1, 2]
                }
            },
            {
                extend: 'excel',
                exportOptions: {
                    columns: [0, 1, 2]
                }
            },
            {
                extend: 'pdf',
                exportOptions: {
                    columns: [0, 1, 2]
                }
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: [0, 1, 2]
                }
            }
        ],
        columnDefs: [{
            targets: -1,
            visible: true,
        }]
    });
</script>
@endsection







