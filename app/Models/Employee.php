<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Arr;

class Employee extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */

    protected $table = 'employees';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */

    protected $primaryKey = 'emp_no';

    public function titles(){
        return $this->hasMany(Title::class, 'emp_no', 'emp_no');
    }
    public function salaries(){
        return $this->hasMany(Salary::class, 'emp_no', 'emp_no');
    }

    public static function getCurrentList($array = [])
    {
        $collection = DB::table('employees')
            ->join('titles', 'employees.emp_no', '=', 'titles.emp_no')
            ->join('salaries', 'employees.emp_no', '=', 'salaries.emp_no')
            ->join('dept_emp', 'employees.emp_no', '=', 'dept_emp.emp_no')
            ->leftJoin('departments', 'dept_emp.dept_no', 'departments.dept_no')
            ->select('employees.*', 'titles.title', 'salaries.salary', 'departments.dept_name');

        return self::filter($collection, $array);
    }

    public static function filter($collection, $array)
    {
        if (Arr::get($array, 'gender'))
        {
            $collection->where('gender', Arr::get($array, 'gender'));
        }
        if (Arr::get($array, 'min_salary'))
        {
            $collection->where('salary', '>', Arr::get($array, 'min_salary'));
        }
        if (Arr::get($array, 'max_salary'))
        {
            $collection->where('salary', '<', Arr::get($array, 'max_salary'));
        }
        if (Arr::get($array, 'department'))
        {
            $collection->where('dept_name', Arr::get($array, 'department'));
        }
        if (Arr::get($array, 'actual_employee'))
        {
            $collection->where('salaries.to_date', '=', Arr::get($array, 'actual_employee'))
                       ->where('titles.to_date', '=', Arr::get($array, 'actual_employee'))
                       ->where('dept_emp.to_date', '=', Arr::get($array, 'actual_employee'));
        }

        return $collection;
    }

    public function departments(){
        return $this->belongsToMany(Department::class);
    }

}
