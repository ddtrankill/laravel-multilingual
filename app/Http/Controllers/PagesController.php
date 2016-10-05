<?php

namespace App\Http\Controllers;


use App\Http\Requests;
use App\Post;
use Session;

class PagesController extends Controller
{
    public function getIndex(){
        $posts = Post::orderBy('created_at', 'desc')->limit(4)->get();
        return view('pages.welcome')->withPosts($posts);
    }
}
