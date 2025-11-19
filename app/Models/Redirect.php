<?php

namespace App\Models;

use AppKit\Blameable\Traits\Blameable;
use Carbon\Traits\Timestamp;
use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Redirect extends Model
{
    use HasFactory, SoftDeletes, Timestamp, Blameable, Filterable;

    protected $timeZoneFields = ['created_at','updated_at'];

    protected $table = 'redirects';
}
