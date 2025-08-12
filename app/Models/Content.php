<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Str;

class Content extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'thumbnail',
        'body',
        'category_id'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function embeds()
    {
        return $this->hasMany(Embed::class);
    }

    public function hyperlinks()
    {
        return $this->hasMany(Hyperlink::class);
    }

    public function attachments()
    {
        return $this->hasMany(Attachment::class);
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($content) {
            $content->slug = static::generateUniqueSlug($content->title);
        });

        static::updating(function ($content) {
            if ($content->isDirty('title')) {
                $content->slug = static::generateUniqueSlug($content->title, $content->id);
            }
        });
    }

    protected static function generateUniqueSlug($title, $excludeId = null)
    {
        $slug = Str::slug($title);
        $original = $slug;
        $counter = 1;

        while (
            static::where('slug', $slug)
                ->when($excludeId, function ($q) use ($excludeId) {
                    return $q->where('id', '!=', $excludeId);
                })
                ->exists()
        ) {
            $slug = $original . '-' . $counter++;
        }

        return $slug;
    }
}