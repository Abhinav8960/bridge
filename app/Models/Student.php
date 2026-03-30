<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Student extends Authenticatable
{
    use HasFactory;

    protected $guarded = "student";

    protected $fillable = [
        'school_name',
        'name',
        'phone',
        'email',
        'password',
        'actual_password',
        'otp',
        'otp_generate_datetime',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function reviews()
    {
        return $this->hasMany(InstituteReview::class, 'student_id', 'id');
    }

    public function canEnroll()
    {
        if (!empty($this->email) && !empty($this->name)) {
            return true;
        }
        return false;
    }
}
