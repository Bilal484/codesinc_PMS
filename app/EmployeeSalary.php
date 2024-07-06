<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmployeeSalary extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',      
        'salary',
        'bank_name',
        'bank_account_number',
        'ifsc_code',
    ];

    public function salaries()
    {
        return $this->hasMany(Salary::class, 'employee_id');
    }
}
