<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    protected $primaryKey = 'department_code';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = ['department_code', 'department_name', 'campus_id'];

    public function campus()
    {
        return $this->belongsTo(Campus::class);
    }

    public function faculties()
    {
        return $this->hasMany(Faculty::class);
    }

    
}
