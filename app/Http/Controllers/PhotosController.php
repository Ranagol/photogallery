<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Photo;

class PhotosController extends Controller
{
    public function create($album_id){
      return view('photos.create')->with('album_id', $album_id);
    }

    public function store(Request $request){
      $this->validate($request, [
        'title' => 'required',
        'photo' => 'image|max:1999'
      ]);

      // Get filename with extension
      $filenameWithExt = $request->file('photo')->getClientOriginalName();//VALAHOL ITT A PROBLÉMA

      // Get just the filename
      $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);

      // Get extension
      $extension = $request->file('photo')->getClientOriginalExtension();

      // Create new filename
      $filenameToStore = $filename.'_'.time().'.'.$extension;

      // Uplaod image
      $path= $request->file('photo')->storeAs('public/photos/'.$request->input('album_id'), $filenameToStore);

      // Upload Photo
      $photo = new Photo;
      $photo->album_id = $request->input('album_id');
      $photo->title = $request->input('title');
      $photo->description = $request->input('description');
      $photo->size = $request->file('photo')->getClientSize();
      $photo->photo = $filenameToStore;

      $photo->save();

      return redirect('/albums/'.$request->input('album_id'))->with('success', 'Photo Uploaded');
    }

  public function show($id){
    $photo = Photo::find($id);
    return view('photos.show')->with('photo', $photo);
  } 

  public function destroy($id){
    $photo = Photo::find($id);//but, here... we not only want to delete it from the db, we also want to delete this image from our Laravel folder too. For that, we nee this: use Illuminate\Support\Facades\Storage;
    if (Storage::delete('public/photos/' . $photo->album_id . '/' . $photo->photo)) {//this part will actually delete the file. This here: 'public/photos/' . $photo->album_id . '/' . $photo->photo is a way to build up a link, where the file is. So, IF the photo was deleted from the Laravel file system, then...
      $photo->delete();//...delete the photo from the db too.
      return redirect('/')->with('success', 'Photo deleted!');
    }
  }
}
