<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_id','name','price',
        'description','image','is_sold',
        'quantity',
    ];

    public function scopeFilter($query,$id)
    {
        return $query->whereId($id);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function decreaseAvailableQuantity($item,$quantity):void
    {
        $this->filter($item->id)
             ->update(['quantity'=>$item->quantity - $quantity]);
        if($item->quantity == 1){
            $this->filter($item->id)
                 ->update(['is_sold'=>true]);
        }
    }

}
