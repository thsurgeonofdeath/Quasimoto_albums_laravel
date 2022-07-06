<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\User;

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
}
