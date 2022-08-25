@extends('layouts.app')
@section('content')
        <div class="container py-5 h-100">
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
                </tr>
                @endforeach
                </tbody>

            </table>
            {{ $employees->links() }}
        </div>

@endsection
