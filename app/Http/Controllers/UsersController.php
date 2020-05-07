<?php

namespace App\Http\Controllers;

use App\Http\Requests\Users\UpdateProfileRequest;
use App\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function index()
    {
        return view('users.index')->with('users', User::all());
    }

    public function makeWriter(User $user)
    {
        $user->role = 'writer';
        $user->save();
        session()->flash('success','User made Admin Successfully');
        return redirect()->route('users.index');
    }

    public function makeAdmin(User $user)
    {
        $user->role = 'admin';
        $user->save();
        session()->flash('success','User made Admin Successfully');
        return redirect()->route('users.index');
    }

    public function makeSuperAdmin(User $user)
    {
        $user->role = 'superadmin';
        $user->save();
        session()->flash('success','User made Admin Successfully');
        return redirect()->route('users.index');

    }

    public function removeWriter(User $user)
    {
        $user->role = 'guest';
        $user->save();
        session()->flash('success','User made Admin Successfully');
        return redirect()->route('users.index');
    }

    public function removeAdmin(User $user)
    {
        $user->role = 'writer';
        $user->save();
        session()->flash('success','User Admin priviledge Successfully removed');
        return redirect()->route('users.index');
    }

    public function removeSuperAdmin(User $user)
    {
        $user->role = 'writer';
        $user->save();
        session()->flash('success','User Super Admin priviledge Successfully removed');
        return redirect()->route('users.index');

    }

    public function edit()
    {
        return view('users.edit')->with('user',auth()->user());
    }

    public function update(UpdateProfileRequest $request)
    {
        $user = auth()->user();
        $user->update([
            'name' => $request->name,
            'about' => $request->about
        ]);
        session()->flash('success','User Profile Updated Successfully');
        return redirect()->back();
    }
}
