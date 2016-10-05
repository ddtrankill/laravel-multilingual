<?php

namespace App\Http\Controllers;


use App\Http\Requests;
use Session;
use App\Post;
use App\Description;

class BlogController extends Controller
{

    public function getIndex(){
        $posts = Post::paginate(10);
        $descriptions = Description::paginate(10)->where('lang_id', Session::get('language'));

        return view('blog.index')->withPosts($posts)->withDescriptions($descriptions);
    }

    public function getSingle($slug){
        $post = Post::where('slug', '=', $slug)->first();
        $descriptions = Description::where('post_id',$post->id)->get();

        return view('blog.single')->withPost($post)->withDescriptions($descriptions);
    }
}
//