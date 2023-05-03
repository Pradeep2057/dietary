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

    <h1>All Nutrients</h1>
    @if(!empty($nutrients))
    <ul>
        @foreach ($nutrients as $nutrient)
            <li>{{ $nutrient->name }} {{ $nutrient->nutrientcategory->name }} <a href="{{ route('nutrient.edit', $nutrient->id) }}" method="put">update</a>
            @if (auth()->user()->role == 0) 
            <form class="row g-3" action="{{ route('nutrient.delete', $nutrient->id) }}" method="post">
            @csrf
            @method('delete')
                <button type="submit">Delete</button>
            </form>
            @endif
            </li>
        @endforeach
    </ul>
    @else
    <p>No Nutrients!</p>
    @endif
@endsection