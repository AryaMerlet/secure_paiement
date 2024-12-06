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
        if ($paiement->exists) {
            // if (!isset($paiement['token']) || $paiement->token !== $inputs['token']) {
            //     throw new \Exception('Invalid or missing token for this operation.');
            // } else {
                $paiement->refunded_amount += $inputs['refund_amount'];
            // }
        } else{
                $paiement->price = $inputs['price'];
                $paiement->user_id = $inputs['user_id'];
                $paiement->card_id = $inputs['card_id'];
        }

        $paiement->save();
        return $paiement;
    }
}
