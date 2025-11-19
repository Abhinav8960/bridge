<?php

namespace App\Models\Institute\Information;

use AppKit\Blameable\Traits\Blameable;
use Carbon\Traits\Timestamp;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Uploads extends Model
{
    use HasFactory, SoftDeletes, Blameable, Timestamp;

    protected $gaurded = [];
    protected $fillable = ['institute_id', 'logo','leaderboard','corporate_brochure'];

    public function images()
    {
        return $this->hasMany(GalleryImages::class, 'uploads_id', 'id');
    }

    public function institute()
    {
        return $this->hasOne(institute::class, 'id', 'institute_id');
    }
}
