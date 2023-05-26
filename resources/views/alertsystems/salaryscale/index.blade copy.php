<!-- resources/views/alertsystems/salaryscale/index.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Salary Scales') }}</div>

                <div class="card-body">
                    <div class="mb-3">
                        <a href="{{ route('salaryscales.create') }}" class="btn btn-primary">{{ __('Create Salary Scale') }}</a>
                    </div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">{{ __('ID') }}</th>
                                <th scope="col">{{ __('JOB TITLE NAME') }}</th>
                                <th scope="col">{{ __('SALARY LEVEL') }}</th>
                                <th scope="col">{{ __('Minimum Salary') }}</th>
                                <th scope="col">{{ __('Maximum Salary') }}</th>
                                <th scope="col">{{ __('CREATED AT') }}</th>
                                <th scope="col">{{ __('Actions') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($salaryScales as $salary)
                            <tr>
                                <td>{{ $salary->id }}</td>
                                <td>{{ $salary->name }}</td>
                                <td>{{ $salary->salary_level }}</td>
                                <td>${{ $salary->minimum_salary }}</td>
                                <td>${{ $salary->maximum_salary }}</td>
                                <td>{{ $salary->created_at }}</td>
                                <td>
                                    <a href="{{ route('salaryscales.edit', $salary->id) }}" class="btn btn-primary">Edit</a>
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
