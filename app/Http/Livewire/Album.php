<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;
use Illuminate\Support\Facades\DB;


class Album extends Component
{
    public $album;

    public function addLike(){
        auth()->user()->likes()->toggle($this->album->id);
    }
    
    public function render()
    {
        return view('livewire.album');
    }

    public function editAlbum($id){
        return redirect()->to('albums/'.$id.'/edit');
    }

    public function deleteAlbum($id){
        DB::table('albums')->where('id', $id)->delete();
        DB::table('reviews')->where('album_id', $id)->delete();
        DB::table('album_user')->where('album_id', $id)->delete();
        return redirect()->to('/');
    }
}
