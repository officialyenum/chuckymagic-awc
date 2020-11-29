<?php

namespace App\Http\Controllers\Admin;

use App\Category;
use App\Http\Controllers\Controller;
use App\Post;
use App\Tag;
use App\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.index')
            ->with('posts', Post::all())
            ->with('users', User::all())
            ->with('categories', Category::all())
            ->with('tags', Tag::all());
    }
}
