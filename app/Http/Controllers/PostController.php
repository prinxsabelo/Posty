<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth'])->only(['store','destroy']);
    }
    public function index()
    {
              // $posts = Post::paginate(20); 
        $posts = Post::orderBy('created_at','desc')->with('user','likes')->paginate(20);  
        // SAME AS SHOWN BELOW
        $posts = Post::latest()->with('user','likes')->paginate(20);  
        // return json_encode($posts);
        
        return view('posts.index', [ 
            'posts'=> $posts
        ]);
    }
    public function show(Post $post)
    {
        return view('posts.show',[
            'post' => $post
        ]);
    }
    public function store(Request $request)
    {   
       
        $this->validate($request,[
            'body' => 'required'
        ]);
        // Post::create([ 
        //     // 'user_id' => auth()->user()->id         OR      'user_id' => auth()->id(),
        //     'user_id' => auth()->id(),
        //     'body' => $request->body
        // ]);
         // auth()->user()->posts()->create([
            // 'body' => $request->body
        // ])
        // $request->user()->posts()->create([
        //     'body' => $request->body
        // ]);
        $request->user()->posts()->create($request->only('body'));
        return back();
    }
    public function destroy(Post $post)
    {
        // Since PostPolicy exists already..
        $this->authorize('delete',$post);
        // if(!$post->ownedBy(auth()->user))
        // {
        //     dd('unauthorized..');
        // }
        $post->delete();
        return back();
    }
}
