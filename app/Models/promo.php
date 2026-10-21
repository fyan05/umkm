<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class promo extends Model
{
    //
    protected $guarded= [];
    protected $casts = [
    'start_date' => 'datetime',
    'end_date' => 'datetime',
];
public function produk()
{
    return $this->belongsTo(Produk::class, 'produks_id');
}
}
