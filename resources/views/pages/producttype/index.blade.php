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

    <h1>All Producttypes</h1>
    @if(!empty($producttypes))
    <ul>
        @foreach ($producttypes as $producttype)
            <li>{{ $producttype->name }} <a href="{{ route('type-of-product.edit', $producttype->id) }}" method="put">update</a>
            @if (auth()->user()->role == 0) 
            <form class="row g-3" action="{{ route('type-of-product.delete', $producttype->id) }}" method="post">
            @csrf
            @method('delete')
                <button type="submit">Delete</button>
            </form>
            @endif
            </li>
        @endforeach
    </ul>
    @else
    <p>No producttypes!</p>
    @endif
@endsection