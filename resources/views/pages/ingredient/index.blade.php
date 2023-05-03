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

    <h1>All ingredients</h1>
    @if(!empty($ingredients))
    <ul>
        @foreach ($ingredients as $ingredient)
            <li>{{ $ingredient->name }} 
            @if (auth()->user()->id == $ingredient->author_id) 
                <a href="{{ route('ingredient.edit', $ingredient->id) }}" method="put">update</a>
            @endif
            @if (auth()->user()->role == 0) 
            <form class="row g-3" action="{{ route('ingredient.delete', $ingredient->id) }}" method="post">
            @csrf
            @method('delete')
                <button type="submit">Delete</button>
            </form>
            @endif
            </li>
        @endforeach
    </ul>
    @else
    <p>No Productforms!</p>
    @endif
@endsection