<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\produk;
use App\Models\member;
use App\Models\order;
use App\Models\promo;
use Illuminate\Http\Request;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Crypt;

class AdminController extends Controller
{
    //
    public function dashboard()
{
    $totalProducts = produk::count();
    $totalCategories = Category::count();
    $todayOrders = order::whereDate('created_at', today())->count();


    $chartLabels = ['Sen', 'Sel', 'Rab', 'Kam', 'Jum', 'Sab', 'Min'];
    $chartData = [5, 8, 6, 10, 12, 7, 4];

    return view('admin.dashboard-admin', compact(
        'totalProducts',
        'totalCategories',
        'todayOrders',
        'chartLabels',
        'chartData'
    ));

}
 public function produk(){
        $data['produk'] = Produk::orderBy('created_at','desc')->get();
        return view('admin.produk-admin',$data);
    }
public function category(String $id = null){
        if($id != null ){
            try {
                $id = Crypt::decrypt($id);
            }catch(DecryptException $e) {
                return redirect()->back()->with('error',$e->getMessage());
            }
            $data['category']= category::find($id);
            $data['route']= route('admin.category.update',Crypt::encrypt($id));
        }else
        {
            $data['route']= route('admin.category.post');
        }
        $data['category'] = category::orderBy('name')->get();
        return view('admin.category-admin',$data);
    }
        public function member(){
        $data['members'] = member::orderBy('name')->get();
        return view('admin.member-admin',$data);
    }


        public function promo(){
        $data['promo'] = promo::all();
        return view('admin.promo-admin', $data);
    }
}
