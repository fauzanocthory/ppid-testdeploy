<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hyperlink extends Model
{
    use HasFactory;

    protected $fillable = [
        'content_id',
        'url',
        'label',
    ];

    public function content()
    {
        return $this->belongsTo(Content::class);
    }
}
