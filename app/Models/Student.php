<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;


class Student extends Authenticatable
{
    use HasFactory;

    protected $guard = 'student';

    protected $primaryKey = 'student_reg_number';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'student_reg_number',
        'first_name',
        'last_name',
        'gender',
        'email',
        'password',
        'phone_number',
        'campus_id',
        'department_code',
        'faculty_code',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function getAuthIdentifierName()
    {
        return 'student_reg_number';
    }
    
    public function getRouteKeyName()
    {
        return 'student_reg_number';
    }

    public function campus()
    {
        return $this->belongsTo(Campus::class, 'campus_id', 'campus_id');
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_code', 'department_code');
    }

    public function faculty()
    {
        return $this->belongsTo(Faculty::class, 'faculty_code', 'faculty_code');
    }
}
