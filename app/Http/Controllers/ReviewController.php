<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Review;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class ReviewController extends Controller
{
    
    //add reviews
    public function addReview(Request $request){

        $formFields = $request->validate([
            'review'        =>  'required',
            'album_id'      => 'required',
        ]);

        $formFields['rating'] = $request->rating;
        $formFields['user_id'] = auth()->id();

        Review::create($formFields);

        return redirect()->back();
    }

     //edit or delete reviews
     public function editReview(Request $request, Review $review){

        $formFields = $request->validate([
            'review'        =>  'required',
        ]);
        
        $formFields['rating'] = $request->editRating;
        switch ($request->input('action')) {
            case 'update':
                $review->update($formFields);
                break;
            case 'delete':
                $review->delete();
                break;
        }
        return redirect()->back();
    }

    public function deleteReview(Review $review){
        $review->delete();
        return redirect()->back();
    }
}
