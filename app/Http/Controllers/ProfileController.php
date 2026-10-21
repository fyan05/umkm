<?php

namespace App\Http\Controllers;

use App\Models\member;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    //
    public function edit(Request $request,String $id)
{
      try {
        $id = Crypt::decrypt($id);
    } catch (DecryptException $e) {
        return redirect()->back()->with('danger', $e->getMessage());
    }

    $data['member'] = member::findOrFail($id);
    return view('profile-edit', $data);
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
         return redirect()->route('profile')->with('success', 'Data berhasil diedit');

 }
 public function index()
{
    $member = member::where('users_id', Auth::id())->firstOrFail();
    return view('profile', compact('member'));
}

}
