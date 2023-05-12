@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card card-new-task">
                <div class="card-header">
                    <h3>{{ __('ENTER JOB TITLE DETAILS') }}</h3>
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
                                    {{ html()->form('POST', route('jobtitle.store'))->open() }}

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                {{ html()->label('Job Title Name')->class('form-control-label')->for('name') }}
                                                <input type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ old('name') }}" id="name" placeholder="Enter a Job title name" name="name" autocomplete="off">
                                                @if($errors->has('name'))
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('name') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                {{ html()->label('Department Name')->class('form-control-label')->for('department_id') }}
                                                <select name="department_id" id="department_id" class="form-control{{ $errors->has('department_id') ? ' is-invalid' : '' }}">
                                                    <option value="" selected disabled>{{ __('Select one') }}</option>
                                                    @foreach($departments as $key => $department)
                                                        <option value="{{ $key }}">{{ $department }}</option>
                                                    @endforeach
                                                </select>
                                                @if($errors->has('department_id'))
                                                    <div class="invalid-feedback">
                                                        {{ $errors->first('department_id') }}
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <table class="table table-bordered table-hover" id="job_descriptions_table">
                                                <thead>
                                                    <tr>
                                                        <th>Description</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr id="job_description1">
                                                        <td>
                                                            <textarea class="form-control" id="description1" placeholder="Enter a Job Description" name="description[]" autocomplete="off"></textarea>
                                                        </td>
                                                        <td>
                                                            <button type="button" name="add_row" id="add_row" class="btn btn-success"><i class="fa fa-plus"></i>Add</button>
                                                            <!-- <button type="button" name="delete_row" id="delete_row" class="btn btn-danger"><i class="fa fa-trash"></i>Minus</button> -->
                                                         </td>
                                                      </tr>
                                                      </tbody>
                                                      </table>
                                                      </div>
                                                      </div>
                                                      <div class="row">
                                                         <div class="col-md-12">
                                                            <div class="form-group">
                                                               <button type="submit" class="btn btn-primary">{{ __('Save') }}</button>
                                                               <a href="{{ route('jobtitle.index') }}" class="btn btn-danger">{{ __('Cancel') }}</a>
                                                            </div>
                                                         </div>
                                                   </div>

                                                   {{ html()->form()->close() }}
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function () {
        var row_id = 1;
        $("#add_row").click(function () {
            row_id++;
            var html = '';
            html += '<tr id="job_description' + row_id + '">';
            html += '<td><textarea class="form-control" id="description' + row_id + '" placeholder="Enter a Job Description" name="description[]" autocomplete="off"></textarea></td>';
            html += '<td><button type="button" name="remove_row" id="' + row_id + '" class="btn btn-danger btn-sm remove_row"><i class="fa fa-trash"></i>Minus</button></td>';
        html += '</tr>';
        $('#job_descriptions_table').append(html);
    });

    $(document).on('click', '.remove_row', function () {
        var row_id = $(this).attr("id");
        $('#job_description' + row_id).remove();
    });
});
</script>






