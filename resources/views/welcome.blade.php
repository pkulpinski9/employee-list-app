@extends('layouts.app')
@section('content')
        <div class="container py-5 h-100">
            <div class="row">
                <div class="col-9">
                    <form action="/export" method="GET">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th scope="col">{{ __('emp_no') }}</th>
                                <th scope="col">{{ __('Name') }}</th>
                                <th scope="col">{{ __('Department') }}</th>
                                <th scope="col">{{ __('Title') }}</th>
                                <th scope="col">{{ __('Salary') }}</th>
                                <th scope="col">{{ __('Export') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($employees as $employee)
                            <tr>
                                <th scope="row">{{ $employee->emp_no }}</th>
                                <td>{{ $employee->first_name }} {{ $employee->last_name }}</td>
                                <td>{{ $employee->dept_name }}</td>
                                <td>{{ $employee->title }}</td>
                                <td>{{ $employee->salary }}</td>
                                <td>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="export[{{ $employee->emp_no }}]" value="{{ $employee->emp_no }}" id="flexCheckDefault">
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                        </table>
                        <button type="submit" class="btn btn-secondary float-end">{{ __('Export to CSV') }}</button>
                    </form>
                </div>
                <div class="col-3" style="background-color: #e6e6e6">
                    <form>
                        <p class="my-2">{{ __('Which employees') }}</p>
                        <select class="form-control" name="employee_select">
                            <option value="">{{ __('Choose employees') }}</option>
                            <option value="1" {{ old('employee_select', $request->employee_select) == '1' ? "selected":"" }} >{{ __('Current') }}</option>
                            <option value="2" {{ old('employee_select', $request->employee_select) == '2' ? "selected":"" }}>{{ __('Former') }}</option>
                        </select>
                        <p class="my-2">{{ __('Min salary') }}</p>
                        <input class="col form-control" type="text" name="min_salary" value="{{ old('min_salary', $request->min_salary) }}" placeholder="10000">
                        <p class="my-2">{{ __('Max salary') }}</p>
                        <input class="col form-control" type="text" name="max_salary" value="{{ old('max_salary', $request->max_salary) }}" placeholder="50000">
                        <p class="my-2">{{ __('Sex') }}</p>
                        <div class="form-check">
                            <input type="radio" class="form-check-input" id="radio3" name="gender" value="F" {{ old('gender', $request->gender) == 'F' ? 'checked' : ''}} />
                            <label class="form-check-label" for="radio3">F</label>
                        </div>
                        <div class="form-check">
                            <input type="radio" class="form-check-input" id="radio4" name="gender" value="M" {{ old('gender', $request->gender) == 'M' ? 'checked' : ''}} />
                            <label class="form-check-label" for="radio4">M</label>
                        </div>
                        <p class="my-2">{{ __('Department') }}</p>
                        <select class="form-control" name="department">
                            <option value="">{{ __('Choose department') }}</option>
                            @foreach($departments as $department)
                                <option value="{{ $department->dept_name }}" {{ old('department', $request->department) == $department->dept_name ? "selected":"" }}>{{ $department->dept_name }}</option>
                            @endforeach
                        </select>
                        <button type="submit" name="submit" class="btn btn-secondary my-2">{{ __('Filter') }}</button>
                    </form>
                </div>
            </div>
            {{ $employees->appends($request->all())->render() }}
        </div>
@endsection
