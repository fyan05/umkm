<?php

namespace App\Http\Controllers;

use App\Models\member;
use App\Models\User;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;

class MemberController extends Controller
{
    //
    public function create(){
        $data ['member'] = member::all();
        return view('admin.member-create',$data);
    }
    public function CreateMember(){
        $data ['member'] = member::all();
        return view('registrasi',$data);
    }
    public function store(Request $request){
    $validate = $request->validate([
        'name'=>'required|string',
        'email'=>'required|email',
        'number_phone'=>'required|max:13',
        'birthday' => 'required|date',
        'address'=>'required|string',
        'gender' => 'required|string',
        'level' => 'required|in:Member',
        'password'=>'required',
        'image'=>'image|mimes:png,jpg,jpeg|max:5096',
    ]);
    $Level = 'Member';

    $user = User::create([
        'name'=> $request->name,
        'email'=>$request->email,
        'Level' =>$Level,
        'password'=>bcrypt($request->password)
    ]);
     if($request->hasFile('image')){
            $foto = $request->file('image');
            $filename=time()."-".$request->name.".".$foto->getClientOriginalExtension();
            $foto->storeAs('public/image-member',$filename);
        }

        else{
            $filename="-";
        }
    member::create([
        'name'=>$request->name,
        'number_phone'=>$request->number_phone,
        'address'=>$request->address,
        'birthday' => $request->birthday,
        'gender' => $request->gender,
        'image'=>$filename,
        'users_id' =>$user->id
    ]);
    return redirect()->route('admin.member')->with('Succcess','save Berhasil');
}
    public function regis(Request $request){
    $validate = $request->validate([
        'name'=>'required|string',
        'email'=>'required|email',
        'number_phone'=>'required|max:13',
        'birthday' => 'required|date',
        'address'=>'required|string',
        'gender' => 'required|string',
        'password'=>'required',
        'image'=>'image|mimes:png,jpg,jpeg|max:5096',
    ]);

    $user = User::create([
        'name'=> $request->name,
        'email'=>$request->email,
        'Level'=> 'Member',
        'password'=>bcrypt($request->password)
    ]);
     if($request->hasFile('image')){
            $foto = $request->file('image');
            $filename=time()."-".$request->name.".".$foto->getClientOriginalExtension();
            $foto->storeAs('public/image-member',$filename);
        }

        else{
            $filename="-";
        }
    member::create([
        'name'=>$request->name,
        'number_phone'=>$request->number_phone,
        'address'=>$request->address,
        'birthday' => $request->birthday,
        'gender' => $request->gender,
        'image'=>$filename,
        'users_id' =>$user->id
    ]);
    return redirect()->route('member-login')->with('Succcess','save Berhasil');
}
    public function delete(string $id)
    {
        try {
            $id = Crypt::decrypt($id);
        } catch (DecryptException $e) {
            return redirect()->back()->with('error', 'ID tidak valid.');
        }

        $member = member::find($id);

        if (!$member) {
            return redirect()->back()->with('error', 'Member tidak ditemukan.');
        }

        $member->delete();

        return redirect()->route('admin.member')->with('success', 'Member berhasil dihapus.');
    }

   public function edit(Request $request,String $id)
{
      try {
        $id = Crypt::decrypt($id);
    } catch (DecryptException $e) {
        return redirect()->back()->with('danger', $e->getMessage());
    }

    $data['member'] = member::findOrFail($id);
    return view('admin.member-update', $data);
}

public function update(Request $request, String $id)
{
    try {
            $id = Crypt::decrypt($id);
        } catch (DecryptException $e) {
            return redirect()->back()->with('danger', $e->getMessage());
        }

        $member = Member::findOrFail($id);
        $user = $member->user;

        $filename = $member->image;

    if ($request->hasFile('image')) {
            if (Storage::exists('image-member/' . $member->image)) {
                Storage::delete('image-member/' . $member->image);
            }

            $image = $request->file('image');
            $filename = time() . "-" . $request->name . "." . $image->getClientOriginalExtension();
            $image->storeAs('public/image-member', $filename);
        }
        $member->update([
            'name' => $request->name,
            'number_phone' => $request->number_phone,
            'address' => $request->address,
            'image' => $filename,
            'birthday' => $request->birthday,
        ]);
        $member->save;
         return redirect()->route('admin.member')->with('success', 'Data berhasil diedit');

 }

}
