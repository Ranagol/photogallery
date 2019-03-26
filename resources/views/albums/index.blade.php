@extends('layouts.app')

@section('content')<!-- NOTE: THE GRID SYSTEM WITH THIS FOUNDATION BULLSHIT IS NOT WORKING!!!-->
  @if(count($albums) > 0)<!--here we are checking if there are any albums... -->
    <?php
      $colcount = count($albums);//here we are counting how many albums do we have 
  	  $i = 1;//this is just an iterator we will compare this with the $colcount later
    ?>
    <div id="albums">
      <div class="row text-center"><!--and this is our first row with the albums -->
        @foreach($albums as $album)
          @if($i == $colcount)<!--if there is only 1 album, do this here -->
             <div class='medium-4 columns end'>
               <a href="/albums/{{$album->id}}"><!--link to the actual album -->
                  <img class="thumbnail" src="storage/album_covers/{{$album->cover_image}}" alt="{{$album->name}}"><!--link to the image -->
                </a>
               <br>
               <h4>{{$album->name}}</h4>
          @else<!--if there are more than 1 albums... do this -->
            <div class='medium-4 columns'>
              <a href="/albums/{{$album->id}}">
                <img class="thumbnail" src="storage/album_covers/{{$album->cover_image}}" alt="{{$album->name}}">
              </a>
              <br>
              <h4>{{$album->name}}</h4>
          @endif
        	@if($i % 3 == 0)<!--...and if there is 3 or 6 or 9 albums, then do this...-->
          </div></div><div class="row text-center">
        	@else
            </div>
          @endif
        	<?php $i++; ?>
        @endforeach
      </div>
    </div>
  @else
    <p>No Albums To Display</p><!--If there are no albums, this will be displayed -->
  @endif

@endsection