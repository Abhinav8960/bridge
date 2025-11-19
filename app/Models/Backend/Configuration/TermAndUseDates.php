<?php

namespace App\Models\Backend\Configuration;

use AppKit\Blameable\Traits\Blameable;
use Carbon\Traits\Timestamp;
use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TermAndUseDates extends Model
{
    use HasFactory, Timestamp, SoftDeletes, Blameable, Filterable;
    protected $fillable = ['effective_date', 'last_updated'];
}
