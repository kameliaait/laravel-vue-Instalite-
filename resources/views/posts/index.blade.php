@extends('layouts.app')
@section('content')
<div class="container">
	@foreach ($posts as $post)
	<div class="row mb-5">
	<div class="col-6 offset-3">
		 <a href="{{route('posts.show',['post'=> $post->id] )}}"><img src="{{asset('storage').'/'. $post->image}}" class="w-100 h-100" >
</a>
		 <div class="mt-2">
		 	Posté par <strong>{{$post->user->username}}</strong> le {{$post->created_at->format('d/m/Y')}}
		 	@php
		 	$like_count = 0;
		 	$dislike_count = 0;
		 	@endphp
		 	@foreach($post->likes as $like)
		 	@php
		 	if($like->like == 1){
		 	$like_count++;
		 }
		 if($like->like == 0){
		 $dislike_count++;
		}
		 	@endphp
		 	@endforeach
		 	<button type="button" class="btn btn-success">Like<b>{{$like_count}}</b> <i class="far fa-thumbs-up"></i></button>
		 	<button type="button" class="btn btn-danger">Dislike<b>{{$dislike_count}} </b><i class="far fa-thumbs-down"></i></button>


		 	
		 </div>
		

	</div>
    </div>
@endforeach
<div class="col-12">
<div class="row d-flex justify-content-center">
	{{$posts->links()}}
</div>
</div>
</div>

@endsection
