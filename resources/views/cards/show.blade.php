@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Card Details</h1>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $card->name }}</h5>
            <p class="card-text"><strong>Type:</strong> {{ $card->type }}</p>
            <p class="card-text"><strong>Card Number:</strong> **** **** **** {{ substr($card->number, -4) }}</p>
            <p class="card-text"><strong>Expiration Date:</strong> {{ $card->expiration_date->format('m/y') }}</p>
            <p class="card-text"><strong>CVV Code:</strong> ***</p>

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

            <a href="{{ route('cards.index') }}" class="btn btn-secondary">Back to Cards</a>
        </div>
    </div>
</div>
@endsection
