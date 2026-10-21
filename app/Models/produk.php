<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class produk extends Model
{
    //
    protected $guarded = [];
        public function category(){
        return $this->belongsTo(Category::class, 'categories_id',);
    }

    public function cart(){
        return $this->hasMany(cart::class, 'produks_id');
    }
    public function promo(){
        return $this->hasMany(cart::class,'produks_id');
    }
    public function orders()
    {
        return $this->belongsToMany(Order::class)
                    ->withPivot('quantity', 'price')
                    ->withTimestamps();
    }
        public function invoicedetail(){
        return $this->hasMany(invoice_detail::class,'produks_id');
    }
}
