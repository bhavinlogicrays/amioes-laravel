<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    protected $fillable = ['vendor_id','commission','form_no','lot_no','item_no','quantity','description','reserve','date'];

    public function vendor()
    {
    	return $this->belongsTo(Vendor::class);
    }

    public function lotting()
    {
    	return $this->hasMany(Lotting::class);
    }
}
