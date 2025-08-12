<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attachment extends Model
{
    use HasFactory;

    protected $fillable = [
        'content_id',
        'filename',
        'filepath',
        'filetype',
    ];

    public function content()
    {
        return $this->belongsTo(Content::class);
    }
}