<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\Category;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Storage;

class Post extends Model
{
    /** @use HasFactory<\Database\Factories\PostFactory> */
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'title',
        'slug',
        'image',
        'body',
        'published_at',
        'featured'

    ];
    protected $casts = [
        'published_at' => 'datetime'
    ];
    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function likes(){
        return $this->belongsToMany(User::class, 'post_like')->withTimestamps();
    }
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }
    public function comments(){
        return $this->hasMany(Comment::class);
    }
    public function scopePublished($query)
    {
        $query->where('published_at', '<=', Carbon::now());
    }
    public function scopeFeatured($query)
    {
        $query->where('featured', true);
    }
    public function getReadingTime()
    {
        $mins = round(str_word_count($this->body));
        return $mins < 1 ? 1 : $mins;
    }
    public function getThumbnailImage()
    {
        $isUrl =  str_contains($this->image, 'http');
        return $isUrl ? $this->image : Storage::disk('public')->url($this->image);
    }

    public function scopeWithCategory($query, string $category)
    {
        $query->whereHas('categories', function ($query) use ($category) {
            $query->where('slug', $category);
        });
    }
}
