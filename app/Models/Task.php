<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $table = 'tasks';
    protected $guarded = [];

    protected $with = ['user', 'file'];

    public const STATUS_PROCESS = 1;
    public const STATUS_SUCCESS = 2;
    public const STATUS_FAILED = 3;

    public static function getStatus()
    {
        return [
            self::STATUS_PROCESS => 'In process',
            self::STATUS_SUCCESS => 'Success',
            self::STATUS_FAILED => 'Error',
        ];
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function file() {
        return $this->belongsTo(File::class);
    }

    public function failedRows() {
        return $this->hasMany(FailedRow::class);
    }
}
