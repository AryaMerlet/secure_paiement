<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * 
 *
 * @property int $id
 * @property int $user_id
 * @property int $card_id
 * @property string|null $refunded_amount
 * @property float $price
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Card $card
 * @property-read \App\Models\User $user
 * @method static \Database\Factories\paiementFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|paiement newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|paiement newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|paiement query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|paiement whereCardId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|paiement whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|paiement whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|paiement wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|paiement whereRefundedAmount($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|paiement whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|paiement whereUserId($value)
 * @mixin \Eloquent
 */
class paiement extends Model
{
    /** @use HasFactory<\Database\Factories\PaiementFactory> */
    use HasFactory;

    /**
     * Summary of user
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Summary of card
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function card()
    {
        return $this->belongsTo(Card::class);
    }
}
