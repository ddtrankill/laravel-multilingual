<?php

namespace App\Http\Controllers;


use App\Http\Requests;
use App\Post;
use Session;
use App;

class PagesController extends Controller
{
    public function __construct()
    {
        if(empty(Session::get('locale'))){
            App::setLocale('en');
        }
    }


    public function getIndex(){
        $posts = Post::orderBy('created_at', 'desc')->limit(4)->get();
        return view('pages.welcome')->withPosts($posts);
    }
}
