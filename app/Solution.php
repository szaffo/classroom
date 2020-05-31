<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Solution extends Model
{
    protected $fillable = [
        'user_id', 'task_id', 'content', 'value', 'valuate_text', 'valuated_at', 'file'
    ];

    public function task() {
        return $this->belongsTo('App\Task');
    }

    public function user() {
        return $this->belongsTo('App\User');
    }
}
