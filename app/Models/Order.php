<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'seller_id','buyer_id',
        'item_id','quantity'
    ];

    public function buyer()
    {
        return $this->belongsTo(Buyer::class);
    }

    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
