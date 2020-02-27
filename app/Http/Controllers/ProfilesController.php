<?php

namespace App\Http\Controllers;

use App\Http\Requests\ValidateProfile;
use Illuminate\Http\Request;
use Illuminate\Auth;

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


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        //
    }


    public function update(ValidateProfile $request)
    {
        $user = auth()->user();
        $user->fill([
            'phone' => $request['phone'],
            'address' => $request['address'],
            'about' => $request['about'],
            'birthday' => $request['birthday']]);
        if ($request->has('new-password')) {
            $user->password = bcrypt($request->password);
        }
        $user->update();

        return back()->with(['message' => 'Your profile was successfully updated!']);

    }


    public function destroy($id)
    {
        //
    }
}
