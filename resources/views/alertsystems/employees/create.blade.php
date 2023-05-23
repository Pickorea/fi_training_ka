@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card card-new-task">
                <div class="card-header">
                  <div class="box-header with-border">
                        <h3 class="box-title">{{ __('ENTER EMPLOYEES DETAILS') }}</h3>

                        <div class="box-tools pull-right">
                            <button type="button" class="btn btn-box-tool" data-widget="collapse"
                                data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                            <button type="button" class="btn btn-box-tool" data-widget="remove"
                                data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                        </div>
                    </div>
</div>
                <div class="card-body">
                <div class="content-wrapper">
                <!-- Content Header (Page header) -->
              

                    <!-- Main content -->
                    <section class="content">
                        <!-- Default box -->
                        <div class="box">
                            
                            <div class="box-body">
                            <form method="POST" enctype="multipart/form-data" id="upload-file" action="{{ route('employee.store') }}">
    @csrf
    <div class="box-body">
        <h4 class="box-title text-info">SECTION A</h4>
        <hr class="my-15">
        <div class="row">
            <div class="form-group col-md-6">
                {{ html()->label('FULL NAME')->class('form-control-label')->for('name') }}
                <input type="text" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ old('name') }}" id="name" placeholder="Enter a Full name" name="name" autocomplete="off">
                @if(session()->has('error'))
                    <div class="alert alert-danger">
                        {{ session()->get('error') }}
                    </div>
                @endif
            </div>
            <div class="form-group col-md-6">
                {{ html()->label('Work Status')->class('form-control-label')->for('work_status_id') }}
                <select name="work_status_id" id="work_status_id" class="form-control">
                    <option value="" selected disabled>{{ __('Select one') }}</option>
                    @foreach($status as $key => $statuc)
                        <option value="{{ $key }}">{{ $statuc }}</option>
                    @endforeach
                </select>
                @if ($errors->has('work_status_id'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('work_status_id') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group col-md-6">
                {{ html()->label('DoB')->class('form-control-label')->for('date_of_birth') }}
                <input type="date" class="form-control {{ $errors->has('date_of_birth') ? ' is-invalid' : '' }}" value="{{ old('date_of_birth') }}" id="date_of_birth" placeholder="Enter date_of_birth name" name="date_of_birth" autocomplete="off">
                @if(session()->has('error'))
                    <div class="alert alert-danger">
                        {{ session()->get('error') }}
                    </div>
                @endif
            </div>
            <div class="form-group col-md-6">
                {{ html()->label('Department Name')->class('form-control-label')->for('department_id') }}
                <select name="department_id" id="department_id" class="form-control">
                    <option value="" selected disabled>{{ __('Select one') }}</option>
                    @foreach($departments as $key => $department)
                        <option value="{{ $key }}">{{ $department }}</option>
                    @endforeach
                </select>
                @if ($errors->has('age'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('department_id') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group col-md-6">
                {{ html()->label('Job Title')->class('form-control-label')->for('job_title_id') }}
                <select name="job_title_id" id="job_title_id" class="form-control" >
                    <option value="" selected disabled>{{ __('Select one') }}</option>
                </select>
                @if ($errors->has('age'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('job_title_id') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group col-md-6">
                {{ html()->label('Salary Scale')->class('form-control-label')->for('salary_scale_id') }}
                <select name="salary_scale_id" id="salary_scale_id" class="form-control" >
                    <option value="" selected disabled>{{ __('Select one') }}</option>
                </select>
                @if ($errors->has('salary_scale_id'))
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $errors->first('salary_scale_id') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <h4 class="box-title text-info">SECTION B</h4>
        <hr class="my-15">
        <div class="row">
            <div class="form-group col-md-6">
                {{ html()->label('Email')->class('form-control-label')->for('email') }}
                <input type="text" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email') }}" id="email" placeholder="Enter email name" name="email" autocomplete="off">
                @if(session()->has('error'))
                    <div class="alert alert-danger">
                        {{ session()->get('error') }}
                    </div>
                @endif
            </div>
            <div class="form-group col-md-6">
                {{ html()->label('Present Address')->class('form-control-label')->for('present_address') }}
                <input type="text" class="form-control {{ $errors->has('present_address') ? ' is-invalid' : '' }}" value="{{ old('present_address') }}" id="present_address" placeholder="Enter present_address name" name="present_address" autocomplete="off">
                @if(session()->has('error'))
                    <div class="alert alert-danger">
                        {{ session()->get('error') }}
                    </div>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-6">
                {{ html()->label('PF Number')->class('form-control-label')->for('pf_number') }}
                <input type="text" class="form-control {{ $errors->has('pf_number') ? ' is-invalid' : '' }}" value="{{ old('pf_number') }}" id="pf_number" placeholder="Enter pf_number name" name="pf_number" autocomplete="off">
                @if(session()->has('error'))
                    <div class="alert alert-danger">
                        {{ session()->get('error') }}
                    </div>
                @endif
            </div>
            <div class="form-group col-md-6">
                {{ html()->label('Gender')->class('form-control-label')->for('gender') }}
                <select name="gender" id="gender" class="form-control">
                    <option value="" selected disabled>{{ __('Select one') }}</option>
                    <option value="1">{{ __('Male') }}</option>
                    <option value="0">{{ __('Female') }}</option>
                </select>
                @if(session()->has('error'))
                    <div class="alert alert-danger">
                        {{ session()->get('error') }}
                    </div>
                @endif
            </div>
        </div>
        <div class="row">
            <div class="form-group col-md-6">
                {{ html()->label('Joining Date')->class('form-control-label')->for('joining_date') }}
                <input type="date" class="form-control {{ $errors->has('joining_date') ? ' is-invalid' : '' }}" value="{{ old('joining_date') }}" id="joining_date" placeholder="Enter joining_date name" name="joining_date" autocomplete="off">
                @if(session()->has('error'))
                    <div class="alert alert-danger">
                        {{ session()->get('error') }}
                    </div>
                @endif
            </div>
            <div class="form-group col-md-6">
                {{ html()->label('Marital Status')->class('form-control-label')->for('marital_status') }}
                <select name="marital_status" id="marital_status" class="form-control">
                    <option value="" selected disabled>{{ __('Select one') }}</option>
                    <option value="1">{{ __('Married') }}</option>
                    <option value="2">{{ __('Single') }}</option>
                    <option value="3">{{ __('Divorced') }}</option>
                    <option value="4">{{ __('Separated') }}</option>
                    <option value="5">{{ __('Widowed') }}</option>
                </select>
                @if(session()->has('error'))
                    <div class="alert alert-danger">
                        {{ session()->get('error') }}
                    </div>
                @endif
            </div>
            <label for="picture">{{ __('Picture  ') }}<span class="text-danger">*</span></label>
            <div class="form-group{{ $errors->has('picture') ? ' has-error' : '' }} has-feedback">
                <input type="file" id="picture" name="picture" class="form-control">
                @if ($errors->has('picture'))
                    <span class="help-block">
                        <strong>{{ $errors->first('picture') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="box-footer text-right">
            <button type="submit" class="btn btn-primary btn-outline">
                <i class="ti-save-alt"></i> Save
            </button>
            <a class="btn btn-warning btn-outline mr-1" href="">
                <i class="ti-trash"></i> Cancel
            </a>
        </div>
    </div>
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

                          
                                           
            
@endsection
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function() {
    // When the department select value changes
    $('#department_id').change(function() {
        var departmentId = $(this).val();

        // Clear the job title select and disable it
        $('#job_title_id').empty().prop('disabled', true);
        $('#salary_scale_id').empty().prop('disabled', true);

        if (departmentId) {
            // Send an AJAX request to fetch job titles based on the selected department
            $.ajax({
                url: '{{ url("jobtitle/jobtitles") }}/' + departmentId,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    console.log(data); // Add this line to debug the response
                    $('#job_title_id').empty();
                    $('#job_title_id').append('<option value="" selected disabled>Select job title</option>');
                    $.each(data.data, function(key, jobTitle) {
                        $('#job_title_id').append('<option value="' + jobTitle.id + '">' + jobTitle.name + '</option>');
                    });
                    $('#job_title_id').prop('disabled', false);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown); // Add this line to debug any errors
                }
            });
        } else {
            // Disable the job title and salary scale selects if no department is selected
            $('#job_title_id').empty().prop('disabled', true);
            $('#salary_scale_id').empty().prop('disabled', true);
        }
    });

    // Attach change event handler to the job title select
    $('#job_title_id').on('change', function() {
        // Get the selected job_title_id
        var jobTitleId = $(this).val();

        // Check if a job title is selected
        if (jobTitleId) {
            // Send an AJAX request to fetch salary scales based on the selected job title
            $.ajax({
                url: '{{ url("salaryscales/salaryscales/") }}/' + jobTitleId,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    console.log(data); // Debug the response data
                    $('#salary_scale_id').empty();
                    $('#salary_scale_id').append('<option value="" selected disabled>Select salary scale</option>');
                    $.each(data.data, function(key, salaryScale) {
                        $('#salary_scale_id').append('<option value="' + salaryScale.id + '">' + salaryScale.name + '</option>');
                    });
                    $('#salary_scale_id').prop('disabled', false);
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown); // Debug any errors
                }
            });
        } else {
            // Disable the salary scale select if no job title is selected
            $('#salary_scale_id').empty().prop('disabled', true);
        }
    });
});
</script>
