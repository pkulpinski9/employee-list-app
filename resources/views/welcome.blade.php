@extends('layouts.app')
@section('content')
        <div class="container py-5 h-100">
            <div class="row">
                <div class="col-9">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col">emp_no</th>
                            <th scope="col">Imię i nazwisko</th>
                            <th scope="col">Departament</th>
                            <th scope="col">Tytuł</th>
                            <th scope="col">Pensja</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($employees as $employee)
                        <tr>
                            <th scope="row">{{ $employee->emp_no }}</th>
                            <td>{{ $employee->first_name }} {{ $employee->last_name }}</td>
                            <td>{{ $employee->dept_name }}</td>
                            <td>{{ $employee->title}}</td>
                            <td>{{ $employee->salary }}</td>
                            <td>
                                <a href="/export/{{ $employee->emp_no }}" class="btn btn-secondary">{{ __('Export') }}</a>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="col-3" style="background-color: #e6e6e6">
{{--                    <div style="text-align: center">--}}
{{--                        <p>plec</p>--}}
{{--                        <div class="form-check form-check-inline">--}}
{{--                            <input class="form-check-input" type="checkbox" id="inlineCheckbox1" value="option1">--}}
{{--                            <label class="form-check-label" for="inlineCheckbox1">M</label>--}}
{{--                        </div>--}}
{{--                        <div class="form-check form-check-inline">--}}
{{--                            <input class="form-check-input" type="checkbox" id="inlineCheckbox2" value="option2">--}}
{{--                            <label class="form-check-label" for="inlineCheckbox2">F</label>--}}
{{--                        </div>--}}
{{--                    </div>--}}

                    <form>
                        <p>Which employees</p>
                        <div class="form-check">
                            <input type="radio" class="form-check-input" id="radio1" name="actual_employee" value="9999-01-01">
                            <label class="form-check-label" for="radio1">Current</label>
                        </div>
                        <div class="form-check">
                            <input type="radio" class="form-check-input" id="radio2" name="actual_employee" value="M">
                            <label class="form-check-label" for="radio2">Former</label>
                        </div>
                        <p>min salary</p>
                        <input class="col form-control" type="text" name="min_salary" placeholder="10000">
                        <p>max salary</p>
                        <input class="col form-control" type="text" name="max_salary" placeholder="50000">
                        <p>plec</p>
                        <div class="form-check">
                            <input type="radio" class="form-check-input" id="radio3" name="gender" value="F">
                            <label class="form-check-label" for="radio3">F</label>
                        </div>
                        <div class="form-check">
                            <input type="radio" class="form-check-input" id="radio4" name="gender" value="M">
                            <label class="form-check-label" for="radio4">M</label>
                        </div>
                        <p>Department</p>
                        <select class="form-control" name="department">
                            <option value="">Choose department</option>
                            @foreach($departments as $department)
                                <option>{{ $department->dept_name }}</option>
                            @endforeach
                        </select>

                        <button type="submit" name="submit" class="btn btn-secondary">Secondary</button>
                    </form>


                </div>
            </div>
            {{ $employees->appends($filters)->render() }}
        </div>

@endsection
