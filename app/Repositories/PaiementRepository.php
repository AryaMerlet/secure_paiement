<?php

namespace App\Repositories;

use App\Models\Paiement;
use Str;

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
        if (isset($inputs['price'])) {
            $paiement->price = $inputs['price'];
        }
        if (isset($inputs['user_id'])) {
            $paiement->user_id = $inputs['user_id'];
        }
        if (isset($inputs['card_id'])) {
            $paiement->card_id = $inputs['card_id'];
        }
        if (isset($inputs['refund_amount'])) {
            $paiement->refunded_amount = ($paiement->refunded_amount ?? 0) + $inputs['refund_amount'];
        }
        // $paiement->price = $inputs['price'];
        // $paiement->user_id = $inputs['user_id'];
        // $paiement->card_id = $inputs['card_id'];
        // $paiement->refunded_amount = ($paiement->refunded_amount ?? 0) + $inputs['refund_amount'];

        $paiement->save();
        return $paiement;
    }
}
