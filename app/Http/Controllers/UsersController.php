<?php

namespace App\Http\Controllers;

use App\Http\Requests\Users\UpdateProfileRequest;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UsersController extends Controller
{
    public function index()
    {
        return view('admin.users.index')->with('users', User::all());
    }

    public function makeWriter(User $user)
    {
        $user->role_id = 3;
        $user->save();
        session()->flash('success','User made Admin Successfully');
        return redirect()->route('users.index');
    }

    public function makeAdmin(User $user)
    {
        $user->role_id = 2;
        $user->save();
        session()->flash('success','User made Admin Successfully');
        return redirect()->route('users.index');
    }

    public function makeSuperAdmin(User $user)
    {
        $user->role_id = 1;
        $user->save();
        session()->flash('success','User made Admin Successfully');
        return redirect()->route('users.index');

    }

    public function removeWriter(User $user)
    {
        $user->role_id = 4;
        $user->save();
        session()->flash('success','User made Admin Successfully');
        return redirect()->route('users.index');
    }

    public function removeAdmin(User $user)
    {
        $user->role_id = 3;
        $user->save();
        session()->flash('success','User Admin priviledge Successfully removed');
        return redirect()->route('users.index');
    }

    public function removeSuperAdmin(User $user)
    {
        if ($user->id == 10000001) {
            session()->flash('success',"You don\'t remove God, Chucky magic is supreme here");
            return redirect()->route('users.index');
        }
        $user->role_id = 2;
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

        $avatar = '';
        $header_image = '';
        if ($request->hasFile('avatar')) {
            //if new image upload it
            $avatar = $request->file('avatar')->store(
                'users',
                's3'
            );
            //delete old image
            if ($user->avatar) {
                $user->deleteAvatarImage();
            }
        } else {
            $avatar = $request->file('avatar')->store(
                'users',
                's3'
            );
            if ($user->avatar) {
                $user->deleteAvatarImage();
            }
        };
        if ($request->hasFile('header_image')) {
            //if new image upload it
            $avatar = $request->file('avatar')->store(
                'users',
                's3'
            );
            //delete old image
            if($user->header_image){
                $user->deleteHeaderImage();
            }
        } else {
            $header_image = $request->file('header_image')->store(
                'users',
                's3'
            );
            if($user->header_image){
                $user->deleteHeaderImage();
            }
        };
        $user = auth()->user();
        $user->update([
            'username' => $request->username,
            'avatar' => Storage::disk('s3')->url($avatar),
            'header_image' => Storage::disk('s3')->url($header_image),
            'location' => $request->location,
            'education' => $request->education,
            'bio' => $request->bio,
            'job_id' => $request->job_id,
        ]);
        session()->flash('success','User Profile Updated Successfully');
        return redirect()->back();
    }
}
