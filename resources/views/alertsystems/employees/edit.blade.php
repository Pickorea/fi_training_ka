@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card card-new-task">
                <div class="card-header"></div>
                <div class="card-body">
                <div class="content-wrapper">
                <!-- Content Header (Page header) -->
              
                <!-- Main content -->
                <section class="content">
                    <!-- Default box -->
                    <div class="box">
                        <div class="box-header with-border">
                            <h3 class="box-title">{{ __('EDIT EMPLOYEES DETAILS') }}</h3>

                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                                <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                            </div>
                        </div>
                        <div class="box-body">
                         
                        <form action="{{ route('employee.update', $employee->id) }}" method="post" enctype="multipart/form-data">

                        @csrf
                        @method('PATCH')
                                                                     
                                      <div class="box-body">
                                      <h4 class="box-title text-info"> SECTION A</h4>
                                            <hr class="my-15">
                                            <div class="row">
                                           
                                               <div class="form-group col-md-6">
                                                  <label for="name"><span class="text-danger">*</span> FULL NAME</label>
                                               
                                                        <input type="text" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}"  value="{{$employee['name']}}" id="name" placeholder="Enter a Full name" name="name" autocomplete="off">
                                                       @if($errors->has('name'))
                                                        <div class="alert alert-danger">
                                                           {{ $errors->first('name') }}
                                                        </div>
                                                     @endif
                                               
                                               </div>

                                               <div class="form-group col-md-6">
                                                  <label for="work_status_id"><span class="text-danger">*</span> Work Status</label>
                                                 
                                                  <select name="work_status_id" id="work_status_id" class="form-control">
                                                    <option value="" selected disabled>{{ __('Select one') }}</option>
                                                    @foreach($status as $key => $statusName)
                                                        <option value="{{ $key }}" {{ $key == $employee->work_status_id ? 'selected' : '' }}>
                                                           {{ $statusName }}
                                                        </option>
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
                                                  
                                                           <input type="date" class="form-control {{ $errors->has('date_of_birth') ? ' is-invalid' : '' }}" value="{{ \Carbon\Carbon::parse($employee->date_of_birth)->format('Y-m-d') }}" id="date_of_birth" placeholder="Enter date_of_birth name" name="date_of_birth" autocomplete="off">
                                                           @if($errors->has('date_of_birth'))
                                                           <div class="alert alert-danger">
                                                              {{ $errors->first('date_of_birth') }}
                                                           </div>
                                                        @endif
                                                  
                                               </div>

                                               <div class="form-group col-md-6">
                                                  <label for="department_id"><span class="text-danger">*</span> Department Name</label>
                                                 
                                                  <select name="department_id" id="department_id" class="form-control">
                                                    <option value="" selected disabled>{{ __('Select one') }}</option>
                                                    @foreach($departments as $key => $department)
                                                        <option value="{{ $key }}" {{ $key == $employee->department_id ? 'selected' : '' }}>
                                                           {{ $department }}
                                                        </option>
                                                     @endforeach


                                                </select>
                                                         @if ($errors->has('department_id'))
                                                           <span class="invalid-feedback" role="alert">
                                                           <strong>{{ $errors->first('department_id') }}</strong>
                                                        </span>
                                                        @endif
                                               
                                               </div>
                                               
                                            </div>

                                            <div class="form-group col-md-6">
                                          {{ html()->label('Job Title')->class('form-control-label')->for('job_title_id') }}
                                          <select name="job_title_id" id="job_title_id" class="form-control">
                                             <option value="" selected disabled>{{ __('Select one') }}</option>
                                             @foreach($jobTitles as $key => $jobTitle)
                                                   <option value="{{ $key }}" {{ $key == $employee->job_title_id ? 'selected' : '' }}>
                                                      {{ $jobTitle }}
                                                   </option>
                                             @endforeach
                                          </select>
                                          @if ($errors->has('job_title_id'))
                                             <span class="invalid-feedback" role="alert">
                                                   <strong>{{ $errors->first('job_title_id') }}</strong>
                                             </span>
                                          @endif
                                       </div>

                                       <div class="form-group col-md-6">
    {{ html()->label('Salary Scale')->class('form-control-label')->for('salary_scale_id') }}
    <select name="salary_scale_id" id="salary_scale_id" class="form-control">
        <option value="" selected disabled>{{ __('Select one') }}</option>
        @foreach($salaryScales as $salaryScale)
            <option value="{{ $salaryScale->id }}" {{ $salaryScale->id == $employee->salary_scale_id ? 'selected' : '' }}>
                {{ $salaryScale->name }}
            </option>
        @endforeach
    </select>
    @if ($errors->has('salary_scale_id'))
        <span class="invalid-feedback" role="alert">
            <strong>{{ $errors->first('salary_scale_id') }}</strong>
        </span>
    @endif
