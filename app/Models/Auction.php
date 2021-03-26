<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Auction extends Model
{
    protected $fillable = ['auction_no','venue','date','time'];

    public function lottings()
    {
    	return $this->hasMany(Lotting::class);
    }
}