<?php

namespace App\Repositories;

use App\Models\Paiement;

class PaiementRepository
{
    /**
     * Summary of paiement
     * @var Paiement
     */
    protected $paiement;

    /**
     * Summary of __construct
     * @param \App\Models\Paiement $paiement
     */
    public function __construct(Paiement $paiement)
    {
        $this->paiement = $paiement;
    }

    /**
     * Summary of store
     *
     * @param  array<string, mixed>  $inputs
     *
     * @return Paiement
     */
    public function store(array $inputs)
    {
        $paiement = new paiement();
        return $this->save($paiement, $inputs);
    }

    /**
     * Summary of update
     *
     * @param  array<string, mixed>  $inputs
     *
     * @return Paiement
     */
    public function update(Paiement $paiement, array $inputs)
    {
        return $this->save($paiement, $inputs);
    }

    /**
     * Summary of save
     *
     * @param  array<string, mixed>  $inputs
     *
     * @return Paiement
     */
    private function save(Paiement $paiement, array $inputs)
    {
        $paiement->type = $inputs['type'];
        $paiement->stripe_id = $inputs['stripe_id'];
        $paiement->stripe_status = $inputs['stripe_status'];
        $paiement->stripe_price = $inputs['stripe_price'];
        $paiement->user_id = $inputs['user_id'];
        $paiement->card_id = $inputs['card_id'];
        $paiement->save();
        return $paiement;
    }
}