</div>


                                            
                                            <!-- new input -->
                                            <h4 class="box-title text-info"> SECTION B</h4>
                                            <hr class="my-15">
                                            <div class="row">
                                           
                                               <div class="form-group col-md-6">
                                                  <label for="email"><span class="text-danger">*</span> Email</label>
                                               
                                                        <input type="text" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{$employee['email']}}" id="email" placeholder="Enter a Email" name="email" autocomplete="off">
                                                       @if($errors->has('email'))
                                                        <div class="alert alert-danger">
                                                           {{ $errors->first('email') }}
                                                        </div>
                                                     @endif
                                               
                                               </div>

                                               <div class="form-group col-md-6">
                                               {{ html()->label('Present Address')->class('form-control-label')->for('present_address') }}
                                               
                                                        <input type="text" class="form-control {{ $errors->has('present_address') ? ' is-invalid' : '' }}" value="{{ $employee->present_address}}" id="present_address" placeholder="Enter present_address name" name="present_address" autocomplete="off">
                                                       @if($errors->has('present_address'))
                                                        <div class="alert alert-danger">
                                                           {{ $errors->first('present_address') }}
                                                        </div>
                                                     @endif
                                               
                                               </div>
                                               
                                               
                                            </div>

                                            <div class="row">
                                           
                                           <div class="form-group col-md-6">
                                           {{ html()->label('PF Number')->class('form-control-label')->for('pf_number') }}
                                           
                                                    <input type="text" class="form-control {{ $errors->has('pf_number') ? ' is-invalid' : '' }}" value="{{$employee->pf_number}}" id="pf_number" placeholder="Enter pf_number name" name="pf_number" autocomplete="off">
                                                   @if($errors->has('pf_number'))
                                                    <div class="alert alert-danger">
                                                       {{ $errors->first('pf_number') }}
                                                    </div>
                                                 @endif
                                           
                                           </div>

                                           <div class="form-group col-md-6">
                                           {{ html()->label('Gender')->class('form-control-label')->for('gender') }}
                                   
                                           <select name="gender" id="gender" class="form-control">
                                                <option value="" selected disabled>{{ __('Select one') }}</option>
                                              
                                                <option value="1" {{$employee->gender == '1' ? 'selected' : '' }}>{{ __('Male') }}</option>
                                                  <option value="0" {{$employee->gender =='0' ? 'selected' : '' }}>{{ __('Female') }}</option>
                                                
                                            </select>
                                                   @if($errors->has('gender'))
                                                    <div class="alert alert-danger">
                                                       {{ $errors->first('gender') }}
                                                    </div>
                                                 @endif
                                           
                                           </div>
                                           
                                        </div> 

                                        <div class="row">
                                       
                                       <div class="form-group col-md-6">
                                       {{ html()->label('Joining Date')->class('form-control-label')->for('joining_date') }}
                                       
                                                <input type="date" class="form-control {{ $errors->has('joining_date') ? ' is-invalid' : '' }}" value="{{ \Carbon\Carbon::parse($employee->joining_date)->format('Y-m-d') }}"  id="joining_date" placeholder="Enter joining_date name" name="joining_date" autocomplete="off">
                                               @if($errors->has('joining_date'))
                                                <div class="alert alert-danger">
                                                   {{ $errors->first('joining_date') }}
                                                </div>
                                             @endif
                                       
                                       </div>

                                       <div class="form-group col-md-6">
                                       {{ html()->label('Martial Status')->class('form-control-label')->for('marital_status') }}
                                           <select name="marital_status" id="marital_status" class="form-control">

                                               <option value="" selected disabled>{{ __('Select one') }}</option>
                                               <option value="1" {{$employee->marital_status == '1' ? 'selected' : '' }}>{{ __('Married') }}</option>
                                               <option value="2" {{$employee->marital_status =='2' ? 'selected' : '' }}>{{ __('Single') }}</option>
                                               <option value="3" {{$employee->marital_status =='3' ? 'selected' : '' }}>{{ __('Divorced') }}</option>
                                               <option value="4" {{$employee->marital_status =='4' ? 'selected' : '' }}>{{ __('Separated') }}</option>
                                               <option value="5" {{$employee->marital_status =='5' ? 'selected' : '' }}>{{ __('Widowed') }}</option>
                                               
                                            </select>
                                               @if($errors->has('marital_status'))
                                                <div class="alert alert-danger">
                                                   {{ $errors->first('marital_status') }}
                                                </div>
                                             @endif
                                       
                                       </div>

                                       <label for="picture">{{ __('Picture') }}<span class="text-danger">*</span></label>
                                             <div class="form-group{{ $errors->has('picture') ? ' has-error' : '' }} has-feedback">
                                                <input type="file" id="picture" name="picture" class="form-control">
                                                @if ($errors->has('picture'))
                                                   <span class="help-block">
                                                         <strong>{{ $errors->first('picture') }}</strong>
                                                   </span>
                                                @endif
                                             </div>

                                             <div>
                                                <label>{{ __('Current Picture:') }}</label>
                                                <div class="mb-2">
                                                   <img src="{{ asset('uploads/employees/' . $employee->picture) }}" alt="Profile Picture" style="max-width: 200px">
                                                </div>
                                             </div>

                                       
                                    </div> 

                                           
                                      <!-- /.box-body -->
                                      <div class="box-footer text-right">
                                            <button type="submit" class="btn btn-primary btn-outline">
                                               <i class="ti-save-alt"></i> Update
                                            </button>
                                            <a class="btn btn-warning btn-outline mr-1" href="">
                                               <i class="ti-trash"></i> Cancel
                                            </a>
                                      </div>
                                      <!-- /.box-footer -->
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
   