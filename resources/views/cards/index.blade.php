@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Cards</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @elseif(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if(Auth::user()->can('create', App\Models\Card::class))
        <a href="{{ route('cards.create') }}" class="btn btn-primary mb-3">Create New Card</a>
    @endif

    <div class="row">
        @foreach($cards as $card)
            <div class="col-md-4 mb-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{ $card->name }}</h5>
                        <p class="card-text">Type: {{ $card->type }}</p>
                        <p class="card-text">Expiration Date: {{ $card->expiration_date->format('m/y') }}</p>
                        <a href="{{ route('cards.show', $card) }}" class="btn btn-info">View</a>
                        
                        @if(Auth::user()->can('update', $card))
                            <a href="{{ route('cards.edit', $card) }}" class="btn btn-warning">Edit</a>
                        @endif
                        
                        @if(Auth::user()->can('delete', $card))
                            <form action="{{ route('cards.destroy', $card) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
