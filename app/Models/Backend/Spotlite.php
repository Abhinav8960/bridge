<?php

namespace App\Models\Backend;

use AppKit\Blameable\Traits\Blameable;
use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Spotlite extends Model
{
    use HasFactory, SoftDeletes, Filterable,  Blameable;

    protected $table = 'spotlites';
    protected $fillable = ['institute_name', 'location', 'establish_year', 'batch_training', 'virtual_classroom', 'description
    institute_url', 'dyntube_project_id', 'dyntube_video_id', 'image'];
}
