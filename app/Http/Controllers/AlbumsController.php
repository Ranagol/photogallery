<?php

namespace App\Http\Controllers;

use App\Album;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AlbumsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $albums = Album::with('Photos')->get(); // we can do this Album::with('Photos') because there is a relationship between the Album and the Photo model.
        

        
        return view('albums.index')->with('albums', $albums);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('albums.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'cover_image' => 'image|max:1999'
        ]);
        $filenameWithExt = $request->file('cover_image')->getClientOriginalName();//this is the filename with the file extension

        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);//this will be just the filename, without extension

        $extension = $request->file('cover_image')->getClientOriginalExtension(); //here we want to get the file extension. The file extension will be without '.' so, we will see 'jpg' instead of '.jpg'

        $filenameToStore = $filename . '_' . time() . '.' . $extension; //we need to create a new filename, never just leave the file with the clients original name. We will use the original name + time uploaded + extension. We want to store this file under this name.

        $path = $request->file('cover_image')->storeAs('public/album_covers', $filenameToStore);//Take this file, save it into this folder, under this name. If there is no album_covers folder, Laravel will create that for us. This all will be in storage\app\public. BUT. We don't want the user to have acces to this place. Customer can have acces only to the public\storage folder. So, we have to link the storage\app\public to the public\storage folder. We can do this simply in artisan with this command: php artisan storage:link  . This way, the uploaded picture will be in both places (but the customer will have acces only to the public\storage)

        //create album
        $album = new Album;
        $album->name = $request->input('name');
        $album->description = $request->input('description');
        $album->cover_image = $filenameToStore;
        $album->save();
        return redirect('/albums')->with('success', 'Album created!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function show(Album $album, $id)
    {
        $album = Album::with('Photos')->find($id); // we can do this Album::with('Photos') because there is a relationship between the Album and the Photo model. Right here we are sending the Photos model too to the view. That is good, because we want to display all the photos belonging to this album.

        return view('albums.show')->with('album', $album);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function edit(Album $album)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Album $album)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $album = Album::find($id);
        
        if (Storage::delete('public/album_covers/'  . $album->cover_image)) {
            $album->delete();
            return redirect('/')->with('success', 'Album deleted!');
        }
        
        
    }
}
