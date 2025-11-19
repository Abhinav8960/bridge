<?php

namespace App\Models\Backend;

use App\Models\User;
use AppKit\Blameable\Traits\Blameable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InstitutePackageHistory extends Model
{
    use HasFactory, Blameable;


    public function package()
    {
        return $this->hasOne(Packages::class, 'id', 'package_id')->withTrashed();
    }

    // public function creator()
    // {
    //     return $this->hasOne(User::class, 'id', 'created_by')->withTrashed();
    // }
}
