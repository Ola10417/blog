<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rating;

class RatingController extends Controller
{
    public function index()
    {
        return Rating::all();
    }

    public function store(Request $request)
    {
        $rating=new Rating();
        $rating->user=$request->user;
        $rating->post_id=$request->post_id;
        $rating->points=$request->points;
        $rating->save();
        return ['message' => 'Dziękujemy za opinię!!'];
    }
}
