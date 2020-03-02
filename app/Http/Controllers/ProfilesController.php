<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidateNewPassword;
use App\Http\Requests\ValidateProfile;
use Illuminate\Support\Facades\Hash;

class ProfilesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('users.profile')->with('user', auth()->user());
    }


    public function update(ValidateProfile $request)
    {
        $user = auth()->user();
        $user->fill([
            'phone' => $request['phone'],
            'address' => $request['address'],
            'about' => $request['about'],
            'birthday' => $request['birthday']]);
        $user->update();

        return back()->with(['message' => 'Your profile was successfully updated!']);

    }


    public function changePasswordForm()
    {
        return view('users.change-password')->with('user', auth()->user());
    }


    public function changePassword(ValidateNewPassword $request)
    {
        if (!(Hash::check($request->get('current-password'), auth()->user()->password))) {
            return back()->withErrors(['Your current password does not match with entered password!']);
        }
        if (strcmp($request->get('current-password'), $request->get('new-password')) == 0) {

            return back()->withErrors(['Your current password cannot be same as new password!']);
        }

        auth()->user()->password = bcrypt($request->get('new-password'));
        auth()->user()->save();

        return back()->with(['message' => 'Your password was successfully changed!']);
    }

}
