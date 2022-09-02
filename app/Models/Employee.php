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
    public function departments(){
        return $this->belongsToMany(Department::class);
    }

    public static function getCurrentList($array = [])
    {
        $collection = DB::table('employees')
            ->join('current_dept_emp', 'employees.emp_no', '=', 'current_dept_emp.emp_no')
            ->leftJoin('departments', 'current_dept_emp.dept_no', '=', 'departments.dept_no')
            ->join('salaries', 'employees.emp_no', '=', 'salaries.emp_no')
            ->join('titles', 'employees.emp_no', '=', 'titles.emp_no')
                        ->select("employees.emp_no","employees.first_name","employees.last_name","departments.dept_name", "titles.title","salaries.salary",
                            DB::raw("(SELECT SUM(salaries.salary) FROM salaries
                                    WHERE salaries.emp_no = employees.emp_no
                                    GROUP BY salaries.emp_no) as salary_total"),
                        )
            ->whereColumn('salaries.to_date', '=', 'current_dept_emp.to_date')
            ->whereColumn('titles.to_date', '=', 'current_dept_emp.to_date');


//        dd($collection);

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
//            dd($collection);
        }
        if (Arr::get($array, 'max_salary'))
        {
            $collection->where('salary', '<', Arr::get($array, 'max_salary'));
        }
        if (Arr::get($array, 'department'))
        {
            $collection->where('dept_name', Arr::get($array, 'department'));
        }
        if (Arr::get($array, 'employee_select'))
        {
            if (request('employee_select') == 1)
                $collection->whereIn('current_dept_emp.to_date', ['9999-01-01']);
            else
                $collection->whereNotIn('current_dept_emp.to_date', ['9999-01-01']);
        }
        return $collection;
    }

}
