<?php

namespace App\Models\Institute\Information;

use AppKit\Blameable\Traits\Blameable;
use Carbon\Traits\Timestamp;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FacultySubject extends Model
{
    use HasFactory, Timestamp, SoftDeletes, Blameable;

    protected $fillable = ['subject'];

    public function ucFirstSubject(){
        return ucwords(strtolower($this->subject));
    }
    
}
