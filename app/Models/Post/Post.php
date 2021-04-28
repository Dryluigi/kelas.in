<?php

namespace App\Models\Post;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Post\PostFolder;
use App\Models\Account;
use App\Models\Kelas;

class Post extends Model
{
    use HasFactory;

    protected $fillable = [
        'judul',
        'isi',
        'post_type_id',
        'class_id',
        'user_id',
        'post_folder_id',
    ];

    public function postFolder() {
        return $this->belongsTo(PostFolder::class);
    }

    public function user() {
        return $this->belongsTo(Account::class, 'user_id', 'id');
    }

    public function class() {
        return $this->belongsTo(Kelas::class, 'class_id', 'id');
    }
}
