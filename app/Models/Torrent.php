<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PhpParser\Node\Expr\FuncCall;

class Torrent extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'category_id', 'filename' ];
    
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function uploader()
    {
        return $this->belongsTo(User::class, 'uploader_id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class)->orderBy('created_at', 'desc');
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }
}
