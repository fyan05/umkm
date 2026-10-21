<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class CategoryController extends Controller
{
    //
        public function index(){
        $data ['category'] = Category::all();
        return view('category',$data);
    }
    public function create(){
        $data ['category'] = Category::all();
        return view('admin.category-tambah',$data);
    }
    public function store(Request $request){
        $validate =$request->validate([
            'name' => 'required|max:30|string',
        ]);
        Category::create($validate);
        return redirect()->route('admin.category')->with('success','seved data successfull');
    }
    public function delete(string $id){
        try{
            $id = Crypt::decrypt($id);
        }catch (DecryptException $e){
            return redirect()->back();
        } $category = Category::find($id);

        $category->delete();
        return redirect()->back()->with('succes','program');
    }
    public function edit(string $id){
        try{
            $id = Crypt::decrypt($id);
        }catch (DecryptException $e){
            return redirect()->back()->with('danger',$e->getMessage());
        }

        $data['category']=Category::find($id);
        return view('admin.category-edit',$data);
    }
    public function update(Request $request, string $id){
        try{
            $id = Crypt::decrypt($id);
        }catch(DecryptException $e){
            return redirect()->back()->with('danger',$e->getMessage());
        }

        $validate = $request->validate([
            'name' => 'required|max:30|string',
        ]);

        $category = Category::find($id);

        $category->update($validate);
        return redirect()->route('admin.category')->with('succes','program');
    }

}
