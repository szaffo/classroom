<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model{

    use SoftDeletes;

    protected $fillable = [
        'name', 'start', 'deadline', 'value', 'subject_id', 'description'
    ];

    public function subject() {
        return $this->belongsTo('App\Subject');
    }

    public function state() {
        $now = date('Y-m-d');
        if ($this->start > $now) return 'waiting';
        if (($this->start <= $now) && ($this->deadline >= $now)) return 'ongoing';
        if (($this->deadline < $now)) return 'over';
    }

    public function solutions() {
        return $this->hasMany('App\Solution');
    }
}
