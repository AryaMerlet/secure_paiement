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
     * Summary of index
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
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
    }

    /**
     * Summary of create
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
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
     * Summary of store
     * @param \App\Http\Requests\StoreCardRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(StoreCardRequest $request)
    {
        $user = Auth::user();
        if (!$user->can('create', Card::class)) {
            return redirect()->route('cards.index')->with('error', 'You do not have permission to create new cards.');
        } else {
            $card = new Card($request->validated());
            $card->user_id = $user->id;
            $card->save();
            return redirect()->route('cards.index')->with('success', 'Card created successfully.');
        }
    }

    /**
     * Summary of show
     * @param \App\Models\Card $card
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function show(Card $card)
    {
        $user = Auth::user();
        if ($user->isA('admin') ||$card->user_id == $user->id){
            return view('cards.show', compact('card'));
        } else{
            return redirect()->route('cards.index')->with('error', 'You do not have permission to access this page.');
        }
    }

    /**
     * Summary of edit
     * @param \App\Models\Card $card
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function edit(Card $card)
    {
        $user = Auth::user();
        if ($user->isA('admin') || $card->user_id === $user->id) {
            return view('cards.edit', compact('card'));
        } else {
            return redirect()->route('cards.index')->with('error', 'You do not have permission to access this page.');
        }
    }

    /**
     * Summary of update
     * @param \App\Http\Requests\UpdateCardRequest $request
     * @param \App\Models\Card $card
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateCardRequest $request, Card $card)
    {
        $user = Auth::user();
        if ($card->user_id === $user->id) {
            $card->update($request->validated());
            return redirect()->route('cards.index')->with('success', 'Card updated successfully');
        }else{
            return redirect()->route('cards.index')->with('error', 'You do not have permission to access this page.');
        }
    }

    /**
     * Summary of destroy
     * @param \App\Models\Card $card
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Card $card)
    {
        $user = Auth::user();
        if ($card->user_id === $user->id) {
            $card->delete();
            return redirect()->route('cards.index')->with('success', 'Card deleted successfully');
        }else{
            return redirect()->route('cards.index')->with('error', 'You do not have permission to access this page.');
        }
    }
}