<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $fillable = [
        'name',
        'description',
        'status',
    ];

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'course_subject');
    }

    public function tasks()
    {
        return $this->hasMany(Task::class);
    }

    public function user_subject()
    {
        return $this->hasMany(User_Subject::class);
    }
}
