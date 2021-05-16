<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\Posts\CreatePostsRequest;
use App\Http\Requests\Posts\UpdatePostsRequest;
use App\Job;
use App\Media;
use App\Post;
use App\Tag;
use App\User;
use Carbon\Carbon;
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
        return view('admin.posts.index')->with('posts', Post::orderBy('id', 'DESC')->paginate(10))
        ->with('user', Auth::user())
        ->with('categories', Category::all())
        ->with('tags', Tag::all())
        ->with('jobs', Job::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('posts.create')
            ->with('categories', Category::all())
            ->with('tags', Tag::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePostsRequest $request)
    {
        // dd($request->file('image')->getClientOriginalExtension(),time());
        $image = $request->file('image');
        $imageFileName = $image->getClientOriginalName();
        $s3 = Storage::disk('s3');
        $filePath = '/awc/uploads/'.time().$imageFileName;

        $s3->put($filePath, file_get_contents($image), 'public');
        // $image = $request->file('image')->store(
        //     'posts',
        //     's3'
        // );
        $media = new Media;
        $media->mimeType = $request->file('image')->getMimeType();
        $media->image = $request->file('image')->getClientOriginalName();
        $media->url = $s3->url($filePath);
        //set Image Visibility private
        //Storage::disk('s3')->setVisibility($image,'private');
        //set Image Visibility public
        // Storage::disk('s3')->setVisibility($image,'public');// create the post
        $slug = str_slug($request->title);
        $slugExists = Post::where('slug', '=' ,str_slug($request->title))->exists();
        if($slugExists){
            $slug = str_slug($request->title) . str_random(3);
        }
        $post = Post::Create([
            'title' => $request->title,
            'slug' => $slug,
            'description'=> $request->description,
            'content' => 'no content',
            'published_at' => Carbon::parse($request->published_at),
            'event_day' => Carbon::parse($request->event_day),
            'category_id' => $request->category,
            'user_id' => auth()->user()->id,
            'image' => basename($image),
            'imageUrl' => $s3->url($filePath)
        ]);
        $post->save();
        $media->post_id = $post->id;
        $media->user_id = Auth::id();
        $media->save();

        // upload the image
        $detail = $request->content;
        libxml_use_internal_errors(true);
        $dom = new \DOMDocument();
        $dom->loadHtml($detail, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $images = $dom->getElementsByTagName('img');

        foreach ($images as $count => $image) {
            $src = $image->getAttribute('src');
            if (preg_match('/data:image/', $src)) {
                preg_match('/data:image\/(?<mime>.*?)\;/', $src, $groups);
                $mimeType = $groups['mime'];
                $path = '/awc/uploads/'.time() .'/' . uniqid('', true) . '.' . $mimeType;
                $pathExists = Media::where('url', '=' ,$path)->exists();
                if(!$pathExists){
                    $s3->put($path, file_get_contents($src), 'public');
                    $image->removeAttribute('src');
                    $image->setAttribute('src', Storage::disk('s3')->url($path));
                    $contentMedia = new Media;
                    $contentMedia->mimeType = $mimeType;
                    $contentMedia->image = $path;
                    $contentMedia->url = $s3->url($path);
                    $contentMedia->post_id = $post->id;
                    $contentMedia->user_id = Auth::id();
                    $contentMedia->save();
                }
            }
        }

        $detail = $dom->savehtml();
        $post->content = $detail;
        $post->save();

        if ($request->tags) {
            $post->tags()->attach($request->tags);
        }

        // flash the message
        session()->flash('success', 'Post created successfully');
        session()->flash('alert-class', 'alert-success');

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
        return view('posts.create')->with('post',$post)
            ->with('categories',Category::all())
            ->with('tags',Tag::all());
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
        $detail = $post->content;
        //check if new image
        if ($request->hasFile('image')) {
            //if new image upload it
            $image = $request->image->store(
                'posts',
                's3'
            );
            //delete old image
            $post->deleteImage();
            //update image data to be submitted
            $post['image'] = basename($image);
            $post['imageUrl'] = Storage::disk('s3')->url($image);
        }

        //if content changes
        if($post->content != $request->content){
            $medias = Media::all()->where('post_id',$post->id);
            if($medias){
                //delete all images affiliated with content both on server and in database
                foreach ($medias as $count => $media) {
                    $media->deleteImage();
                    $media->delete();
                }
            }
            // upload the new images
            $detail = $request->content;
            libxml_use_internal_errors(true);
            $dom = new \DOMDocument();
            $dom->loadHtml($detail, LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
            $images = $dom->getElementsByTagName('img');

            foreach ($images as $count => $image) {
                $src = $image->getAttribute('src');
                if (preg_match('/data:image/', $src)) {
                    preg_match('/data:image\/(?<mime>.*?)\;/', $src, $groups);
                    $mimeType = $groups['mime'];
                    $path = '/posts/' . uniqid('', true) . '.' . $mimeType;
                    Storage::disk('s3')->put($path, file_get_contents($src));
                    $image->removeAttribute('src');
                    $image->setAttribute('src', Storage::disk('s3')->url($path));
                    $media = new Media;
                    $media->mimeType = $mimeType;
                    $media->image = $path;
                    $media->url = Storage::disk('s3')->url($path);
                    $media->post_id = $post->id;
                    $media->save();
                }
            }
        }

        //update post data attributes
        $post->title = $request->title;
        $post->slug = str_slug($request->title);
        $post->description = $request->description;
        $post->content = $detail;
        $post->published_at = Carbon::parse($request->published_at);
        $post->event_day = Carbon::parse($request->event_day);
        $post->category_id = $request->category;
        $post->save();
        //if new tags sync
        if ($request->tags) {
            $post->tags()->sync($request->tags);
        }

        //flash message
        session()->flash('success', 'Post Updated Successfully');
        session()->flash('alert-class', 'alert-success');

        //redirect user
        return redirect(route('posts.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $post = Post::withTrashed()->where('slug',$slug)->firstOrFail();

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
        session()->flash('alert-class', 'alert-danger');
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

        return view('admin.posts.index')
            ->with('posts',$trashed)
            ->with('user', Auth::user())
            ->with('categories', Category::all())
            ->with('tags', Tag::all());
    }

    public function restore($slug)
    {
        $post = Post::withTrashed()->where('slug',$slug)->firstOrFail();

        $post->restore();

        session()->flash('success', 'Post restored successfully');
        session()->flash('alert-class', 'alert-success');
        return redirect(route('posts.index'));
    }
}
