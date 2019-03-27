@extends('layouts.app')
<!--THIS IS SHOWING 1 PHOTO, WHEN WE CLICK ON IT-->

@section('content')
<!--THIS IS FOR SHOWING THE PICTURE-->
	<h3>Photo: {{$photo->title}}</h3>
	<p>Description: {{$photo->description}}</p>
	<a href="/albums/{{$photo->album_id}}">Back to gallery</a>
	<div class="container">
		<img src="/storage/photos/{{$photo->album_id}}/{{$photo->photo}}" alt="{{$photo->title}}" width="1200">
	</div>
	<br>
	


<!--THIS IS FOR DELETING THE PICTURE-->
	{!!Form::open(['action' => ['PhotosController@destroy', $photo->id], 'method' => 'POST'])!!}
    {{Form::hidden('_method', 'DELETE')}}
    {{Form::submit('Delete photo', ['class' => 'btn btn-danger'])}}
  {!!Form::close()!!}
  <hr>
  <small>Size: {{$photo->size}} bytes</small>
@endsection