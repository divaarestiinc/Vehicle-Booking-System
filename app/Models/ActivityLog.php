<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivityLog extends Model
{
    // Mengizinkan kolom ini diisi melalui ActivityLog::create() 
    protected $fillable = [
        'user_id',
        'description'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}