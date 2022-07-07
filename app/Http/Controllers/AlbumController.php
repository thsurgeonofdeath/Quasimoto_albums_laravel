<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class AlbumController extends Controller
{
    // show all albums
    public function index(){
        $check = false;
        if(auth()->user() != null){
            $check = auth()->user()->roles()->where('name', 'admin')->exists();
            if($check == false){
            $check = auth()->user()->roles()->where('name', 'writer')->exists();
            }
            // dd(auth()->user()->roles()->Where('name','writer')->exists());
            // dd($check);
        }
        return view('albums.index', [
            'albums'    => Album::latest()->filter(request(['tag','search','label','date']))->paginate(6),
            'checkadminwriter'     => $check,
        ]);
    }
    // show single album
    public function show(Album $album){
        return view('albums.show',[
            'album' => $album
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
            'description'   =>  'required'
        ]);

        if($request->hasFile('logo')){
            $formFields['logo'] = $request->file('logo')->store('logos','public');
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
        if($userid != $authid){
            return view('error');
        }
        return view('albums.edit',['album'=>$album]);
    }

    //update listing
    public function update(Request $request, Album $album){

        //Check Authenticated User is Owner
        $userid = $album->user_id;
        $authid = auth()->id();
        if($userid != $authid){
            abort(403, 'Unauthorized action baby');
        }

        $formFields = $request->validate([
            'title'         =>  'required',
            'artist'        =>  'required',
            'year'          =>  'required',
            'website'       =>  'required',
            'tags'          =>  'required',
            'label'         =>  'required',
            'description'   =>  'required'
        ]);

        if($request->hasFile('logo')){
            $formFields['logo'] = $request->file('logo')->store('logos','public');
        }

        $album->update($formFields);
        return redirect('/')->with('message','Album updated successfully!');
    }
    //Delete Listing
    public function destroy(Album $album){
        
        //Check Authenticated User is Owner
        $userid = $album->user_id;
        $authid = auth()->id();
        // dd($userid,$authid);
        if($userid != $authid){
            return view('error');
        }
        $album->delete();
        return back()->with('message','Album was deleted!');
    }

    //Manage albums
    public function manage(){
        return view('albums.manage',[
            'albums' => auth()->user()->albums
        ]);
    }
}
