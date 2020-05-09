<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subject extends Model {
    use SoftDeletes;
    
    public function teacher(){
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function users()    {
        return $this->belongsToMany('App\User');
    }
    
    protected $fillable = [
        'name', 'code', 'description', 'user_id', 'kredit',
    ];
}
