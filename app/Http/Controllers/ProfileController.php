<?php

namespace App\Http\Controllers;

use App\User;
use Auth;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        $title = 'Profile';
        return view('profile.edit',compact('user','title'));
    }

    public function update(Request $request)
    {
        $this->validate($request,[
            'confirm' => 'required_with:password'
        ]);
        $user = User::find(Auth::id());
        $user->email = $request->email;
        if($request->password){
            $user->password = bcrypt($request->password);
        }
        $user->save();
        return redirect('profile');
    }
}
