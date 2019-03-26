@extends('layouts.app')

@section('content')
  <h1>{{$album->name}}</h1>
  <a class="button secondary" href="/">Go Back</a>
  <a class="button" href="/photos/create/{{$album->id}}">Upload Photo To Album</a>
  <hr>

 @if(count($album->photos) > 0)<!--here we are checking if there are any photos... -->
    <?php
      $colcount = count($album->photos);//here we are counting how many photos do we have 
  	  $i = 1;//this is just an iterator we will compare this with the $colcount later
    ?>
    <div class="container" id="photos">
      <div class="row"><!--and this is our first row with the photos -->
        @foreach($album->photos as $photo)
          @if($i == $colcount)<!--if there is only 1 photo, do this here -->
             <div class='col'>
               <a href="/photos/{{$photo->id}}"><!--link to the actual photo -->
                  <img class="img-thumbnail" src="/storage/photos/{{$photo->album_id}}/{{$photo->photo}}" alt="{{$photo->title}}"><!--link to the image -->
                </a>
               <br>
               <h4>{{$photo->title}}</h4>
          @else<!--if there are more than 1 photos... do this -->
            <div class='col'>
              <a href="/photos/{{$photo->id}}"><!--link to the actual photo -->
                  <img class="img-thumbnail" src="/storage/photos/{{$photo->album_id}}/{{$photo->photo}}" alt="{{$photo->title}}"><!--link to the image -->
                </a>
               <br>
               <h4>{{$photo->title}}</h4>
          @endif
        	@if($i % 3 == 0)<!--...and if there is 3 or 6 or 9 albums, then do this...-->
          </div>
        </div>
        <div class="row">
        	@else
            </div>
          @endif
        	<?php $i++; ?>
        @endforeach
      </div>
    </div>
  @else
    <p>No photos to display</p><!--If there are no albums, this will be displayed -->
  @endif

@endsection
