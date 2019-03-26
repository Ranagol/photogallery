@extends('layouts.app')

@section('content')
<!--
  <h3>Create Album</h3>
  {!!Form::open(['action' => 'AlbumsController@store','method' => 'POST', 'enctype' => 'multipart/form-data'])!!}
    {{Form::text('name','',['placeholder' => 'Album Name'])}}
    {{Form::textarea('description','',['placeholder' => 'Album Description'])}}
    {{Form::file('cover_image')}}
    {{Form::submit('submit')}}
  {!! Form::close() !!}
-->
<div class="container">
	<h3>Create new album</h3>
	<form method="POST" action="/albums/store" enctype="multipart/form-data">
		@csrf
		<div class="container">
			<div class="form-group">
				<label>Album name</label>
				<input class="form-control" type="text" name="name" placeholder="Album name">
			</div>

			<div class="form-group">
				<label>Album description</label>
				<input class="form-control" type="textarea" name="description" placeholder="Album description">
			</div>

			<div class="form-group">
				<label>Album cover image</label>
			<input class="form-control-file" type="file" name="cover_image">	
			</div>

			<div class="form-group">
				
				<input class="btn btn-success" type="submit" name="submit">
			</div>
		</div>
	</form>
</div>
	

@endsection