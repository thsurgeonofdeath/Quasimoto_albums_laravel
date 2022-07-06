<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    use HasFactory;

    public function scopeFilter($query, array $filters){
        if($filters['tag']  ?? false){
            $query->where('tags','like','%'.request('tag').'%');
        }
        if($filters['search']  ?? false){
            $query->where('title','like','%'.request('search').'%')
            ->orWhere('artist','like','%'.request('search').'%')
            ->orWhere('tags','like','%'.request('search').'%');
        }
        if($filters['label']  ?? false){
            $query->where('label','like','%'.request('label').'%');
        }
        if($filters['date']  ?? false){
            $query->where('year','like','%'.request('date').'%');
        }
    }

    // User Relationship
    public function user(){
        return $this->belongsTo(User::class, 'user_id');
    }

    //favourite relationship
    public function likes(){
        return $this->belongsToMany('App\Models\User');
    }

    public function isLiked(){
        if(auth()->check()){
            return auth()->user()->likes->contains('id',$this->id);
        }
    }
}
