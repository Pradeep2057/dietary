@extends('layouts.app')

@section('content')
    @if(session('successct'))
        <div class="alert alert-success">
            {{ session('successct') }}
        </div>
    @endif

    @if(session('successup'))
        <div class="alert alert-info">
            {{ session('successup') }}
        </div>
    @endif

    @if(session('successdt'))
        <div class="alert alert-danger">
            {{ session('successdt') }}
        </div>
    @endif

    <h1>All Agencies</h1>
    @if(!empty($agencies))
    <ul>
        @foreach ($agencies as $agency)
            <li>{{ $agency->name }} <a href="{{ route('agency.edit', $agency->id) }}" method="put">update</a>
            @if (auth()->user()->role == 0) 
            <form class="row g-3" action="{{ route('agency.delete', $agency->id) }}" method="post">
            @csrf
            @method('delete')
                <button type="submit">Delete</button>
            </form>
            @endif
            </li>
        @endforeach
    </ul>
    @else
    <p>No Category!</p>
    @endif
@endsection