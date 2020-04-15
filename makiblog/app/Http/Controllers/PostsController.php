<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Post;
use App\Category;
use App\Tag;
use App\User;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Post\CreatePostsRequest;
use App\Http\Requests\Post\UpdatePostsRequest;

class PostsController extends Controller
{

    public function __construct()
    {
        $this->middleware('verifyCategoriesCount')->only(['create', 'store']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->paginate(5);
        return view('posts.index')->with('posts', $posts);
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
        if($request->hasFile('featured')){
            $filenameWithExt=$request->file('featured')->getClientOriginalName();

            $filename=pathInfo($filenameWithExt, PATHINFO_FILENAME);

            $extension=$request->file('featured')->getClientOriginalExtension();

            $fileNameToStore=$filename.'_'.time().'.'.$extension;

            $path=$request->file('featured')->storeAs('public/cover_images', $fileNameToStore);
        }else {
            $filenameToStore='noimage.jpg';
        }

        $post=new Post;
        $post->title=$request->input('title');
        $post->content=$request->input('content');
        $post->category_id=$request->input('category');
        $post->featured=$fileNameToStore;
        $post->user_id = auth()->user()->id;
        $post->save();

        if($request->tags){
            $post->tags()->attach($request->tags);  
        }

        return redirect('/posts')->with('success', 'Uspesno ste kreirali post');    
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $post = Post::find($id);
        return view('posts.show')->with('post', $post);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        if(auth()->user()->id !== $post->user_id){
            return redirect(route('posts.index'))->with('error', 'Unauthorize page');
        }
        return view('posts.create')->with('post', $post)->with('categories', Category::all())->with('tags', Tag::all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostsRequest $request, $id)
    {
        if($request->hasFile('featured')){
            $filenameWithExt=$request->file('featured')->getClientOriginalName();

            $filename=pathInfo($filenameWithExt, PATHINFO_FILENAME);

            $extension=$request->file('featured')->getClientOriginalExtension();

            $fileNameToStore=$filename.'_'.time().'.'.$extension;

            $path=$request->file('featured')->storeAs('public/cover_images', $fileNameToStore);
        }

        $post = Post::find($id);
        $post->title = $request ->input('title');
        $post->content=$request->input('content');
        $post->category_id=$request->input('category');
        if($request->hasFile('featured')){
            Storage::delete('public/cover_images/'.$post->featured);
            $post->featured=$fileNameToStore; 
        } 
        if($request->tags){
            $post->tags()->sync($request->tags);
        }
        $post->save();

        return redirect(route('posts.index'))->with('success', 'Uspesno ste promenili post '. $post->title);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post=Post::withTrashed()->where('id', $id)->firstOrFail();
        if(auth()->user()->id !== $post->user_id){
            return redirect(route('posts.index'))->with('error', 'Unauthorize page');
        }

        if($post->trashed()){
            $post->forceDelete();
            Storage::delete('public/cover_images/'.$post->featured);
        }else{
            $post->delete();
        }
        
        
        return redirect(route('posts.index'))->with('success', 'Uspesno ste obrisali post ' . $post->title);
        
    }

    /**
     * Display a list of all trashed posts
     *
     * @return \Illuminate\Http\Response
     */
    public function trashed()
    {
        $trashed=Post::onlyTrashed()->get();

        return view('posts.index')->withPosts($trashed);
    }

    public function restore($id)
    {
        $post=Post::withTrashed()->where('id', $id)->firstOrFail();
        $post->restore();

        return redirect(route('posts.index'))->with('success', 'Uspesno ste vratili post ' . $post->title);
    }

}
