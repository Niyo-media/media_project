<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $primaryKey = 'project_code';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'project_code',
        'project_name',
        'project_problem',
        'project_solution',
        'project_abstract',
        'project_dissertation',
        'project_source_code',
        'student_reg_number',
        'status',
        'comment',
        'department_code',
        'faculty_code',
        'supervisor_email',
    ];

    public function supervisor()
{
    return $this->belongsTo(Supervisor::class, 'supervisor_email', 'email');
}

}
