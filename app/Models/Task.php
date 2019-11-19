<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $fillable = [
        'subject_id',
        'name',
        'description',
    ];

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
}
