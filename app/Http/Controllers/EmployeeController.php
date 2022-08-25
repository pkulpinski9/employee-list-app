<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Title;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{
    public function index()
    {

        $employees = DB::table('employees')
            ->join('titles', 'employees.emp_no', '=', 'titles.emp_no')
            ->join('salaries', 'employees.emp_no', '=', 'salaries.emp_no')
            ->join('dept_emp', 'employees.emp_no', '=', 'dept_emp.emp_no')
            ->leftJoin('departments', 'dept_emp.dept_no', 'departments.dept_no')
            ->select('employees.*', 'titles.title', 'salaries.salary', 'departments.dept_name')
            ->where('salaries.to_date', '=', '9999-01-01')
            ->where('titles.to_date', '=', '9999-01-01')
            ->where('dept_emp.to_date', '=', '9999-01-01')
            ->paginate(15);

//        dd($employees);

        return view('welcome', [
            'employees' => $employees,
        ]);
    }
}
