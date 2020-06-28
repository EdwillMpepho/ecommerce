<?php

namespace App;
use App\User;
use App\Truck;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = ['name','price','quantity','truckid','user_id'];
    /**
     * create a relationship between cart and user
     */
    public function user() {
        return $this->belongsTo('App\User');
    }
    /**
     * create a relationship between cart and truck
     */
    public function truck() {
        return $this->belongsTo('App\Truck');
    }
}
