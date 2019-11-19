<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User_Subject extends Model
{
    protected $fillable = [
        'user_id',
        'subject_id',
        'status',
        'process',
    ];

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
