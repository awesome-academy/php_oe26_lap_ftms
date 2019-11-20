<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = [
        'category_id',
        'name',
        'description',
        'status',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function subjects()
    {
        return $this->belongsToMany(Subject::class, 'course_subject');
    }

    public function user_course()
    {
        return $this->hasMany(User_Course::class);
    }
}
