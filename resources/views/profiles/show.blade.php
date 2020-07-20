@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row mt-4 ">
        <div class="col-4 text-center">
            <img src="{{$user->profile->getImage()}}" class="rounded-circle" width="125px" height="125px">
        </div>
        <div class="col-8">
       <div class="d-flex align-items-baseline">
           <div class="h4 mr-3 pt-2">{{$user->username}}</div>
         <follow-button profile-id="{{$user->profile->id}}" follows="{{$follows}}"></follow-button>
       </div>
       <div class="d-flex mt-3">
           <div class="mr-3"><strong>{{$postsCount}}</strong> publications</div>
           <div class="mr-3"><strong>{{ $followersCount}}</strong> abonnés</div>
           <div class="mr-3"><strong>{{ $followingCount }}</strong> abonnements </div>
       </div>
       @can('update',$user->profile)
    
       <a href="{{ route('profiles.edit', ['user'=> $user]) }}" class="btn btn-outline-secondary mt-3"> Editer mon profile
       </a>
       @endcan
       <div class="mt-3">
           <div class="font-weight-bold">{{$user->profile->title}}</div>
           <div>{{$user->profile->description}}</div>
           <a href="{{$user->profile->url}}">{{$user->profile->url}}</a>
       </div>
       </div>
    </div>
    <div class="row mt-5">
      @foreach($user->posts as $post)
        <div class="col-4">
            <a href="{{route('posts.show',['post'=> $post->id])}}"><img src="{{asset('storage').'/'. $post->image}}" class="w-100 h-100" ></a>
        </div>
        @endforeach
       
</div>
</div>
@endsection
