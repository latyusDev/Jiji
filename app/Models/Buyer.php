<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buyer extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name','email'
    ];
    
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
    public function address()
    {
        return $this->morphMany(Address::class,'addresable');
    }
}
