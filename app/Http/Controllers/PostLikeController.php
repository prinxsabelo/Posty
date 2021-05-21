<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Mail\PostLiked;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

class PostLikeController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware(['auth']);
    }
    public function store($id, Request $request)
    {
       
        $post = Post::find($id);
        //If already liked by user.. reutrn ..
        if($post->likedBy($request->user()))
        {
            return response(null,409);
        }
        $post->likes()->create([
            'user_id' => $request->user()->id,
        ]);
        if(!$post->likes()->onlyTrashed()->where('user_id',$request->user()->id)->count()){
            Mail::to($post->user)->send(new PostLiked(auth()->user(), $post));
        }
        return back();
    } 
    public function destroy($post_id, Request $request)
    {
        $request->user()->likes()->where('post_id',$post_id)->delete();
        return back();
    }
}
