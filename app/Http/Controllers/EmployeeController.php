<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Employee;
use App\Models\Title;
use App\Models\Salary;
use App\Exports\EmployeesExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {

        $employees = Employee::getCurrentList($request->all())->paginate(15);

//        dd($employees);
        $departments = Department::all();

        return view('welcome', [
            'employees' => $employees,
            'departments' => $departments,
            'request' => $request
        ]);
    }
    public function export(Request $request)
    {

//        dd($request->all());
        $currentList = Employee::getCurrentList()->whereIn('employees.emp_no', $request->export);

//        dd($currentList->get());

        $export = new EmployeesExport(
            $currentList
        );

//        dd($export);

        return Excel::download($export, 'employees.csv');

    }
}
