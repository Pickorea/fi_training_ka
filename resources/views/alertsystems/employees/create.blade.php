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
                                <h3 class="box-title">{{ __('ENTER EMPLOYEES DETAILS') }}</h3>

                                <div class="box-tools pull-right">
                                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                                    <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                                </div>
                            </div>
                            <div class="box-body">
                            <form method="POST" enctype="multipart/form-data" id="upload-file" action="{{ route('employee.store') }}" >
                                                                    @csrf
                                       
                                          <div class="box-body">
                                          <h4 class="box-title text-info"> SECTION A</h4>
                                                <hr class="my-15">
                                                <div class="row">
                                               
                                                   <div class="form-group col-md-6">
                                                      <label for="name"><span class="text-danger">*</span> FULL NAME</label>
                                                   
                                                            <input type="text" class="form-control {{ $errors->has('name') ? ' is-invalid' : '' }}" value="{{ old('name') }}" id="name" placeholder="Enter a Full name" name="name" autocomplete="off">
                                                           @if(session()->has('error'))
                                                            <div class="alert alert-danger">
                                                               {{ session()->get('error') }}
                                                            </div>
                                                             @endif
                                                   
                                                   </div>

                                                   <div class="form-group col-md-6">
                                                      <label for="work_status_id"><span class="text-danger">*</span> Work Status</label>
                                                     
                                                      <select name="work_status_id" id="work_status_id" class="form-control">
                                                        <option value="" selected disabled>{{ __('Select one') }}</option>
                                                        @foreach($status as $statuc)
                                                        <option value="{{ $statuc['id'] }}">{{ $statuc['work_status_name'] }}</option>
                                                        @endforeach
                                                    </select>
                                                             @if ($errors->has('work_status_id'))
                                                               <span class="invalid-feedback" role="alert">
                                                               <strong>{{ $errors->first('work_status_id') }}</strong>
                                                            </span>
                                                            @endif
                                                   
                                                   </div>
                                                   <div class="form-group col-md-6">
                                                      <label for="age"><span class="text-danger">*</span> age</label>
                                                     
                                                            <input type="age" class="form-control {{ $errors->has('age') ? ' is-invalid' : '' }}" value="{{ old('age') }}" id="age" placeholder="Enter age" name="age" autocomplete="off">
                                                            @if ($errors->has('receive_date'))
                                                               <span class="invalid-feedback" role="alert">
                                                               <strong>{{ $errors->first('age') }}</strong>
                                                            </span>
                                                            @endif
                                                   
                                                   </div>
                                                   
                                                </div>
                                                <!-- new input -->
                                                <h4 class="box-title text-info"> SECTION B</h4>
                                                <hr class="my-15">
                                                <div class="row">
                                               
                                                   <div class="form-group col-md-6">
                                                      <label for="email"><span class="text-danger">*</span> Email</label>
                                                   
                                                            <input type="text" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" value="{{ old('email') }}" id="email" placeholder="Enter email name" name="email" autocomplete="off">
                                                           @if(session()->has('error'))
                                                            <div class="alert alert-danger">
                                                               {{ session()->get('error') }}
                                                            </div>
                                                         @endif
                                                   
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

                       
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.0-alpha1/css/bootstrap.min.css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        
@endsection
   