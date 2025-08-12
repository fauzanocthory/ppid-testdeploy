<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Str;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'slug'
    ];

    public function content()
    {
        return $this->hasMany(Content::class);
    }

    public static function boot()
    {
        parent::boot();

        static::creating(function ($category) {
            $category->slug = static::generateUniqueSlug($category->name);
        });

        static::updating(function ($category) {
            if ($category->isDirty('name')) {
                $category->slug = static::generateUniqueSlug($category->name, $category->id);
            }
        });
    }

    protected static function generateUniqueSlug($name, $excludeId = null)
    {
        $slug = Str::slug($name);
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