<?php

namespace App\Http\Controllers;

use App\Http\Requests\Users\UpdateAvatarRequest;
use App\Http\Requests\Users\UpdateHeaderRequest;
use App\Http\Requests\Users\UpdateProfileRequest;
use App\Media;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UsersController extends Controller
{
    public function index()
    {
        $user = auth()->user;
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

    public function updateAvatar(UpdateAvatarRequest $request, User $user)
    {
        dd($request);
        $image = $request->file('avatar')->store(
            'posts',
            's3'
        );
        //set Image Visibility private
        //Storage::disk('s3')->setVisibility($image,'private');
        //set Image Visibility public
        Storage::disk('s3')->setVisibility($image,'public');// create the post

        $media = new Media;
        $media->mimeType = $request->mimeType;
        $media->image = basename($image);
        $media->url = Storage::disk('s3')->url($image);
        $media->user_id = $user->id;
        $media->save();

        $user->avatar = $media->url;
        $user->save();

        // return response()->json([
        //     'message' => 'Profile Avatar updated successfully',
        //     'status' => 'success',
        //     'data' => $request
        // ]);

        session()->flash('success','Profile Avatar updated successfully');
        return redirect()->route('profile.index');
    }

    public function updateHeader(UpdateHeaderRequest $request, User $user)
    {
        dd($request);
        $image = $request->file('header_image')->store(
            'posts',
            's3'
        );
        //set Image Visibility private
        //Storage::disk('s3')->setVisibility($image,'private');
        //set Image Visibility public
        // Storage::disk('s3')->setVisibility($image,'public');// create the post

        $media = new Media;
        $media->mimeType = $request->mimeType;
        $media->image = basename($image);
        $media->url = Storage::disk('s3')->url($image);
        $media->user_id = $user->id;
        $media->save();

        $user->header_image = $media->url;
        $user->save();

        session()->flash('success','Profile Header Image updated successfully');
        return redirect()->route('profile.index');
    }

    public function edit()
    {
        return view('users.edit')->with('user',auth()->user());
    }

    public function update(UpdateProfileRequest $request)
    {
        $user = auth()->user();
        $user->update([
            'username' => $request->username,
            'location' => $request->location,
            'education' => $request->education,
            'bio' => $request->bio,
            'job_id' => $request->job_id,
        ]);

        session()->flash('success','User Profile Updated Successfully');
        return redirect()->route('profile.index');
    }
}
