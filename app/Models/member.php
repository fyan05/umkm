<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class member extends Model
{
    //
     protected $guarded = [];
    public function user(){
        return $this->belongsTo(User::class,'users_id');
    }
    public function cart(){
        return $this->hasMany(cart::class,'members_id');
    }
    public function invoice(){
        return $this->hasMany(invoice::class,'members_id');
    }
}
