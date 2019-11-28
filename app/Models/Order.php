<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Class Order
 *
 * @property int id
 * @property int buyer_id
 * @property int owner_id
 * @property string name
 * @property string session_id
 * @property string number
 * @property integer total
 * @property string phone
 * @property string email
 * @property \Illuminate\Support\Carbon $ordered_at
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property User owner
 * @property User buyer
 *
 * @package App\Models
 */
class Order extends Model
{
    public $timestamps = true;


    public function owner() : BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_id');
    }
    public function buyer() : BelongsTo
    {
        return $this->belongsTo(User::class, 'buyer_id');
    }
}
