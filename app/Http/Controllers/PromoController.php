<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\produk;
use App\Models\promo;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;

class PromoController extends Controller
{
    //
    public function index(){
    $promos = Promo::with('produk')->whereHas('produk')->get();
    return view('promo', compact('promos'));
    }

    public function create()
    {
        $products = produk::all();
        return view('admin.promo-create', compact('products'));
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'title' => 'required|max:50|string',
            'discount' => 'required|numeric|min:0',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'image' => 'required|image|mimes:jpg,png,jpeg,webp|max:3072',
            'produks_id' => 'required|exists:produks,id'
        ]);

        $image = $request->file('image');
        $fileName = time() . "-" . $request->name . "." . $image->getClientOriginalExtension();
        $image->storeAs('public/image-promo', $fileName);
        $validate['image'] = $fileName;

        Promo::create($validate);

        return redirect()->route('admin-promo')->with('success', 'Promo berhasil ditambah');
    }

    public function edit(string $id)
    {
        try {
            $id = Crypt::decrypt($id);
        } catch (DecryptException $e) {
            return redirect()->back();
        }

        $data['promo'] = Promo::findOrFail($id);
        return view('admin.promo-update', $data);
    }

    public function update(Request $request, string $id)
    {
        try {
            $id = Crypt::decrypt($id);
        } catch (DecryptException $e) {
            return redirect()->back();
        }

        $validate = $request->validate([
            'title' => 'required|max:50|string',
            'discount' => 'required|numeric|min:0',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
            'image' => 'nullable|image|mimes:jpg,png,jpeg,webp|max:3072',
        ]);

        $promo = Promo::findOrFail($id);

        if ($request->hasFile('image')) {
            if (Storage::exists('public/image-promo/' . $promo->image)) {
                Storage::delete('public/image-promo/' . $promo->image);
            }

            $image = $request->file('image');
            $fileName = time() . "-" . $request->name . "." . $image->getClientOriginalExtension();
            $image->storeAs('public/image-promo', $fileName);
            $validate['image'] = $fileName;
        }

        $promo->update($validate);

        return redirect()->route('admin-promo')->with('success', 'Promo berhasil diupdate');
    }

    public function delete(string $id)
    {
        try {
            $id = Crypt::decrypt($id);
        } catch (DecryptException $e) {
            return redirect()->back();
        }

        $promo = Promo::findOrFail($id);

        if (Storage::exists('public/image-promo/' . $promo->image)) {
            Storage::delete('public/image-promo/' . $promo->image);
        }

        $promo->delete();

        return redirect()->route('admin-promo')->with('success', 'Promo berhasil dihapus');
    }
}
