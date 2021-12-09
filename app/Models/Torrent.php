<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    public function ratings()
    {
        return $this->hasMany(Rating::class)->orderBy('created_at', 'desc');
    }

    // public function ratings()
    // {
    //     return $this->belongsToMany(User::class, 'torrent_ratings')->withPivot('rating')->withTimestamps();
    // }

    // public function ratings()
    // {
    //     return $this->belongsToMany(User::class, 'torrent_ratings')->using(Rating::class);
    // }

    public function getAvgRating() {
        if (!$this->ratings->count()) {
            return 0;
        }

        $sum = 0;

        foreach ($this->ratings as $rating) {
            $sum += $rating->rating;
        }

        return $sum / $this->ratings->count();
    }
}