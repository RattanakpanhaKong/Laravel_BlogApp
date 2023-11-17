<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    use HasFactory;
    protected $fillable = [
        'author',
        'title',
        'content',
        'image'
    ];

    // Relationship To User
//    public function user() {
//        return $this->belongsTo(User::class, 'user_id');
//    }
}
