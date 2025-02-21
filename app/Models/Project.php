<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $table = 'projects';
    protected $guarded = [];

    protected $with = ['type'];

    protected $casts = [
        'created_at_time' => 'datetime',
        'deadline' => 'datetime',
    ];

    public function type() {
        return $this->belongsTo(Type::class);
    }

    public function payments() {
        return $this->hasMany(Payment::class);
    }
}
