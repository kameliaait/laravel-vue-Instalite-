@extends('layouts.app')
@section('content')
<div class="container">
	<div class="row">
	  <div class="col-4"> 

	  	<img src="{{asset('storage').'/'.$post->image}}" class="w-100">
	  </div>
	  <div class="col-4">
	  	<h3>{{$post->user->username}}</h3>
	  	<small>{{$post->caption}}</small>
	  
	  	    
	  </div>
	  <div class="col-4">
	  	
	  </div>
   </div>
</div>
@endsection