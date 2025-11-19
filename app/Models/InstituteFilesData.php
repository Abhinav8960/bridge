<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use EloquentFilter\Filterable;
use AppKit\Blameable\Traits\Blameable;
use Carbon\Traits\Timestamp;

class InstituteFilesData extends Model
{
    use HasFactory, SoftDeletes, Filterable;
}
