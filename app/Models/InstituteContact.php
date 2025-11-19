<?php

namespace App\Models;

use AppKit\Blameable\Traits\Blameable;
use Carbon\Traits\Timestamp;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InstituteContact extends Model
{
    use HasFactory, Blameable, Timestamp;
}
