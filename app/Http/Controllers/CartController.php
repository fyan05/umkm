<?php

namespace App\Http\Controllers;

use App\Models\cart;
use App\Models\invoice;
use App\Models\invoice_detail;
use App\Models\produk;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class CartController extends Controller
{
    //
        public function index(){

        $data ['cart'] = cart::where('members_id',Auth::user()->member->id)->get();
        return view('cart',$data);
    }

    public function store(Request $request,String $id){
     try{
            $id = Crypt::decrypt($id);
        }catch(DecryptException $e){
            return redirect()->back();
        }
    $produk = Produk::find($id);
    $member_id = Auth::user()->member->id;
    $existingCart = Cart::where('members_id', $member_id)
                        ->where('produks_id', $id)
                        ->first();

    if ($existingCart) {
        $existingCart->qty += 1;
        $existingCart->save();
    } else {
        Cart::updateOrCreate([
            'members_id' => $member_id,
            'produks_id' => $id,
        ],
        [
            'price' => $produk->price,
            'qty' => 1
        ]);
    }
    return redirect('/cart')->with('success', 'Produk berhasil ditambahkan ke keranjang.');

    }

    public function checkout(){
        $cart = cart::where('members_id', Auth::user()->member->id)->get();
        if ($cart->count() > 0){
            $invoice = invoice::create([
                'no_invoice' => date('Ymdhis') . sprintf('%08d', Auth::user()->member->id),
                'expired_date' => Carbon::now()->addDays(2),
                'status' => '0',
                'proof' =>'-',
                'members_id' => Auth::user()->member->id
            ]);

            foreach ($cart as $item) {
                invoice_detail::create([
                    'produks_id' => $item->produks_id,
                    'price' => $item->price,
                    'qty' =>$item->qty,
                    'invoices_id' =>$invoice->id
                ]);
                cart::find($item->id)->delete();
            }
            return redirect('payment/' .Crypt::encrypt($invoice->no_invoice));
        }
    }
       public function delete(string $id){
        try{
            $id = Crypt::decrypt($id);
        }catch (DecryptException $e){
            return redirect()->back();
        } $cart = Cart::find($id);

        $cart->delete();
        return redirect()->route('cart')->with('succes','program');
    }
    public function addPromoToCart($id, $discount)
{
    try {
        $id = Crypt::decrypt($id);
    } catch (DecryptException $e) {
        return redirect()->back();
    }

     $user = Auth::user();

    if (!$user || !$user->member) {
        return redirect()->back()->with('error', 'Data member tidak ditemukan.');
    }

    $produk = Produk::find($id);

    if (!$produk) {
        return redirect()->back()->with('error', 'Produk tidak ditemukan.');
    }
    $member_id = Auth::user()->member->id;

    $diskon = $discount / 100;
    $hargaSetelahDiskon = $produk->price - ($produk->price * $diskon);

    $existingCart = Cart::where('members_id', $member_id)
                        ->where('produks_id', $id)
                        ->first();

    if ($existingCart) {
        $existingCart->qty += 1;
        $existingCart->save();
    } else {
        Cart::updateOrCreate(
            [
                'members_id' => $member_id,
                'produks_id' => $id,
            ],
            [
                'price' => $hargaSetelahDiskon,
                'qty' => 1
            ]
        );
    }

    return redirect('/cart')->with('success', 'Produk promo berhasil ditambahkan ke keranjang.');
}


}
