<?php

namespace App\Http\Livewire;

use Illuminate\Support\Facades\DB;
use Livewire\Component;

class User extends Component
{
    public $users;
    public $user;

    public function turnWriter($id){
        DB::table('users')->where('id', $id)->update(['role' => 'writer']);
        DB::insert('insert into role_user (user_id, role_id) values (?, ?)', [$id, 2]);
        return redirect()->to('/dashboard/users');
    }

    public function removeWriter($id){
        DB::table('users')->where('id', $id)->update(['role' => 'user']);
        DB::table('role_user')->where('user_id', '=', $id)->where('role_id','=', 2)->delete();
        return redirect()->to('/dashboard/users');
    }

    public function blockUser($id){
        DB::table('users')->where('id', $id)->update(['isBlocked' => true]);
        return redirect()->to('/dashboard/users');
    }

    public function unblockUser($id){
        DB::table('users')->where('id', $id)->update(['isBlocked' => false]);
        return redirect()->to('/dashboard/users');
    }

    public function deleteUser($id){
        DB::table('reviews')->where('user_id', $id)->delete();
        DB::table('messages')->where('user_id', $id)->delete();
        DB::table('role_user')->where('user_id', $id)->delete();
        DB::table('album_user')->where('user_id', $id)->delete();
        DB::table('users')->where('id', $id)->delete();  
        return redirect()->to('/dashboard/users');
    }

    public function render()
    {
        $userlist = DB::table('users')->where('role', 'user')->Orwhere('role', 'writer')->get();
        return view('livewire.user',[
            'users' =>$userlist
        ]);
    }
}
