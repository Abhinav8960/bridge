<?php

namespace App\Models\Backend\Configuration;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use EloquentFilter\Filterable;

class Parameters extends Model
{
    use HasFactory, SoftDeletes, Filterable;



    public function modelFilter()
    {
        return $this->provideFilter(\App\ModelFilters\Backend\Configuration\CategoryFilter::class);
    }
}
