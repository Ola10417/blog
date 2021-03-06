<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Post::latest()->paginate(6);
    }

    public function all()
    {
        return Post::all();
    }

    public function getPopularPosts()
    {
        $posts=Post::orderBy('popularity','desc')->take(10)->get();
        return $posts;
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
            $this->authorize('create', Post::class);
            $this->validate($request,[
                'title'=>'required|string|max:255',
                'body'=>'required'
            ]);
            $post=new Post();
            $post->title=$request->title;
            $post->body=$request->body;
            $post->save();
            
            return ['message' => 'Wpis został dodany'];
       
        

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Post::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->validate($request,[
            'title'=>'required|string|max:255',
            'body'=>'required'
        ]);

        $post=Post::find($id);
        
        $this->authorize('update', $post);
        $post->title=$request->title;
        $post->body=$request->body;
        $post->save();

        
        return ['message' => 'Wpis został edytowany'];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post=Post::find($id);
        
        $this->authorize('delete', $post);
        $post->delete();
        return ['message' => 'Wpis został usunięty'];
    }
}
