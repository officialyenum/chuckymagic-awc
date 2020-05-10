<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\Posts\CreatePostsRequest;
use App\Http\Requests\Posts\UpdatePostsRequest;
use App\Post;
use App\Tag;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class PostsController extends Controller
{

    public function __construct()
    {
        $this->middleware('verifyCategoriesCount')->only(['create','store']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('posts.index')->with('posts', Post::paginate(10))->with('user', Auth::user());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create')->with('categories', Category::all())->with('tags', Tag::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePostsRequest $request)
    {
        // upload the image
        //$extension = $request->image->extension();
        //$image = Storage::putFileAs('posts', $request->image, time().'.'.$extension);
        $image = $request->image->store(
            'posts',
            'do'
        );
        //set Image Visibility private
        //Storage::disk('s3')->setVisibility($image,'private');
        //set Image Visibility public
        //Storage::disk('s3')->setVisibility($image,'public');
        // create the post
        $post = Post::Create([
            'title' => $request->title,
            'description'=> $request->description,
            'content' => $request->content,
            'published_at' => $request->published_at,
            'category_id' => $request->category,
            'user_id' => auth()->user()->id,
            'image' => basename($image),
            'imageUrl' => Storage::disk('do')->url($image)
        ]);

        if ($request->tags) {
            $post->tags()->attach($request->tags);
        }

        // flash the message
        session()->flash('success', 'Post created successfully');

        // redirect the user
        return redirect(route('posts.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('posts.create')->with('post',$post)->with('categories',Category::all())->with('tags',Tag::all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostsRequest $request, Post $post)
    {
        $data = $request->only(['title','description','content','published_at']);
        //check if new image
        if ($request->hasFile('image')) {
            //if new image upload it
            $image = $request->image->store(
                'posts',
                'do'
            );
            //delete old image
            $post->deleteImage();
            //update image data to be submitted
            $data['image'] = basename($image);
            $data['imageUrl'] = Storage::disk('do')->url($image);
        }

        if ($request->tags) {
            $post->tags()->sync($request->tags);
        }

        //update data attributes
        $post->update($data);

        //flash message
        session()->flash('success', 'Post Updated Successfully');

        //redirect user
        return redirect(route('posts.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::withTrashed()->where('id',$id)->firstOrFail();

        if ($post->trashed())
        {
            $post->deleteImage();
            $post->forceDelete();
        }
        else
        {
            $post->delete();
        }

        session()->flash('success', 'Post deleted successfully');
        return redirect(route('posts.index'));
    }

    /**
     * Display a list of all trashed posts
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function trashed()
    {
        $trashed = Post::onlyTrashed()->get();

        return view('posts.index')->with('posts',$trashed);
    }

    public function restore($id)
    {
        $post = Post::withTrashed()->where('id',$id)->firstOrFail();

        $post->restore();

        session()->flash('success', 'Post restored successfully');
        return redirect(route('posts.index'));
    }
}
