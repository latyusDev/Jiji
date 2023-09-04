<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $fillable = [
        'addresable_id','addresable_type',
        'state','street','local_government',
    ];


    public function addresable() 
    {
        return $this->morphTo();
    }
}
