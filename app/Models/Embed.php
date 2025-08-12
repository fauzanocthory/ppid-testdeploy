<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Embed extends Model
{
    use HasFactory;

    protected $fillable = [
        'content_id',
        'title',
        'url',
    ];

    public function content()
    {
        return $this->belongsTo(Content::class);
    }
}
