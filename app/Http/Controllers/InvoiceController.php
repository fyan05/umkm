<?php

namespace App\Http\Controllers;

use App\Models\invoice;
use App\Models\invoice_detail;
use App\Models\member;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;

class InvoiceController extends Controller
{
    //
        public function payment(String $id){
        try{
            $id = Crypt::decrypt($id);
        }catch (DecryptException $e){
            return redirect('/');
        }
        $data['invoice']=invoice::where('no_invoice',$id)->first();
        return view('payment',$data);
    }

    public function index(){
            $data['invoice'] = invoice::where('members_id',Auth::user()->member->id)->get();
            return view('invoice',$data);
    }
    public function admin(){
            $data['invoice'] = invoice::get();
            return view('admin.invoice-admin',$data);
    }

    public function confirm(Request $request,string $id){
        try{
            $id = Crypt::decrypt($id);
        }catch(DecryptException $e){
            return redirect()->back()->with('danger',$e->getMessage());
        }

        $validate = $request->validate([
            'proof' => 'image|mimes:jpg,jpeg,png|max:3072'
        ]);

        $invoice = invoice::where('no_invoice',$id)->first();

        if($request->hasFile('proof')){

            if(storage::exists('invoices/'.$invoice->proof)){
                Storage::delete('invoices/'.$invoice->proof);
            }

            $image = $request->file('proof');
            $filename = time()."-".$request->name."-".$image->getClientOriginalExtension();
            $image -> storeAs('public/invoices',$filename);

            $validate['proof'] = $filename;
        }
        $invoice->update($validate);

        return redirect('/');
    }
    public function update(Request $request,String $id){
        try{
            $id = Crypt::decrypt($id);
        }catch (DecryptException $e){
            return redirect()->back();
        }

        Invoice::where('no_invoice',$id)->update([
            'status' => $request->status
        ]);
        return redirect()->back();
    }
    public function Detail() {
        $memberId = Auth::user()->member->id;

        $invoiceIds = Invoice::where('members_id', $memberId)->pluck('id');

        $data['invoice'] = invoice_detail::with('produk')
            ->whereIn('invoices_id', $invoiceIds)
            ->get();

        return view('invoice-detail', $data);
    }
    public function admin_invoice(){
        $data ['member'] = member::all();
        $data ['invoices'] = invoice::all();
        $data ['invoice'] = invoice_detail::all();
        return view('admin.invoice-detail-admin',$data);
    }

}
