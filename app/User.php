<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'teacher',
    ];

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

    public function subjects(){
        if ($this->teacher) {
            return $this->hasMany('App\Subject');
        } else {
            return $this->belongsToMany('App\Subject')->as('subscription')->where('public', '1');
        }
    }


    public function isSubscribedTo($subject) {
        return $this->subjects->contains($subject);
    }

    public function solutions() {
        return $this->hasMany('App\Solution');
    }

    public function solutionsByTask($taskId) {
        return $this->hasMany('App\Solution')->where('task_id', '=', $taskId);
    }

}
