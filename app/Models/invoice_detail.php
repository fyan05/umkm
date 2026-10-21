<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class invoice_detail extends Model
{
    //
        protected $guarded = [];

    public function invoice()
    {
        return $this->belongsTo(invoice::class,'invoices_id');
    }
    public function produk()
    {
        return $this->belongsTo(produk::class,'produks_id');
    }
}
