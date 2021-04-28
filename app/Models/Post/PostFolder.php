<?php

namespace App\Models\Post;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Post\Post;
use App\Models\Account;
use App\Models\Kelas;

class PostFolder extends Model
{
    use HasFactory;

    public function class() {
        return $this->belongsTo(Kelas::class, 'class_id', 'id');
    }

    public function posts() {
        return $this->hasMany(Post::class);
    }
}
