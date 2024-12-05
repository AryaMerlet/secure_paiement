@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Refund Paiement</h1>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Paiement Details</h5>
            {{-- {{dd($paiement)}} --}}
            <p><strong>User:</strong> {{ $paiement->user->name ?? 'N/A' }}</p>
            <p><strong>Original Amount:</strong> ${{ number_format($paiement->price, 2) }}</p>
            <p><strong>Refunded Amount:</strong> ${{ number_format($paiement->refunded_amount ?? 0, 2) }}</p>
        </div>
    </div>

    <form action="{{ route('paiements.update', $paiement->id) }}" method="POST" class="mt-4">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="refund_amount">Refund Amount</label>
            <input type="number" class="form-control" id="refund_amount" name="refund_amount" step="0.01"
                   max="{{ $paiement->price - $paiement->refunded_amount }}" required>
            <small class="form-text text-muted">
                Maximum refundable amount: ${{ number_format($paiement->price - $paiement->refunded_amount, 2) }}
            </small>
        </div>

        <button type="submit" class="btn btn-primary mt-3">Submit Refund</button>
    </form>

    <a href="{{ route('paiements.index') }}" class="btn btn-secondary mt-3">Cancel</a>
</div>
@endsection
