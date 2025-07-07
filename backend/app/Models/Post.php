<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /** @use HasFactory<\Database\Factories\PostFactory> */
    use HasFactory;
    protected $fillable=
    [
        'title',
        'body',
    ];

    public function user(){
        $this->belongTo(User::class);//we difine Post model belong to User model
    }
}
