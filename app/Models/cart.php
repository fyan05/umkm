<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class cart extends Model
{
    //
    protected $guarded=[];

    public  function produk(){
        return $this->belongsTo(produk::class,'produks_id');
       }
    public function member(){
        return $this->belongsTo(member::class,'members_id');
    }
}
