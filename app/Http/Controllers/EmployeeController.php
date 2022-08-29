<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\Employee;
use App\Models\Title;
use App\Exports\EmployeesExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EmployeeController extends Controller
{
    public function index(Request $request)
    {
        $employees = Employee::getCurrentList($request->all())->paginate(15);
        ;

//        dd($employees);
        $departments = Department::all();

//        dd($employees);

        return view('welcome', [
            'employees' => $employees,
            'departments' => $departments,
            'filters'   => $request->all()
        ]);
    }
    public function export(Employee $emp_no, Request $request)
    {
        $currentList = Employee::getCurrentList()->where('employees.emp_no', '=', $emp_no->emp_no);

        $sumSalary = $currentList->sum('salary');

//        dd($sumSalary);
//        dd($currentList->get());

        $export = new EmployeesExport(
            $currentList

        );

//        dd($export);

        return Excel::download($export, 'employees.csv');
        redirect()->route('welcome');
    }
}
