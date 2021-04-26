<?php

namespace App\Http\Controllers\Dashboard;

use App\Category;
use App\Comment;
use App\Http\Controllers\Controller;
use App\Job;
use App\Post;
use App\Skill;
use App\Tag;
use App\User;
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
        ->with('posts', Post::orderBy('id', 'DESC')->searched()->simplePaginate(4));
    }

    public function about()
    {
        return view('dashboard.about');
    }

    public function show(Post $post)
    {
        return view('dashboard.show')
            ->with('post',$post);

    }

    public function category(Category $category)
    {
        $search = request()->query('search');
        return view('dashboard.categories')
        ->with('category', $category)
        ->with('search', $search)
        ->with('categories', Category::all())
        ->with('tags',Tag::all())
        ->with('posts', $category->posts()->orderBy('id', 'DESC')->searched()->simplePaginate(4));
    }

    public function tag(Tag $tag)
    {

        $search = request()->query('search');
        return view('dashboard.tags')
        ->with('tag', $tag)
        ->with('search', $search)
        ->with('categories', Category::all())
        ->with('tags',Tag::all())
        ->with('posts', $tag->posts()->orderBy('id', 'DESC')->searched()->simplePaginate(4));
    }

    public function profile(User $user)
    {
        $user = auth()->user();
        // dd($user,auth()->id());
        $posts = Post::all()->where('user_id',$user->id);
        $jobs = Job::all();
        $skills = Skill::all();
        // dd($skills);
        return view('profile.index')
            ->with('user', $user)
            ->with('posts', $posts)
            ->with('jobs', $jobs)
            ->with('skills',$skills);
    }
}
