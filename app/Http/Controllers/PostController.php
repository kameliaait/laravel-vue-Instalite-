<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use App\Post;
use Iluminate\Support\Facades\Auth;
use Iluminate\Support\Facades\Session;

class PostController extends Controller
{
   
    public function __construct(){

    	$this->middleware('auth');
    }
    public function create(){
    	return view('posts.create');
    }
    public function store(){
    	$data=request()->validate([
    		'caption'=>['required','string'],
            'image'=>['required','image']
    	]);
    	$imagePath= request('image')->store('uploads','public');
        $image= Image::make(public_path("/storage/{$imagePath}"))->fit(1200,1200);
        $image->save();
    	auth()->user()->posts()->create([
    		'caption'=>$data['caption'],
    		'image'=>$imagePath

    	]);
    	return redirect()->route('profiles.show',['user'=>auth()->user()]);
    }
    public function show(Post $post){
    	return view('posts.show',compact('post'));
    }
    public function index(){
        $user = auth()->user()->following->pluck('user_id');
        $posts = Post::whereIn('user_id',$user)->with('user')->latest()->paginate(5);
        return view('posts.index',compact('posts'));
    }

  
}
