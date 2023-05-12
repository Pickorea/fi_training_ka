@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card card-new-task">
                <div class="card-header">
                    <h3>{{ __('ENTER JOB TITLE SALARY LEVEL') }}</h3>
                </div>
                <div class="card-body">
                <div class="content-wrapper">
                <!-- Content Header (Page header) -->
              

                    <!-- Main content -->
                    <section class="content">
                        <!-- Default box -->
                        <div class="box">
                            <div class="box-header with-border">

                                <div class="box-tools pull-right">
                                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                                    <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                                </div>
                            </div>
                                <div class="box-body">
                                <form method="POST" action="{{ route('salaryscales.store') }}">
    @csrf

                                <div class="form-group">
                                    <label for="job_title_id">Job Title:</label>
                                    <select class="form-control" id="job_title_id" name="job_title_id">
                                        
                                        @foreach($jobTitles as $keys => $jobTitle)
                                            <option value="{{ $keys }}">{{ $jobTitle}}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="minimum_salary">Minimum Salary:</label>
                                    <input type="number" class="form-control" id="minimum_salary" name="minimum_salary">
                                </div>

                                <div class="form-group">
                                    <label for="maximum_salary">Maximum Salary:</label>
                                    <input type="number" class="form-control" id="maximum_salary" name="maximum_salary">
                                </div>
                                <div class="form-group">
                                    <label for="name">Salary Level:</label>
                                    <input type="text" class="form-control" id="name" name="name">
                                </div>

                                <button type="submit" class="btn btn-primary">Create Salary Scale</button>
                            </form>

                                                </div>
                        <!-- /.box-body -->
                    </div>
                    <!-- /.box -->
                </section>
                <!-- /.content -->
            </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection







