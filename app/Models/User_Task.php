<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User_Task extends Model
{
    protected $fillable = [
        'user_id',
        'task_id',
        'status',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function task()
    {
        return $this->belongsTo(Task::class);
    }
}
