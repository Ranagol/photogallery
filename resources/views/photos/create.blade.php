@extends('layouts.app')

@section('content')
<!--
  <h3>Upload photo</h3>
  {!!Form::open(['action' => 'PhotosController@store','method' => 'POST', 'enctype' => 'multipart/form-data'])!!}
    {{Form::text('title','',['placeholder' => 'Photo title'])}}
    {{Form::textarea('description','',['placeholder' => 'Photo description'])}}
    {{Form::hidden('album_id', $album_id)}}
    {{Form::file('photo')}}
    {{Form::submit('submit')}}
  {!! Form::close() !!}
-->

<div class="container">
	<h3>Upload photo {{$album_id}}</h3>
	<form method="POST" action="/photos/store" enctype="multipart/form-data">
		<div class="container">
			@csrf	
			<div class="form-group">
				<label>Photo title</label>
				<input class="form-control" type="text" name="title" placeholder="Photo title">
			</div>

			<div class="form-group">
				<label>Photo description</label>
				<input class="form-control" type="textarea" name="description" placeholder="Photo description">	
			</div>

			<div class="form-group">
				<label>Photo</label>
				<input type="file" class="form-control-file"  name="photo">
			</div>

			<div class="form-group">
				<input type="hidden" name="album_id" value="{{$album_id}}">
			</div>	

			<div class="form-group">
				<input class="btn btn-success" type="submit" name="submit">
			</div>							
		</div>
	</form>
</div>




@endsection