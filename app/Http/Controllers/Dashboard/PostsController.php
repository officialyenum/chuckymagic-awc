<?php

namespace App\Http\Controllers\Dashboard;

use App\Category;
use App\Http\Controllers\Controller;
use App\Post;
use App\Tag;
use Illuminate\Http\Request;

class PostsController extends Controller
{

    public function index()
    {
        $search = request()->query('search');
        return view('dashboard.index')
        ->with('search', $search)
        ->with('categories', Category::all())
        ->with('tags',Tag::all())
        ->with('posts', Post::searched()->simplePaginate(4));
    }

    public function show(Post $post)
    {
        return view('dashboard.show')->with('post',$post);
    }

    public function category(Category $category)
    {
        $search = request()->query('search');
        return view('dashboard.categories')
        ->with('category', $category)
        ->with('search', $search)
        ->with('categories', Category::all())
        ->with('tags',Tag::all())
        ->with('posts', $category->posts()->searched()->simplePaginate(4));
    }

    public function tag(Tag $tag)
    {

        $search = request()->query('search');
        return view('dashboard.tags')
        ->with('tag', $tag)
        ->with('search', $search)
        ->with('categories', Category::all())
        ->with('tags',Tag::all())
        ->with('posts', $tag->posts()->searched()->simplePaginate(4));
    }
}
