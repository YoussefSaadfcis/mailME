<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCharacter extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'mood',
        'motivation',
        'tone',
        'religion',
        'allow_religion_use',
        'about',
    ];

    // Relationship to user
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
