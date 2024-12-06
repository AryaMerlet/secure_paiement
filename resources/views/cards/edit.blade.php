@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Edit Card</h1>

    <form action="{{ route('cards.update', $card) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Cardholder Name</label>
            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $card->name) }}" required>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="type">Card Type</label>
            <select class="form-control @error('type') is-invalid @enderror" id="type" name="type" required>
                <option value="credit" {{ old('type', $card->type) == 'credit' ? 'selected' : '' }}>Credit</option>
                <option value="debit" {{ old('type', $card->type) == 'debit' ? 'selected' : '' }}>Debit</option>
            </select>
            @error('type')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="number">Card Number</label>
            <input type="text" class="form-control @error('number') is-invalid @enderror" id="number" name="number" value="{{ old('number', $card->number) }}" required maxlength="16" disabled>
            @error('number')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="expiration_date">Expiration Date</label>
            <input type="month" class="form-control @error('expiration_date') is-invalid @enderror" id="expiration_date" name="expiration_date" value="{{ old('expiration_date', $card->expiration_date) }}" required>
            @error('expiration_date')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="code">CVV Code</label>
            <input type="text" class="form-control @error('code') is-invalid @enderror" id="code" name="code" value="{{ old('code', $card->code) }}" required maxlength="3">
            @error('code')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-success">Update Card</button>
        <a href="{{ route('cards.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
</div>
@endsection
