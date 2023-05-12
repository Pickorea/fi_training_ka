@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">{{ $salaryScale->jobTitle->name }}</div>

                    <div class="panel-body">
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>Job Title:</td>
                                    <td>{{ $salaryScale->jobTitle->name }}</td>
                                </tr>
                                <tr>
                                    <td>Minimum Salary:</td>
                                    <td>{{ $salaryScale->minimum_salary }}</td>
                                </tr>
                                <tr>
                                    <td>Maximum Salary:</td>
                                    <td>{{ $salaryScale->maximum_salary }}</td>
                                </tr>
                                <tr>
                                    <td>Created At:</td>
                                    <td>{{ $salaryScale->created_at }}</td>
                                </tr>
                                <tr>
                                    <td>Updated At:</td>
                                    <td>{{ $salaryScale->updated_at }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
