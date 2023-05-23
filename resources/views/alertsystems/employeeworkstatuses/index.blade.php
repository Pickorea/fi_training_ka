@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="col-md-6">
        <h6 class="m-0 font-weight-bold text-primary">Employee Work Statuses</h6>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="d-flex">
                    <a href="{{ route('employeeworkstatuses.create') }}" class="btn btn-success btn-icon-split">
                        <span class="icon text-white-50">
                            <i class="fas fa-plus"></i>
                        </span>
                        <span class="text">Create</span>
                    </a>
                  
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Employee</th>
                            <th>WORK STATUS</th>
                            <th>START DATE</th>
                            <th>END DATE</th>
                            <th>DAYS COUNT</th>
                            <th>DEPARTMENT</th>
                            <th>JOB TITLE</th>
                            <th>SALARY SCALE</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($employees as $employee)
                        <tr>
                            <td>{{ $employee->name }}</td>
                            <td>{{ $employee->work_status_name }}</td>
                            <td>{{ $employee->start_date }}</td>
                            <td>{{ $employee->end_date }}</td>
                            <td>{{ $employee->day_count }}</td> <!-- Display the day count -->
                            <td>{{ $employee->department_name }}</td>
                            <td>{{ $employee->job_title_name }}</td>
                            <td>{{ $employee->recommended_salary_scale }}</td>
                            <td>{{ $employee->status }}</td>
                            <td>
                                <a href="{{ route('employeeworkstatuses.show', $employee->id) }}" class="btn btn-primary btn-icon-split btn-sm">
                                    <span class="icon text-white-50">
                                        <i class="fas fa-eye"></i>
                                    </span>
                                    <span class="text">View</span>
                                </a>
                                <a href="{{ route('employeeworkstatuses.edit', $employee->id) }}" class="btn btn-warning btn-icon-split btn-sm">
                                    <span class="icon text-white-50">
                                        <i class="fas fa-pencil-alt"></i>
                                    </span>
                                    <span class="text">Edit</span>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

