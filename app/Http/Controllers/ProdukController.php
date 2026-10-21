<?php

namespace App\Http\Controllers;

use App\Models\produk;
use App\Models\Category;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;

class ProdukController extends Controller
{
    //
public function index()
{

    $data['produk'] = produk::all();
     return view('produk',$data);
}
public function detail($id)
{
     try{
            $id = $decrypted = Crypt::decrypt($id);
        }
        catch(DecryptException $e){
            return redirect()->back();
        }
    $produk = Produk::findOrFail($id);
    return view('produk-detail', compact('produk',));
}

    public function create(){
        $data['category'] = Category::all();
        return view('admin.produk-create',$data);
    }

    public function store(Request $request){
       $validate = $request->validate([
            'name' => 'required|max:50|string',
            'price' => 'required|min:0|',
            'description' => 'required',
            'categories_id' => 'required',
            'image' => 'required|image|mimes:jpg,png,jpeg,webp|max:3072'
         ]);
         $image = $request->file('image');
         $FileName = time()."-".$request->name.".".$image->getClientOriginalExtension();
         $image->storeAs('public/image-product',$FileName);
         $validate['image'] = $FileName;

         Produk::create($validate);

         return redirect()->route('admin-produk')->with('success', 'Data berhasil ditambah');

        }
    public function delete(String $id){
        try{
            $id = $decrypted = Crypt::decrypt($id);
        }
        catch(DecryptException $e){
            return redirect()->back();
        }
        $produk =Produk::find($id);
        if(storage::exists('image/'.$produk->image)){
            storage::delete(('image/'.$produk->image));
        }
        $produk->delete();
        return redirect()->route('admin-produk')->with('success','Deleted data Berhasil');
    }
    public function edit(String $id)
{
    try {
        $id = Crypt::decrypt($id);
    } catch (DecryptException $e) {
        return redirect()->back();
    }

    $produk = Produk::findOrFail($id);
    $data['produk'] = $produk;
    $data['category'] = Category::all();

    return view('admin.produk-update', $data);
}
public function asin(Request $request){
    $produk = produk::all();
    $data['produk'] = $produk;

    return view('category-asin',$data);
}
public function manis(Request $request){
    $produk = produk::all();
    $data['produk'] = $produk;

    return view('category-manis',$data);
}
public function update(Request $request, String $id)
{
    try {
        $id = Crypt::decrypt($id);
    } catch (DecryptException $e) {
        return redirect()->back();
    }

    $validate = $request->validate([
        'name' => 'required|max:50|string',
        'price' => 'required|min:0|numeric',
        'description' => 'required',
        'categories_id' => 'required|exists:categories,id',
        'image' => 'nullable|image|mimes:jpg,png|max:3072',
    ]);

    $produk = produk::findOrFail($id);

    if ($request->hasFile('image')) {
        if (storage::exists('image-product' . $produk->image)) {
            storage::delete('image-product' . $produk->image);
        }

        $image = $request->file('image');
        $fileName = time() . "." . $image->getClientOriginalExtension();
        $image->storeAs('public/image-product', $fileName);
        $validate['image'] = $fileName;
    }

    $produk->update($validate);

    return redirect()->route('admin-produk')->with('success', 'Data berhasil diupdate');
}

}
