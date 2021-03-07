<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Post;
use App\Tag;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        return view('admin.index')
            ->with('user',$user)
            ->with('posts', Post::all())
            ->with('users', User::all())
            ->with('categories', Category::all())
            ->with('tags', Tag::all());
    }
}
