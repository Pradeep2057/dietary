@extends('layouts.main')
@section('title', 'Product Type')
@section('content')

<div class="add-heading">
    <h3 class="heading-cm"> 
        <a href="{{ route('capital.index')}}" class="nav-icon me-2">
            <i class="fa-solid fa-angle-left"></i> 
        </a>
        Manufacturer<span class="sub-nav ms-2" > > Capital > Edit</span>
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
            <h3 class="create-form-heading">Edit Capital</h3>
            <form action="{{ route('capital.update', $capital) }}" method="post">
                @csrf
                @method('PUT')
                <div class="row mb-3">
                    <div class="col-md-12">
                        <label for="" class="form-label cm">Capital Amount</label>
                        <input type="text" class="form-control cm @error('name') is-invalid @enderror" placeholder="Enter capital" name="name"
                            value="{{ $capital->name }}">
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-md-12">
                        <label for="" class="form-label cm">Cost</label>
                        <input type="text" class="form-control cm @error('amount') is-invalid @enderror" placeholder="Enter cost" name="amount"
                            value="{{ $capital->amount }}">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
        @if(!empty($capitals))
        <div class="col-md-9">
            <table id="sampleTable" class="table hover-table" style="width:100%">
                <thead>
                    <tr>
                        <th>S No.</th>
                        <th>Amount</th>
                        <th>Cost</th>
                        <th>Created Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $i = 1;
                    @endphp
                    @foreach ($capitals as $capital)
                    <tr>
                        <td>{{ $i }}</td>
                        <td>{{ $capital->name }} </td>
                        <td>{{ $capital->amount }} </td>
                        <td>{{ $capital->created_at->format('Y-m-d') }} </td>

                        <td>
                            <div class="d-flex kit-action-com">
                                <!-- <div class="action-btn-view">
                                    <a href="viewproductiontype.html">
                                        View
                                    </a>
                                </div> -->
                                
                                
                            
                                {{-- <div class="action-btn-pen">
                                    <a href="{{ route('capital.edit', $capital->id) }}"
                                        method="put"><button>Edit</button></a>
                                </div> --}}
                             
                                <div class="action-btn-pen">
                                    <a href="{{ route('capital.edit', $capital->id) }}"
                                        method="put">
                                        <span class="material-symbols-outlined">
                                            edit
                                        </span></a>
                                </div>

                                @if (auth()->user()->role == 0)
                                <form class="action-btn-dlt" action="{{ route('capital.delete', $capital->id) }}"
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
                    <p>No doses!</p>
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
                    columns: [0, 1, 2, 3]
                }
            },
            {
                extend: 'csv',
                exportOptions: {
                    columns: [0, 1, 2, 3]
                }
            },
            {
                extend: 'excel',
                exportOptions: {
                    columns: [0, 1, 2, 3]
                }
            },
            {
                extend: 'pdf',
                exportOptions: {
                    columns: [0, 1, 2, 3]
                }
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: [0, 1, 2, 3]
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