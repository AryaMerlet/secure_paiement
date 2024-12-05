<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 *
 *
 * @property int $id
 * @property int $App\Models\User
 * @property int $App\Models\Card
 * @property string $type
 * @property string $stripe_id
 * @property string $stripe_status
 * @property string|null $stripe_price
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\paiementFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|paiement newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|paiement newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|paiement query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|paiement whereApp\Models\Card($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|paiement whereApp\Models\User($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|paiement whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|paiement whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|paiement whereStripeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|paiement whereStripePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|paiement whereStripeStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|paiement whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|paiement whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class paiement extends Model
{
    /** @use HasFactory<\Database\Factories\PaiementFactory> */
    use HasFactory;

    /**
     * Summary of user
     * @return void
     */
    function user(){
        $this->belongsTo(User::class);
    }

    /**
     * Summary of card
     * @return void
     */
    function card(){
        $this->belongsTo(Card::class);
    }
}
