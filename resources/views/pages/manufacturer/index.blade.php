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

    <h1>All Manufacturers</h1>
    @if(!empty($manufacturers))
    <ul>
        @foreach ($manufacturers as $manufacturer)
            <li>{{ $manufacturer->name }}  {{ $manufacturer->registration_number }} {{ $manufacturer->manufacturerauthority->name }} {{ $manufacturer->registration_validity }} {{ $manufacturer->country->name }} <a href="{{ route('manufacturer.edit', $manufacturer->id) }}" method="put">update</a>
            @if (auth()->user()->role == 0) 
            <form class="row g-3" action="{{ route('manufacturer.delete', $manufacturer->id) }}" method="post">
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