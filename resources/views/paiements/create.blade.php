@extends('layouts.app')

@section('content')
{{-- {{dd(auth()->user()->can('create', App\Models\Paiement::class));}} --}}
<div class="container">
    <h1 class="mb-4">Add Paiement</h1>
    <form action="{{ route('paiements.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="card_id" class="form-label">Card</label>
            <select name="card_id" id="card_id" class="form-select" required>
                @foreach ($cards as $card)
                    <option value="{{ $card->id }}">{{ $card->number }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Price</label>
            <input type="number" step="0.01" name="price" id="price" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success">Save</button>
        <a href="{{ route('paiements.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
