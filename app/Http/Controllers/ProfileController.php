<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests\ProfileUpdateRequest;
use App\Users;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public  function index(){

        $user = auth()->user();

       return view('profile.profile', [
           'user' => $user
       ]);
    }

    public function update(ProfileUpdateRequest $request){

        $user = Users::find(auth()->id());
        $request->file('image')? $this->uploadimage($request) : '' ;


        $user->update([
            'name'       => $request->name,
            'mobile'     => $request->mobile,
            'role'       => $request->role,
            'email'      => $request->email,
            'birthday'   => $request->birthdate,
            'about'      => $request->about,
            'image'      => $request->file('image') ? $request->image->getClientOriginalName() : ''
        ]);

       return redirect()->back()->with('success', 'Profile is updated successfully');
    }

    public  function  uploadimage(Request $request){

        $user = Users::find(auth()->id());
        if($request->hasFile('image')) {

            ($user->image) ? Storage::delete('public/images/'.$user->image) : '';

            $filename = $request->file('image')->getClientOriginalName() ;
            $request->file('image')->storeAs('images', $filename, 'public');
        }

    }
}
