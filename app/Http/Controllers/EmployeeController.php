<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = Employee::all()->first();


        return view('welcome', [
            'employees' => $employees->paginate(25)
        ]);
    }
}