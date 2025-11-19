<?php

namespace App\Models\Institute\Information;

use Carbon\Traits\Timestamp;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use AppKit\Blameable\Traits\Blameable;


class GalleryImages extends Model
{
    use HasFactory, SoftDeletes, Timestamp, Blameable;

    protected $fillable = ['uploads_id', 'image', 'caption', 'alt', 'created_at', 'updated_at'];

    public function uploads()
    {
        return $this->belongsTo(Uploads::class, 'uploads_id');
    }
}
