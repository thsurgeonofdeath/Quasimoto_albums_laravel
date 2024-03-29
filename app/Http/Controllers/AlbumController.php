<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Review;
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

        return view('albums.index', [
            'albums'                => Album::latest()->where('approved', 1)->filter(request(['tag','search','label','date','artist']))->paginate(10),
            'checkadminwriter'      => $checkwriter,
            'checkadmin'             => $checkadmin,
        ]);
    }
    // show single album
    public function show(Album $album){

        if($album->approved == 0){
            return abort(404);
        }

        $avgStar = null;
        $count = null;

        if($album->tracklist != null){
            $tracks = explode('%',$album->tracklist);
        }else{
            $tracks = ['Tracklist Unavailable'];
        }
        
        $reviews = DB::table('reviews')->where('album_id', $album->id)->get();

        if(!$reviews->isEmpty()){
            $avgStar = round( $reviews->avg('rating'), 2) ;
            $count = $reviews->count();
        }

        $writer = DB::table('users')->where('id',$album->user_id)->first();
        

        return view('albums.show',[
            'album'         =>  $album,
            'tracks'        =>  $tracks,
            'reviews'       =>  $reviews,
            'rating'        =>  $avgStar,
            'ratingCount'   =>  $count,
            'writer'        =>  $writer,
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

        $formFields['type']     =  $request->type;

        if($request->hasFile('logo')){
            $formFields['logo'] = $request->file('logo')->store('covers','public');
        }

        $checkadmin = auth()->user()->roles()->where('name','admin')->exists();
        
        if($checkadmin){
            $formFields['approved'] = true;
        }

        $formFields['user_id'] = auth()->id();


        $exist = DB::table('albums')->where('artist', $formFields['artist'])->where('title', $formFields['title'])->get()->count();
        if($exist != 0){
            return redirect('/')->with('message','Album already exists!!!!');
        }
        Album::create($formFields);

        if($checkadmin){
            return redirect('/')->with('message','Album added successfully!');
        }
        else{
            return redirect('/')->with('message','Album is waiting for the admin to be approved!');
        }
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

        $formFields['type'] = $request->type;

        $id = $album->id;
        if($request->hasFile('logo')){
            $formFields['logo'] = $request->file('logo')->store('covers','public');
        }

        $album->update($formFields);
        if($album->approved == 0){
        return redirect('/albums/manage')->with('message','Album updated successfully!');
        }
        return redirect('/album'.'/'.$id)->with('message','Album updated successfully!');
    }

    //Delete Album
    public function destroy(Album $album){
       
        //Check Authenticated User is Owner
            $userid = $album->user_id;
            $authid = auth()->id();
            $authrole = auth()->user()->role;

            // Only post owner and admin can delete
            if($userid != $authid && $authrole != 'admin'){
                return view('error');
            }
        // Confirm Deleting 
        DB::table('reviews')->where('album_id', $album->id)->delete();
        DB::table('album_user')->where('album_id', $album->id)->delete();
        $album->delete();

        return back()->with('message','Album was deleted!');
    }


    //Manage albums
    public function manage(){

        $authrole = auth()->user()->role;

        if($authrole == 'admin'){
            $albums = DB::table('albums')->where('approved',1)->get()->reverse();
        }
        else{
            $albums = auth()->user()->albums->reverse();
        }

        return view('albums.manage',[
            'albums' => $albums,
        ]);
    }

    public function pending(){

        $albums = DB::table('albums')->where('approved', 0)->get()->reverse();
        
        return view('users.pending',[
            'pendingAlbums'     =>  $albums,
        ]);
    }

    public function approve(Request $request){

        $id = $request->albumID;
        switch ($request->input('action')) {
            case 'approve':
                DB::table('albums')->where('id', $id)->update(['approved' => 1]); 
                break;
            case 'delete':
                DB::table('albums')->where('id', $id)->delete();
                break;
        }
        return redirect()->back()->with('message','Album approved!!');
    }

    public function approveDetails(Request $request, Album $album){

        if($album->approved == 1){
            return redirect('/');
        }
        
        if($album->tracklist != null){
            $tracks = explode('%',$album->tracklist);
        }else{
            $tracks = ['Tracklist Unavailable'];
        }

        $writer = DB::table('users')->where('id', $album->user_id)->first();

        return view('users.view_details',[
            'album'         => $album,
            'tracks'        => $tracks,    
            'writer'        => $writer,
        ]);
    }
}
