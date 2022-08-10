<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class AlbumController extends Controller
{
    // show all albums
    public function index(){
        $checkwriter = false;
        $checkadmin = false;
        if(auth()->user() != null){
            $checkwriter = auth()->user()->roles()->where('name', 'admin')->exists();
            if($checkwriter == false){
            $checkwriter = auth()->user()->roles()->where('name', 'writer')->exists();
            }
            // dd(auth()->user()->roles()->Where('name','writer')->exists());
            // dd($check);
        }
        if(auth()->user() != null){
            $checkadmin = auth()->user()->roles()->where('name','admin')->exists();
        }
        //dd($checkadmin);
        $test = true;
        return view('albums.index', [
            'albums'                => Album::latest()->filter(request(['tag','search','label','date']))->paginate(10),
            'checkadminwriter'      => $checkwriter,
            'checkadmin'             => $checkadmin,
        ]);
    }
    // show single album
    public function show(Album $album){
        if($album->tracklist != null){
            $tracks = explode('%',$album->tracklist);
        }else{
            $tracks = ['Tracklist Unavailable'];
        }
        

        return view('albums.show',[
            'album' => $album,
            'tracks' => $tracks
            ]);
    }
    // Show Create Form
    public function create(){
        return view('albums.create');
    }
    //Store album data from Form
    public function store(Request $request){

        $formFields = $request->validate([
            'title'         =>  'required',
            'artist'        =>  'required',
            'year'          =>  'required',
            'website'       =>  'required',
            'tags'          =>  'required',
            'label'         =>  'required',
            'description'   =>  'required',
            'tracklist'     =>  'max:500',
        ]);

        if($request->hasFile('logo')){
            $formFields['logo'] = $request->file('logo')->store('covers','public');
        }

        $formFields['user_id'] = auth()->id();

        Album::create($formFields);
        return redirect('/')->with('message','Album added successfully!');
    }

    //Edit album
    public function edit(Album $album){
        //Check Authenticated User is Owner
        $userid = $album->user_id;
        $authid = auth()->id();
        $authrole = auth()->user()->role;
        if($userid != $authid && $authrole != 'admin'){
            return view('error');
        }
        return view('albums.edit',['album'=>$album]);
    }

    //update album
    public function update(Request $request, Album $album){

        //Check Authenticated User is Writer
        $userid = $album->user_id;
        $authid = auth()->id();
        $authrole = auth()->user()->role;
        if($userid != $authid && $authrole != 'admin'){
            abort(403, 'Unauthorized action baby');
        }

        $formFields = $request->validate([
            'title'         =>  'required',
            'artist'        =>  'required',
            'year'          =>  'required',
            'website'       =>  'required',
            'tags'          =>  'required',
            'label'         =>  'required',
            'description'   =>  'required',
            'tracklist'     =>  'max:500',
        ]);

        $id = $album->id;
        if($request->hasFile('logo')){
            $formFields['logo'] = $request->file('logo')->store('covers','public');
        }

        $album->update($formFields);
        return redirect('/album'.'/'.$id)->with('message','Album updated successfully!');
    }
    //Delete Listing
    public function destroy(Album $album){
        
        //Check Authenticated User is Owner
        $userid = $album->user_id;
        $authid = auth()->id();
        $authrole = auth()->user()->role;
        // dd($userid,$authid);
        if($userid != $authid && $authrole != 'admin'){
            return view('error');
        }
        $album->delete();
        return back()->with('message','Album was deleted!');
    }

    //Manage albums
    public function manage(){

        $authrole = auth()->user()->role;

        if($authrole == 'admin'){
            $albums = DB::table('albums')->get();
        }
        else{
            $albums = auth()->user()->albums;
        }

        return view('albums.manage',[
            'albums' => $albums,
        ]);
    }
}
