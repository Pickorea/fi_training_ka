@extends('layouts.app')

@section('content')
<div class="container">
   <div class="row justify-content-center">
      <div class="col-md-12">
         <div class="card card-new-task">
            <div class="card-header"><h3 class="box-title">{{ __('EDIT EMPLOYEE WORK STATUS') }}</h3></div>
            <div class="card-body">
               <div class="content-wrapper">
                  <section class="content">
                     <div class="box">
                        <div class="box-header with-border">
                           <div class="box-tools pull-right">
                              <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                              <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                           </div>
                        </div>
                        <div class="box-body">
                           <form method="POST" enctype="multipart/form-data" id="upload-file" action="{{ route('employeeworkstatuses.store') }}">
                              @csrf
                              <div class="box-body">
                                 <div class="row">
                                    <div class="form-group col-md-6">
                                       <label for="employee_id">{{ __('EMPLOYEE') }} <span class="text-danger">*</span></label>
                                       <select name="employee_id" id="employee_id" class="form-control">
                                          <option value="" selected disabled>{{ __('Select one') }}</option>
                                          @foreach($employees as $id => $employee)
                                          <option value="{{$id}}" data-jobtitle="{{ $employee }}" @if(old('employee_id', $model->employee_id) == $id) selected @endif>{{ $employee }}</option>
                                          @endforeach
                                       </select>
                                       @error('employee_id')
                                       <span class="help-block">
                                          <strong>{{ $message }}</strong>
                                       </span>
                                       @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                       {{ html()->label('Job Title')->class('form-control-label')->for('job_title_id') }}
                                       <select name="job_title_id" id="job_title_id" class="form-control">
                                          <option value="" selected disabled>{{ __('Select one') }}</option>
                                       </select>
                                       @error('job_title_id')
                                       <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                       </span>
                                       @enderror
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="form-group col-md-6">
                                       <label for="start_date"><span class="text-danger">*</span>START DATE</label>
                                       <input type="date" class="form-control {{ $errors->has('start_date') ? ' is-invalid' : '' }}" value="{{ $model->start_date }}" id="start_date" name="start_date" autocomplete="off">
                                       @if ($errors->has('start_date'))
                                       <span class="invalid-feedback" role="alert">
                                          <strong>{{ $errors->first('start_date') }}</strong>
                                       </span>
                                       @endif
                                    </div>
                                    <div class="form-group col-md-6">
                                       <label for="end_date"><span class="text-danger">*</span>END DATE</label>
                                       <input type="date" class="form-control @error('end_date') is-invalid @enderror" value="{{ $model->end_date }}" id="end_date" name="end_date" autocomplete="off">
                                       @error('end_date')
                                       <span class="invalid-feedback" role="alert">
                                          <strong>{{ $message }}</strong>
                                       </span>
                                       @enderror
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="form-group col-md-6">
                                       <label for="vacancy_id">Vacancy</label>
                                       <select name="vacancy_id" id="vacancy_id" class="form-control">
                                          <option value="">Select a vacancy</option>
                                          @foreach ($vacancies as $vacancy)
                                          <option value="{{ $vacancy->id }}" {{ $model->vacancy_id == $vacancy->id ? 'selected' : '' }}>
                                             {{ $vacancy->jobTitle->name }} - {{ $vacancy->department->department_name }}
                                          </option>
                                          @endforeach
                                       </select>
                                    </div>
                                 </div>
                                 <div class="row">
                                    <div class="form-group">
                                       <label for="recommended_salary_scale_id">Recommended Salary Scale</label>
                                       <select name="recommended_salary_scale_id" id="recommended_salary_scale_id" class="form-control">
                                          <option value="">Select a salary scale level</option>
                                          @foreach ($salaryScales as $id => $salaryScale)
                                          <option value="{{ $id }}">{{ $salaryScale }}</option>
                                          @endforeach
                                       </select>
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
                     </div>
                  </section>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
   $(document).ready(function() {
     // Function to fetch job titles for the selected employee
     function fetchJobTitles(employeeId) {
       $('#job_title_id').empty();
       $('#vacancy_id').empty();
   
       if (employeeId) {
         $.ajax({
           url: '{{ url("employee/job_titles") }}/' + employeeId,
           method: 'GET',
           dataType: 'json',
           success: function(response) {
             if (response.data.length > 0) {
               $.each(response.data, function(index, jobTitle) {
                 var optionText = jobTitle.name + ' (' + $('#employee_id option:selected').data('jobtitle') + ')';
                 $('#job_title_id').append('<option value="' + jobTitle.id + '">' + optionText + '</option>');
               });
             } else {
               $('#job_title_id').append('<option value="">No job titles found</option>');
             }
   
             var selectedJobTitleId = $('#job_title_id').val();
             fetchVacancies(selectedJobTitleId);
           },
           error: function() {
             console.log('Error fetching job titles');
             $('#job_title_id').append('<option value="">Error fetching job titles</option>');
           }
         });
       }
     }
   
     function fetchVacancies(jobTitleId) {
       $('#vacancy_id').empty();
   
       if (jobTitleId) {
         $.ajax({
           url: '{{ url("vacancy/vacancys") }}/' + jobTitleId,
           method: 'GET',
           dataType: 'json',
           success: function(response) {
             if (response.data.length > 0) {
               $.each(response.data, function(index, vacancy) {
                 $('#vacancy_id').append('<option value="' + vacancy.id + '">' + vacancy.job_title_name + ' - ' + vacancy.department_name + '</option>');
               });
             } else {
               $('#vacancy_id').append('<option value="">No vacancies found</option>');
             }
           },
           error: function() {
             console.log('Error fetching vacancies');
             $('#vacancy_id').append('<option value="">Error fetching vacancies</option>');
           }
         });
       }
     }
   
     function fetchRecommendedSalaryScale(jobTitleId) {
       $('#recommended_salary_scale_id').empty();
   
       if (jobTitleId) {
         $.ajax({
           url: '{{ route("recommendedsalaryscales.getRecommendedSalaryScalesByJobTitle", ["job_title_id" => ":job_title_id"]) }}'
             .replace(':job_title_id', jobTitleId),
           method: 'GET',
           dataType: 'json',
           success: function(response) {
             if (response.data.length > 0) {
               $.each(response.data, function(index, recommendedSalaryScale) {
                 $('#recommended_salary_scale_id').append('<option value="' + recommendedSalaryScale.id + '">' + recommendedSalaryScale.name + '</option>');
               });
             } else {
               console.log('No recommended salary scales found for the job title');
               $('#recommended_salary_scale_id').append('<option value="">No recommended salary scales found</option>');
             }
           },
           error: function() {
             console.log('Error fetching recommended salary scales');
             $('#recommended_salary_scale_id').append('<option value="">Error fetching recommended salary scales</option>');
           }
         });
       }
     }
   
     // Employee dropdown change event
     $('#employee_id').on('change', function() {
       var employeeId = $(this).val();
       fetchJobTitles(employeeId);
     });
   
     // Job title dropdown change event
     $('#job_title_id').on('change', function() {
       var selectedJobTitleId = $(this).val();
       fetchVacancies(selectedJobTitleId);
     });
   
     // Vacancy dropdown change event
     $('#vacancy_id').on('change', function() {
       var selectedVacancyId = $(this).val();
       fetchRecommendedSalaryScale(selectedVacancyId);
     });
   
     // Function to check recommended salary scale
     function checkRecommendedSalaryScale(jobTitleId) {
       var selectedRecommendedSalaryScaleId = $('#recommended_salary_scale_id').val();
   
       if (selectedRecommendedSalaryScaleId) {
         $.ajax({
           url: '{{ route("recommendedsalaryscales.getRecommendedSalaryScalesByJobTitle", ["job_title_id" => ":job_title_id"]) }}'
             .replace(':job_title_id', jobTitleId),
           method: 'GET',
           dataType: 'json',
           success: function(response) {
             var recommendedSalaryScales = response.data;
             var match = false;
   
             for (var i = 0; i < recommendedSalaryScales.length; i++) {
               if (recommendedSalaryScales[i].id == selectedRecommendedSalaryScaleId) {
                 match = true;
                 break;
               }
             }
   
             if (!match) {
               alert('Selected recommended salary scale does not match the job title. Please select the correct recommended salary scale.');
             }
           },
           error: function() {
             console.log('Error checking recommended salary scale');
           }
         });
       }
     }
   
     // Recommended salary scale dropdown change event
     $('#recommended_salary_scale_id').on('change', function() {
       var selectedJobTitleId = $('#job_title_id').val();
       checkRecommendedSalaryScale(selectedJobTitleId);
     });
   });
</script>
@endsection
