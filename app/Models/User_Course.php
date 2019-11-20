<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User_Course extends Model
{
    protected $fillable = [
        'user_id'  ,
        'course_id',
        'status',
        'process',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
