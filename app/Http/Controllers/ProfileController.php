<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use App\User;
use Illuminate\Support\Facades\Cache;


class ProfileController extends Controller
{
    public function show(User $user){
        $follows = (auth()->user()) ? auth()->user()->following->contains($user->profile->id) : false;
       $postsCount = Cache::remember(
            'count.posts.' . $user->id,
            now()->addSeconds(30),
            function () use ($user) {
                return $user->posts->count();
            });
        $followersCount = Cache::remember(
            'count.followers.' . $user->id,
            now()->addSeconds(30),
            function () use ($user) {
                return $user->profile->followers->count();
            });
        $followingCount = Cache::remember(
            'count.following.' . $user->id,
            now()->addSeconds(30),
            function () use ($user) {
                return $user->following->count();
            });
    	return view('profiles.show', compact('user','follows','postsCount','followersCount','followingCount'));
    }
    public function edit( User $user){
        
        $this->authorize('update',$user->profile);
        
         return view('profiles.edit', compact('user'));
    }

    public function update(User $user){

    	$this->authorize('update',$user->profile);
    	$data = request()->validate([
         'title'=>'required',
         'description'=>'required',
         'url'=>'required|url',
         'image'=>'sometimes|image|max:3000'
    	]);
        if(request('image')){
            $imagePath= request('image')->store('uploads','public');
        $image= Image::make(public_path("/storage/{$imagePath}"))->fit(800,800);
        $image->save();
        auth()->user()->profile->update(array_merge(
         $data,
         ['image'=>$imagePath]

        ));

        }else{
    	auth()->user()->profile->update($data);
    }
    	return redirect()->route('profiles.show',['user'=>$user]);
    }
  
}
