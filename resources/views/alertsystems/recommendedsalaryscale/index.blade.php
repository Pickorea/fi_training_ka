@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row">
                <div class="col-md-6">
                    <h6 class="m-0 font-weight-bold text-primary">Recommended Salary Scales</h6>
                </div>
                <div class="col-md-6 text-right">
                    <a href="{{ route('recommendedsalaryscales.create') }}" class="btn btn-success btn-icon-split">
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
                            <th>Name</th>
                            <th>Job Title</th>
                            <th>Recommended Minimum Salary</th>
                            <th>Recommended Maximum Salary</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($recommendedSalaryScales as $recommendedSalaryScale)
                        <tr>
                            <td>{{ $recommendedSalaryScale->name }}</td>
                            <td>{{ $recommendedSalaryScale->jobTitle->name }}</td>
                            <td>{{ $recommendedSalaryScale->recommended_minimum_salary }}</td>
                            <td>{{ $recommendedSalaryScale->recommended_maximum_salary }}</td>
                            <td>
                                <a href="{{ route('recommendedsalaryscales.edit', $recommendedSalaryScale->id) }}" class="btn btn-warning btn-icon-split btn-sm">
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
