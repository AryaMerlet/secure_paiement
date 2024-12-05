<?php

namespace App\Http\Controllers;

use App\Repositories\PaiementRepository;
use App\Http\Requests\StorepaiementRequest;
use App\Http\Requests\UpdatepaiementRequest;
use App\Models\Card;
use App\Models\paiement;
use Illuminate\Support\Facades\Auth;

class PaiementController extends Controller
{
    /**
     * Summary of __construct
     * @param \App\Repositories\PaiementRepository $paiementRepository
     */
    public function __construct(protected PaiementRepository $paiementRepository)
    {
        $this->paiementRepository = $paiementRepository;
    }

    /**
     * Summary of index
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function index()
    {
        $user = Auth::user();
        if($user->isan('admin')){
            $paiments = Paiement::with(['users','cards'])->get();
            return view ('paiements.index',compact('paiments','users', 'user'));
        }
        else if ($user->isa('user')){
            $paiments = Paiement::with(['cards'])
            ->where('user_id', $user->id)
            ->get();
            return view ('paiements.index',compact('paiments', 'user'));
        }
        else{
            return redirect()->route('dashboard')->with('error', 'You do not have permission to access this page.');
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::user();

        if(!$user->can('create',Paiement::class)){
            return redirect()->route('paiements.index')->with('error', 'You do not have permission to create new paiements.');
        }
        $cards = Card::where('user_id',$user->id)->get();
        return view('paiement.create', compact('cards'));
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StorepaiementRequest $request)
    {
        $user = Auth::user();
        if ($user->can('create', Paiement::class)) {
            $data = $request->all();
            $this->paiementRepository->store($data);
            return redirect()->route('tickets.index')->with('success', 'Ticket created successfully!');
        } else {
            return redirect()->route('tickets.index')->with('error', 'You do not have permission to create new tickets.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(paiement $paiement)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(paiement $paiement)
    {
        $user = Auth::user();

        if (!$user->can('refund', Paiement::class)) {
            return redirect()->route('paiements.index')->with('error', 'You do not have permission to interact with this paiement.');
        }

        $cards = Card::where('user_id',$user->id)->get();

        return view('paiements.edit', compact('cards','user'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatepaiementRequest $request, paiement $paiement)
    {
        $user = Auth::user();
        if ($user->can('refund', Paiement::class)) {
            $data = $request->all();
            $this->paiementRepository->update($paiement,$data);
            return redirect()->route('tickets.index')->with('success', 'Paiement refunded successfully!');
        } else {
            return redirect()->route('tickets.index')->with('error', 'You do not have permission to refund this paiement.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(paiement $paiement)
    {
        //
    }
}
