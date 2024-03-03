<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'salary';
    protected $fillable = [
        'salary_date',
        'empolyee_id',
        'employee_name',
        'no_of_workin_days',
        'salary_per_day',
        'deduction',
        'netsalary',
    ];
}
