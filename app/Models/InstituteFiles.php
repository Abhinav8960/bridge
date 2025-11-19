<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use EloquentFilter\Filterable;
use AppKit\Blameable\Traits\Blameable;
use Carbon\Traits\Timestamp;

class InstituteFiles extends Model
{
    use HasFactory, SoftDeletes, Filterable, Blameable, Timestamp;

    const FILE_TYPE_INSTITUTE = 1;
    const FILE_TYPE_STREAM = 2;

    public function data()
    {
        // return $this->hasMany(InstituteFilesData::class, 'institute_files_id', 'id');
        if($this->type == SELF::FILE_TYPE_STREAM){

            return $this->hasMany(InstituteFilesData::class, 'institute_files_id', 'id');
        }else{

            return $this->hasMany(InstituteStreamExamFilesData::class, 'institute_files_id', 'id');
        }
    }

    public function institutedata()
    {
        return $this->hasMany(InstituteFilesData::class, 'institute_files_id', 'id');
        // return $this->hasMany(InstituteFilesData::class, 'institute_files_id', 'id');
        
    }

    public function institutestreamdata()
    {
        return $this->hasMany(InstituteStreamExamFilesData::class, 'institute_files_id', 'id');
        // return $this->hasMany(InstituteFilesData::class, 'institute_files_id', 'id');
        
    }

    public function datamigrated()
    {
        if($this->type == SELF::FILE_TYPE_STREAM){

            return $this->hasMany(InstituteFilesData::class, 'institute_files_id', 'id')->where('is_migrated', true);
        }else{

            return $this->hasMany(InstituteStreamExamFilesData::class, 'institute_files_id', 'id')->where('is_migrated', true);
        }



    }

   
}
