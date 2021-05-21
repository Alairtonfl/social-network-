<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $table = 'posts';

    protected $fillable = [
        'post',
        'title'
    ];

    public function user(){
        return $this->belongsTo(User::class, 'id_user');
    }

    public function comments(){
        return $this->hasMany(Comment::class, 'id_post', 'id');
    }

}
