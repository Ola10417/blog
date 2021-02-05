<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rating;
use App\Models\Post;

class RatingController extends Controller
{
    public function index()
    {
        return Rating::all();
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'user'=>'required',
            'post_id'=>'required',
            'points'=>'required|numeric|in:2,1,-1'
        ]);
        if(Rating::where('user',$request->user)->where('post_id', $request->post_id)->doesntExist())
        {
            $newrating=new Rating();
            $newrating->user=$request->user;
            $newrating->post_id=$request->post_id;
            $newrating->points=$request->points;
            $newrating->save();
            $post=Post::findOrFail($request->post_id);
            $post->popularity+=$request->points;
            $post->save();
        }
        
        return ['message' => 'Dziękujemy za opinię!!'];
    }
}
