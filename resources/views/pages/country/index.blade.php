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

    <h1>All Country</h1>
    @if(!empty($countries))
    <ul>
        @foreach ($countries as $country)
            <li>{{ $country->name }}  {{ $country->population }}  {{ $country->area }} <a href="{{ route('country.edit', $country->id) }}" method="put">update</a>
            @if (auth()->user()->role == 0) 
            <form class="row g-3" action="{{ route('country.delete', $country->id) }}" method="post">
            @csrf
            @method('delete')
                <button type="submit">Delete</button>
            </form>
            @endif
            </li>
        @endforeach
    </ul>
    @else
    <p>No Country!</p>
    @endif
@endsection