<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Http\Requests\UpdateProfileRequest;

class UsersController extends Controller
{
    public function index()
    {
        return view('users.index')->with('users',User::all());
    }

    public function edit()
    {
        return view('users.edit')->with('user',auth()->user());
    }

    public function update(UpdateProfileRequest $request)
    {
        $user = auth()->user();

        $user->update([
            'name'=> $request->name,
            'about'=> $request->about
        ]);
        session()->flash('sucs','User profile is updated successfully.');
        return redirect()->back();


    } 
    

    public function makeAdmin(User $user)
    {
        $user->role = 'admin';
        $user->save();
        session()->flash('sucs','User is promoted to admin successfully.');
        return redirect(route('users.index'));
    }
}
