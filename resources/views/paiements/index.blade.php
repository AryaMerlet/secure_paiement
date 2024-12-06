@extends('layouts.app')

@section('content')

@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

@if(session('error'))
<div class="alert alert-danger">
    {{ session('error') }}
</div>
@endif

<div class="container">
    <h1 class="mb-4">Paiements</h1>
    {{-- {{dd(auth()->user()->can('create', App\Models\Paiement::class))}} --}}
    <!-- Conditionally show "Add Paiement" button only if the user has permission -->
    @can('create', App\Models\Paiement::class)
        <a href="{{ route('paiements.create') }}" class="btn btn-primary mb-3">Add Paiement</a>
    @endcan


    <table class="table table-bordered table-stripped table-hover">
        <thead>
            <tr>
                <th>ID</th>
                <th>User</th>
                <th>Card</th>
                <th>Original price</th>
                <th>Updated price</th>
                <th>Refunded amount</th>
                @if ($user->can('refund', App\Models\Paiement::class))
                <th>Actions</th>
                @endif
            </tr>
        </thead>
        <tbody>
            @foreach ($paiments as $paiement)
                <tr>
                    <td>{{ $paiement->id }}</td>
                    <td>{{ $paiement->user->name ?? '-' }}</td>
                    <td>{{ $paiement->card->number ?? '-' }}</td>
                    <td>{{ $paiement->price }}</td>
                    <td>{{ $paiement->refunded_amount }}</td>
                    <td>{{ $paiement->price - $paiement->refunded_amount }}</td>
                    @if ($user->can('refund', $paiement))
                    <td>

                            <a href="{{ route('paiements.edit', $paiement) }}" class="btn btn-sm btn-warning">Edit</a>

                        {{-- <form action="{{ route('paiements.destroy', $paiement) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')" @disabled(!$user->can('refund', $paiement))>
                                Delete
                            </button>
                        </form> --}}
                    </td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection

