<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HOD extends Model
{
    use HasFactory;

    protected $table = 'hods';
    protected $primaryKey = 'email';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'email',
        'first_name',
        'last_name',
        'campus_id',
        'department_code',
        'password',
    ];

    protected $hidden = [
        'password',
    ];

    public function campus()
    {
        return $this->belongsTo(Campus::class);
    }

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_code', 'department_code');
    }
}
