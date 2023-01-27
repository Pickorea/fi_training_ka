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
         <h3 class="box-title">{{ __('ENTER EMPLOYEE WORK STATUS') }}</h3>

         <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
         </div>
      </div>
      <div class="box-body">
      <form method="POST" enctype="multipart/form-data" id="upload-file" action="{{ route('employeeworkstatuses.update',$workstatus['id']) }}" >
                                             @csrf
         <input type="hidden" name="_method" value="PATCH">
         <input type="hidden" name="_token" value="{{ csrf_token() }}">                                         
               
                  <div class="box-body">
                  <h4 class="box-title text-info"> SECTION A</h4>
                        <hr class="my-15">
                        <div class="row">
                           <div class="form-group col-md-6">
                           <label for="employee_id">{{ __('EMPLOYEE') }} <span class="text-danger">*</span></label>
                           <select name="employee_id" id="employee_id" class="form-control">
                                 <option value="" selected disabled>{{ __('Select one') }}</option>
                                 @foreach($employees as $employee)
                                 <option value="{{ $employee['id'] }}">{{ $employee['employee_name'] }}</option>
                                 @endforeach
                              </select>
                                    @if ($errors->has('employee_id'))
                                          <span class="help-block">
                                             <strong>{{ $errors->first('employee_id') }}</strong>
                                          </span>
                                    @endif
                              
                           </div>
                           <div class="form-group col-md-6">
                           <label for="work_status_id">{{ __('WORK STATUS') }} <span class="text-danger">*</span></label>
                           <select name="work_status_id" id="work_status_id" class="form-control">
                                 <option value="" selected disabled>{{ __('Select one') }}</option>
                                 @foreach($workstatuses as $workstatus)
                                 <option value="{{ $workstatus['id'] }}">{{ $workstatus['work_status_name'] }}</option>
                                 @endforeach
                              </select>
                                    @if ($errors->has('work_status_id'))
                                          <span class="help-block">
                                             <strong>{{ $errors->first('work_status_id') }}</strong>
                                          </span>
                                    @endif
                              
                           </div>
                        <div class="row">
                        
                           <div class="form-group col-md-6">
                              <label for="start_date"><span class="text-danger">*</span>START DATE</label>
                           
                                    <input type="date" class="form-control {{ $errors->has('start_date') ? ' is-invalid' : '' }}" value="{{ old('start_date') }}" id="start_date"  name="start_date" autocomplete="off">
                                    @if(session()->has('error'))
                                    <div class="alert alert-danger">
                                       {{ session()->get('error') }}
                                    </div>
                                 @endif
                           
                           </div>
                        </div>   

                        <div class="row">
                        
                           <div class="form-group col-md-6">
                              <label for="end_date"><span class="text-danger">*</span>END DATE</label>
                           
                                    <input type="date" class="form-control {{ $errors->has('end_date') ? ' is-invalid' : '' }}" value="{{ old('end_date') }}" id="end_date"  name="start_date" autocomplete="off">
                                    @if(session()->has('error'))
                                    <div class="alert alert-danger">
                                       {{ session()->get('error') }}
                                    </div>
                                 @endif
                           
                           </div>
                        </div>   
                     
                        
                  <!-- /.box-body -->
                  <div class="box-footer text-right">
                        <button type="submit" class="btn btn-primary btn-outline">
                           <i class="ti-save-alt"></i> Save
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
