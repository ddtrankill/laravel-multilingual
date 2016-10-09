<?php

namespace App\Http\Controllers;


use App\Http\Requests;
use App\Description;
use App\Post;
use Session;

class BlogController extends Controller
{

    public function getIndex(){
        $posts = Post::paginate(10);
        $descriptions = Description::paginate(10)->where('lang_id', Session::get('language'));

        return view('blog.index')->withPosts($posts)->withDescriptions($descriptions);
    }

    public function getSingle($slug){
        $post = Post::where('slug', '=', $slug)->first();
        $description = Description::where('post_id',$post->id)->where('lang_id', Session::get('language'))->first();

        return view('blog.single')->withPost($post)->withDescription($description);
    }
}
//