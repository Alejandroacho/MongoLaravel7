<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use Illuminate\Auth\Authenticatable as AuthenticatableTrait;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Auth;

class User extends Eloquent implements Authenticatable
{
    use AuthenticatableTrait;
    use Notifiable;

    protected $connection = 'mongodb';

    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function tasks()
    {
        $user = Auth::user();
        $user_id = $user->id;
        $tasks = Task::where('user_id', "$user_id")->get();
        return $tasks;
    }
}
