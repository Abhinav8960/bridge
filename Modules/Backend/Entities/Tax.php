<?php

namespace Modules\Backend\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Tax extends Model
{
    use HasFactory;

    protected $fillable = [];
    
    public function breakups()
    {
        return $this->hasMany(TaxBreakup::class, 'tax_id', 'id');
    }
}
