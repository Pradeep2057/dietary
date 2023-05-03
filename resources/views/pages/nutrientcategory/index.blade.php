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

    <h1>All Nutrient categories</h1>
    @if(!empty($nutrientcategories))
    <ul>
        @foreach ($nutrientcategories as $nutrientcategory)
            <li>{{ $nutrientcategory->name }} <a href="{{ route('nutrient-category.edit', $nutrientcategory->id) }}" method="put">update</a>
            @if (auth()->user()->role == 0) 
            <form class="row g-3" action="{{ route('nutrient-category.delete', $nutrientcategory->id) }}" method="post">
            @csrf
            @method('delete')
                <button type="submit">Delete</button>
            </form>
            @endif
            </li>
        @endforeach
    </ul>
    @else
    <p>No Nutrient Category!</p>
    @endif
@endsection