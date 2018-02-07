<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = \Auth::user();
        return view('profile.form', compact('user'));
    }

    public function update(Request $request)
    {
        $user = \Auth::user();
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
            'password' => 'nullable|string|min:6',
        ]);

        $user->name = $request->input('name');
        $user->photo = $request->file('photo');
        $user->email = $request->input('email');

        if($request->input('password')) {
            $user->password = bcrypt($request->input('password'));
        }

        $user->save();
        
        return redirect('/');
    }
}
