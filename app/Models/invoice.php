<?php

namespace App\Models;

use App\Http\Controllers\MemberController;
use Illuminate\Database\Eloquent\Model;

class invoice extends Model
{
    //
        protected $guarded = [];

    public function invoice_detail()
    {
        return $this->hasMany(invoice_detail::class,'invoices_id');
    }
    public function member(){
        return $this->belongsTo(member::class,'members_id');
    }
}
