<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentWishlist extends Model
{
    use HasFactory;

    public function institute()
    {
        return $this->hasOne(Institute::class, 'id', 'institute_id');
    }

    
}
