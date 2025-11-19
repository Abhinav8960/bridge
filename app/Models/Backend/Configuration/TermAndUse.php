<?php

namespace App\Models\Backend\Configuration;

use AppKit\Blameable\Traits\Blameable;
use Carbon\Traits\Timestamp;
use EloquentFilter\Filterable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TermAndUse extends Model
{
    use HasFactory, Timestamp, SoftDeletes, Blameable, Filterable;

    protected $fillable = ['module_sequence', 'module_title', 'module_description'];
}
