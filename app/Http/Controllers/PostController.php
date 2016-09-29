<?php

namespace App\Http\Controllers;

use App\Description;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Post;
use App\Category;
use Session;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $descriptions = Description::where('lang_id', 1)->get();

        return view('posts.index')->withDescriptions($descriptions);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();

        return view('posts.create')->withCategories($categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,array(
            'title_en' => 'required|max:255',
            'title_ua' => 'required|max:255',
            'slug' => 'required|alpha_dash|max:255',
            'category_id' => 'required|integer',
            'body_en' => 'required',
        ));

        $post = new Post();
        $description = new Description();

        $post->slug = $request->slug;
        $post->category_id = $request->category_id;

        $post->save();

        $description->title = $request->title_en;
        $description->body = $request->body_en;
        $description->lang_id = 1;
        $description->post_id = $post->id;

        $description->save();

        $description = new Description();
        $description->title = $request->title_ua;
        if(empty($request->body_ua)){
            $description->body = 'Переклад відсутній';
        }else{
            $description->body = $request->body_ua;
        }
        $description->lang_id = 2;
        $description->post_id = $post->id;

        $description->save();

        return redirect()->route('posts.show',$post->id);
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
        $descriptions = Description::where('post_id',$id)->get();

        return view('posts.show')->withPost($post)->withDescriptions($descriptions);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post = Post::find($id);
        $categories = Category::all();

        $description_en = Description::where('post_id',$id)->where('lang_id', 1)->first();
        $description_ua = Description::where('post_id',$id)->where('lang_id', 2)->first();


        $cats =[];
        foreach($categories as $category){
            $cats[$category->id] = $category->name;
        }

        return view('posts.edit')->withPost($post)->withCategories($cats)->withDescription_en($description_en)->withDescription_ua($description_ua);
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
        $post = Post::find($id);

        if($request->input('slug') == $post->slug){
            $this->validate($request,[
                'title_en' => 'required|max:255',
                'title_ua' => 'required|max:255',
                'category_id' => 'required|integer',
                'body_en' => 'required'
            ]);
        }else {
            $this->validate($request, array(
                'title_en' => 'required|max:255',
                'title_ua' => 'required|max:255',
                'category_id' => 'required|integer',
                'slug' => 'required|alpha_dash|max:255|unique:posts,slug',
                'body_en' => 'required'
            ));
        }
        $post->category_id = $request->input('category_id');
        $post->slug = $request->input('slug');

        $post->save();

        $description = Description::where('post_id',$id)->where('lang_id', 1)->first();
        $description->body = $request->input('body_en');
        $description->title = $request->input('title_en');
        $description->save();

        $description2 = Description::where('post_id',$id)->where('lang_id', 2)->first();
        $description2->title = $request->input('title_ua');
        if(empty($request->body_ua)){
            $description2->body = 'Переклад відсутній';
        }else{
            $description2->body = $request->input('body_en');
        }

        $description2->save();


        Session::flash('success', 'This post was successfully saved.');

        return redirect()->route('posts.show', $post->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        $description_en = Description::where('post_id',$id)->where('lang_id', 1)->first();
        $description_ua = Description::where('post_id',$id)->where('lang_id', 2)->first();

        $description_en->delete();

        $description_ua->delete();
        $post->delete();

        Session::flash('success', 'The post was successfully deleted.');
        return redirect()->route('posts.index');
    }
}
