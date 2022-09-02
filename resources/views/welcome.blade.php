@extends('layouts.app')
@section('content')
        <div class="container py-5 h-100">
            <div class="row">
                <div class="col-9">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th scope="col">{{ __('emp_no') }}</th>
                            <th scope="col">{{ __('Name') }}</th>
                            <th scope="col">{{ __('Department') }}</th>
                            <th scope="col">{{ __('Title') }}</th>
                            <th scope="col">{{ __('Salary') }}</th>
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
                                <a href="/export/{{ $employee->emp_no }}" class="btn btn-secondary">{{ __('Export') }}</a>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="col-3" style="background-color: #e6e6e6">
                    <form>
                        <p class="my-2">{{ __('Which employees') }}</p>
                        <select class="form-control" name="employee_select">
                            <option value="">{{ __('Choose employees') }}</option>
                            <option value="1">{{ __('Current') }}</option>
                            <option value="2">{{ __('Former') }}</option>
                        </select>
                        <p class="my-2">{{ __('Min salary') }}</p>
                        <input class="col form-control" type="text" name="min_salary" placeholder="10000">
                        <p class="my-2">{{ __('Max salary') }}</p>
                        <input class="col form-control" type="text" name="max_salary" placeholder="50000">
                        <p class="my-2">{{ __('Sex') }}</p>
                        <div class="form-check">
                            <input type="radio" class="form-check-input" id="radio3" name="gender" value="{{ __('F') }}">
                            <label class="form-check-label" for="radio3">F</label>
                        </div>
                        <div class="form-check">
                            <input type="radio" class="form-check-input" id="radio4" name="gender" value="{{ __('M') }}">
                            <label class="form-check-label" for="radio4">M</label>
                        </div>
                        <p class="my-2">{{ __('Department') }}</p>
                        <select class="form-control" name="department">
                            <option value="">{{ __('Choose department') }}</option>
                            @foreach($departments as $department)
                                <option>{{ $department->dept_name }}</option>
                            @endforeach
                        </select>

                        <button type="submit" name="submit" class="btn btn-secondary my-2">{{ __('Filtr') }}</button>
                    </form>


                </div>
            </div>
            {{ $employees->appends($filters)->render() }}
        </div>

@endsection
