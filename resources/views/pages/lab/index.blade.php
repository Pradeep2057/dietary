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

    <h1>All Lab</h1>
    @if(!empty($labs))
    <ul>
        @foreach ($labs as $lab)
            <li>{{ $lab->name }}  {{ $lab->recognized_agency }} {{ $lab->website }} {{ $lab->country->name }}<a href="{{ route('lab.edit', $lab->id) }}" method="put">update</a>
            @if (auth()->user()->role == 0) 
            <form class="row g-3" action="{{ route('lab.delete', $lab->id) }}" method="post">
            @csrf
            @method('delete')
                <button type="submit">Delete</button>
            </form>
            @endif
            </li>
        @endforeach
    </ul>
    @else
    <p>No Lab!</p>
    @endif
@endsection