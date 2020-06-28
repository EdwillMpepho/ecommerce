<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Cart;

class Truck extends Model
{
    protected $fillable = ['name','engine','transimssion','power','price','image'];

    /**
     * create a relationship between cart and truck
     */
    public function cart() {
        return $this->belongsTo('App\Cart');
    }

}
