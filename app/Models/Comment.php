<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'comment'
    ];

    protected $table = 'comments';

    public function user(){
        return $this->belongsTo(\App\Models\User::class, 'id_user');
    }

    public function post(){
        return $this->belongsTo(\App\Models\Post::class, 'id_post');
    }
}
