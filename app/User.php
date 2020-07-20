<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeUserMail;


class User extends Authenticatable 
{
    use Notifiable;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','username',
    ];
    protected static function boot(){
        parent::boot();
        static::created(function($user){
            $data = $user->profile()->create([
              'title'=>'profile de   '.  $user->username
            ]);
            Mail::to($data->user->email)->send(new WelcomeUserMail($data->user));

        });
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    public function getRouteKeyName(){
    return 'username';
}
public function profile(){
   return $this->hasOne('App\profile');    
}
public function following(){
    return $this->belongsToMany('App\profile');
}
public function posts(){
    return $this->hasMany('App\Post')->orderBy('created_at','DESC');
}

    public function likes(){
    return $this->hasMany('App\User');
}
}

