<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class order extends Model
{
    //
    protected $guarded=[];
   public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function products()
    {
        return $this->belongsToMany(produk::class)
                    ->withPivot('quantity', 'price')
                    ->withTimestamps();
    }

    // Total item
    public function getTotalItemsAttribute()
    {
        return $this->produk->sum('pivot.quantity');
    }

    // Total harga
    public function getTotalPriceAttribute()
    {
        return $this->produk->sum(function ($product) {
            return $product->pivot->price * $product->pivot->quantity;
        });
    }

}
