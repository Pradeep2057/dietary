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

    <h1>All manufacturerauthorities</h1>
    @if(!empty($manufacturerauthorities))
    <ul>
        @foreach ($manufacturerauthorities as $manufacturerauthority)
            <li>{{ $manufacturerauthority->name }} 
            @if (auth()->user()->id == $manufacturerauthority->author_id) 
                <a href="{{ route('manufacturer-authority.edit', $manufacturerauthority->id) }}" method="put">update</a>
            @endif
            @if (auth()->user()->role == 0) 
            <form class="row g-3" action="{{ route('manufacturer-authority.delete', $manufacturerauthority->id) }}" method="post">
            @csrf
            @method('delete')
                <button type="submit">Delete</button>
            </form>
            @endif
            </li>
        @endforeach
    </ul>
    @else
    <p>No manufacturerauthority!</p>
    @endif
@endsection