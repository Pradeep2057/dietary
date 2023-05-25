@extends('layouts.main')
@section('title', 'Fiscal Year')
@section('content')

<div class="add-heading">
    <h3 class="heading-cm">Fiscal Year</h3>
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
            <h3 class="create-form-heading">Fiscal Year</h3>
            <form action="{{ route('fiscalyear.store') }}" method="POST">
                @csrf
                <div class="row mb-3">
                    <div class="col-md-12">
                        <label for="" class="form-label cm">Fiscal Year</label>
                        <input type="text" class="form-control cm" placeholder="Enter fiscal year" name="name">
                    </div>
                </div>
                <button type="submit" class="btn btn-primary">Create</button>
            </form>
        </div>
        <div class="col-md-9">
            @if(!empty($fiscalyears))

            <table id="sampleTable" class="table table-striped" style="width:100%">
                <thead>
                    <tr>
                        <th>S No.</th>
                        <th>Fiscal Year</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                    $i = 1;
                    @endphp
                    @foreach ($fiscalyears as $fiscalyear)
                    <tr>
                        <td>{{ $i }}</td>
                        <td>{{ $fiscalyear->name }}</td>

                        <td>
                            @if (auth()->user()->role == 0)
                            <div class="d-flex kit-action-com">
                                <div class="action-btn-pen">
                                    <a href="{{ route('fiscalyear.edit', $fiscalyear->id) }}"
                                        method="put"><span class="material-symbols-outlined">
                                            edit
                                            </span></a>
                                </div>
                            </div>
                            @endif
                        </td>
                    </tr>
                    @php
                    $i++;
                    @endphp
                    @endforeach
                    @else
                    <p>No fiscalyears!</p>
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




