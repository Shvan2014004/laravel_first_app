<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Salary extends Model
{
    use HasFactory;
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
    public function getMonthNameAttribute()
    {
        return Carbon::parse($this->attributes['salary_date'])->format('F');
    }
}
