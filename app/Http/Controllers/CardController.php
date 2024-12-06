<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCardRequest;
use App\Http\Requests\UpdateCardRequest;
use App\Models\Card;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class CardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        if($user->isan('admin')){
            $cards = Card::all();
            $users  = User::all();
            return view ('cards.index',compact('users', 'cards'));
        }
        else if ($user->isa('user')){
            $cards = Card::with(['users'])
            ->where('user_id', $user->id)
            ->get();
            return view ('cards.index',compact('cards', 'user'));
        }
        else{
            return redirect()->route('dashboard')->with('error', 'You do not have permission to access this page.');
        }

        // if (Auth::user()->isAdmin()) {
        //     // L'administrateur peut voir toutes les cartes
        //     $cards = Card::all();
        // } else {
        //     // Les utilisateurs normaux voient seulement leurs cartes
        //     $cards = Auth::user()->cards;
        // }

        // return view('cards.index', compact('cards'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::user();
        if ($user->can('create',Card::class)){
            return view('cards.create');
        }else {
            return redirect()->route('dashboard')->with('error', 'You do not have permission to create new cards.');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCardRequest $request)
    {
        $card = new Card($request->validated());
        $card->user_id = Auth::id(); // Associer la carte à l'utilisateur connecté
        $card->save();

        return redirect()->route('cards.index')->with('success', 'Carte créée avec succès.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Card $card)
    {
        // Vérifiez si l'utilisateur est un administrateur ou le propriétaire de la carte
        if (Auth::user()->isAdmin() || $card->user_id === Auth::id()) {
            return view('cards.show', compact('card'));
        }

        abort(403, 'Accès interdit');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Card $card)
    {
        // Vérifiez si l'utilisateur est un administrateur ou le propriétaire de la carte
        if (Auth::user()->isA('admin') || $card->user_id === Auth::id()) {
            return view('cards.edit', compact('card'));
        }

        abort(403, 'Accès interdit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCardRequest $request, Card $card)
    {
        // Vérifiez si l'utilisateur est un administrateur ou le propriétaire de la carte
        if ($card->user_id === Auth::id()) {
            $card->update($request->validated());
            return redirect()->route('cards.index')->with('success', 'Carte mise à jour avec succès.');
        }

        abort(403, 'Accès interdit');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Card $card)
    {
        // Vérifiez si l'utilisateur est un administrateur ou le propriétaire de la carte
        if ($card->user_id === Auth::id()) {
            $card->delete();
            return redirect()->route('cards.index')->with('success', 'Carte supprimée avec succès.');
        }

        abort(403, 'Accès interdit');
    }
}