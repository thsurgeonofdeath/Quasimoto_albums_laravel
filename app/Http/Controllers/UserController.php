<?php

namespace App\Http\Controllers;

use App\Models\Message;
use DB;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;

class UserController extends Controller
{
    //Create User via register form
    public function create(){
        return view('users.register');
    }
    //Store User in the database
    public function store(Request $request){
        $formFields = $request->validate([
            'name'      =>  ['required','min:3'],
            'email'     =>  ['required','email',Rule::unique('users','email')],
            'password'  =>  'required|confirmed|min:6',
            'role'      =>  'user'
        ]);

        //Store profile picture:
        if($request->hasFile('picture')){
            $formFields['picture'] = $request->file('picture')->store('profiles','public');
        }

        //Hash password
        $formFields['password']=bcrypt($formFields['password']);
        //Create User and Login
        $user = User::create($formFields);
        $id = $user->id;
        
        DB::table('users')->where('id', $id)->update(['role' => 'user']);
        DB::insert('insert into role_user(user_id,role_id) values (?,?)',[$id,3]);
        event(new Registered($user));
        auth()->login($user);
        return redirect('/')->with('message','User created and logged in');

    }
    //Logout
    public function logout(Request $request){
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->with('message','you have been logged out bitch!');
    }
    //Login with existing user
    public function login(){
        return view('users.login');
    }
    //Authenticate with existing user
    public function authenticate(Request $request){
        $formFields = $request->validate([
            'email'  =>  ['required','email'],
            'password'  =>  'required'
        ]);

        //Checking if the user is Blocked
        $isBlocked = DB::table('users')->where('email', $formFields['email'])->pluck('isBlocked')->first();
        if($isBlocked){
            return view('users.blocked');
        }

        //Login the user
        if(auth()->attempt($formFields)){
            $request->session()->regenerate();
            return redirect('/')->with('message','Logged in successfully!!');
        }

        return back()->withErrors(['email'=>'Invalid credentials'])->onlyInput('email');

    }

    //Show edit user info form
    public function edit(){
        $user = auth()->user();
        return view('users.edit',['user' => $user]);
    }

    //update User
    public function update(Request $request, User $user){

        $formFields = $request->validate([
            'name'      =>  ['required','min:3'],
            'password'  =>  'required|confirmed|min:6'
        ]);

        //handling files
        if($request->hasFile('picture')){
            $currentUserPicture = $user->picture;
            unlink('storage/'.$currentUserPicture);
            $formFields['picture'] = $request->file('picture')->store('profiles','public');
        }

        //picutres are handled by the ijaboCropTool
        
        //Hash password
        $formFields['password']=bcrypt($formFields['password']);
        
        $user->update($formFields);
        return redirect('/users/display'.'/'.$user->id)->with('message','Changes Applied Successfully!!!');
    }

    //User likes album relation
    public function likes(){
        $albums = auth()->user()->likes;
        return view('users.likes',['albums' => $albums]);
    }

    //ijaboCropTool function
    function crop(Request $request){
        $file = $request->file('picture');
        $new_image_name = 'profiles/'.'UIMG'.date('Ymd').uniqid().'.jpg';
        $upload = $file->store('profiles','public');
        if($upload){
            $currentUser = auth()->user();
            $currentUserID = $currentUser->id;
            $currentUserPicture = $currentUser->picture;
            if($currentUserPicture){
                unlink('storage/'.$currentUserPicture);
            }
            DB::table('users')->where('id', $currentUserID)->update(['picture' => $upload]);
            return response()->json(['status'=>1, 'msg'=>'Image has been cropped successfully.', 'name'=>$new_image_name]);
        }else{
            return response()->json(['status'=>0, 'msg'=>'Something went wrong, try again later']);
        }
      }
      //display user profile
      public function profile(User $user){
        if($user->isBlocked){
            abort(404);
        }
        $created_at = explode(' ',$user->created_at);
        $created_at = $created_at[0];
        $reviews = DB::table('reviews')->where('user_id', $user->id)->get()->reverse()->slice(0,6);
        $likedAlbums = $user->likes->reverse()->slice(0,7);

        $contributions = DB::table('albums')->where('user_id', $user->id)->where('approved', 1)->get()->reverse();

        return view('users.profile',[
            'user'          =>  $user,
            'created_at'    =>  $created_at,
            'reviews'       =>  $reviews,
            'likedAlbums'   =>  $likedAlbums,
            'contributions' =>  $contributions,
        ]);
      }

      //Admin Users Dashboard
      public function usersBoard(){
        $users = DB::table('users')->where('role', 'user')->Orwhere('role', 'writer')->get();
        return view('users.usersBoard',[
          'users' => $users,
        ]);
      }

      //Admin Users Dashboard
      public function dashboard(){

        // Query to order writers based on how many articles they wrote
        $albums = DB::table('albums')
        ->where('approved', 1)
        ->select(DB::raw('user_id'), DB::raw('count(*) as count'))
        ->groupBy('user_id')
        ->orderBy('count', 'desc')
        ->get(['user_id'])
        ->unique()
        ->slice(0,6);

        $index = 0;
        foreach($albums as $album){
            $writers[$index] = DB::table('users')->where('id', $album->user_id)->first();
            $index++;
        }

        $albumsCount = DB::table('albums')->get()->count();
        $reviewsCount = DB::table('reviews')->get()->count();
        $usersCount = DB::table('users')->get()->count();
        
        return view('users.dashboard',[
            'albumsCount'       =>  $albumsCount,
            'reviewsCount'      =>  $reviewsCount,
            'usersCount'        =>  $usersCount,
            'writers'           =>  $writers,
        ]);
      }

     
}
