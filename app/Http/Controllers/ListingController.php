<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class ListingController extends Controller
{
    // show all listings
    public function index(){
        // dd(request('label'));
        return view('listings.index', [
            'listings'  => Listing::latest()->filter(request(['tag','search','label','date']))->paginate(6)
        ]);
    }
    // show single listing
    public function show(Listing $listing){
        return view('listings.show',[
            'listing' => $listing
            ]);
    }
    // Show Create Form
    public function create(){
        return view('listings.create');
    }
    //Store Listing data from Form
    public function store(Request $request){

        $formFields = $request->validate([
            'title'         =>  'required',
            'company'       =>  'required',
            'location'      =>  'required',
            'website'       =>  'required',
            'tags'          =>  'required',
            'label'         =>  'required',
            'description'   =>  'required'
        ]);

        if($request->hasFile('logo')){
            $formFields['logo'] = $request->file('logo')->store('logos','public');
        }

        $formFields['user_id'] = auth()->id();

        Listing::create($formFields);
        return redirect('/')->with('message','Album added successfully!');
    }

    //Edit Listing
    public function edit(Listing $listing){
        //Check Authenticated User is Owner
        $userid = $listing->user_id;
        $authid = auth()->id();
        if($userid != $authid){
            return view('error');
        }
        return view('listings.edit',['listing'=>$listing]);
    }

    //update listing
    public function update(Request $request, Listing $listing){

        //Check Authenticated User is Owner
        $userid = $listing->user_id;
        $authid = auth()->id();
        if($userid != $authid){
            abort(403, 'Unauthorized action baby');
        }

        $formFields = $request->validate([
            'title'         =>  'required',
            'company'       =>  'required',
            'location'      =>  'required',
            'website'       =>  'required',
            'tags'          =>  'required',
            'label'         =>  'required',
            'description'   =>  'required'
        ]);

        if($request->hasFile('logo')){
            $formFields['logo'] = $request->file('logo')->store('logos','public');
        }

        $listing->update($formFields);
        return back()->with('message','Album updated successfully!');
    }
    //Delete Listing
    public function destroy(Listing $listing){
        
        //Check Authenticated User is Owner
        $userid = $listing->user_id;
        $authid = auth()->id();
        if($userid != $authid){
            return view('error');
        }
        $listing->delete();
        return redirect('/')->with('message','Listing was deleted!');
    }

    //Manage listings
    public function manage(){
        return view('listings.manage',[
            'listings' => auth()->user()->listings
        ]);
    }
}
