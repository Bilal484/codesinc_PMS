<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    use HasFactory;

    protected $fillable = ['employee_id','email', 'amount', 'payment_date', 'remarks'];

    public function employee()
    {
        return $this->belongsTo(EmployeeSalary::class, 'employee_id');
    }
}
