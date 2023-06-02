@extends('layouts.main')
@section('title', 'Users')
@section('content')

<div class="add-heading">
    <h3 class="heading-cm">Users</h3>
    <p><a href="{{ route('user.create')}}"> <i class="fa-solid fa-plus"></i> Create User</a></p>
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

    @if(!empty($users))

    <div class="row mb-4 filter-row filters">
        <div class="col-md-4">
            <select id="role" class="form-select kit-form-control">
                <option value="" disabled selected>Select Role</option>
                <option value="Verifier">Verifier</option>
                <option value="Reviewer">Reviewer</option>
                <option value="Data Entry Operator">Data Entry Operator</option>
                <option value="Report Viewer">Report Viewer</option>
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

    <table id="sampleTable" class="table table-striped" style="width:100%">
        <thead>
            <tr>
                <th>S No.</th>
                <th>User Name</th>
                <th>Email Address</th>
                <th>Role</th>
                <th>Created Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        @php
            $i = 1;
        @endphp
        @foreach ($users as $user)
            <tr>
                <td>{{ $i }}</td>
                <td>{{ $user->name }} </td>
                <td>{{ $user->email }} </td>
                <td>@if ($user->role == 0) Verifier @elseif($user->role == 1)Reviewer @elseif($user->role == 2)Data Entry Operator @else Report Viewer @endif</td>
                <td>{{ $user->created_at->format('Y-m-d')}}</td>

                <td>
                    <div class="d-flex kit-action-com">
                        @if (auth()->user()->role == 0) 
                        <div class="action-btn-pen">
                        <a href="{{ route('user.edit', $user->id) }}" method="put"><span class="material-symbols-outlined">
                                edit
                                </span></a>
                        </div>
                        @endif

                        @if (auth()->user()->role == 0)
                        <form class="action-btn-dlt" action="{{ route('user.delete', $user->id) }}" method="post">
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
        <p>No size!</p>
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
            var date = new Date(data[4]);
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
            columnDefs: [
            {
                targets: -1,
                visible: true,
            }
        ]
        });


        $('#role').on('change', function() {
            var type = $(this).val();
            table.columns(3).search(type).draw();
        });

        $('#reset').on('click', function() {
            $('#min').val('');
            $('#max').val('');
            $('#role').val('');

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



