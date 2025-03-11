<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{
    use HasFactory;

    protected $table = 'faculties';
    protected $primaryKey = 'faculty_code'; // Set primary key to faculty_code
    public $incrementing = false; // Disable auto-increment since faculty_code is a string
    protected $keyType = 'string'; // Ensure it's treated as a string
    protected $fillable = ['faculty_code', 'faculty_name', 'department_code'];
}
