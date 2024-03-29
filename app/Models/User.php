<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'picture',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //Writing relationship
    public function albums() {
        return $this->hasMany('App\Models\Album');
    }

    //favourite relationship
    public function likes(){
        return $this->belongsToMany('App\Models\Album');
    }

    //Role relationship
    public function roles(){
        return $this->belongsToMany(Role::class);
    }

    //reviews relationship
    public function reviews(){
        return $this->hasMany('App\Models\Review');
    }

    //messages relationship
    public function messages(){
        return $this->hasMany('App\Models\Message');
    }

}
