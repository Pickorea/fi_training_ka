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
              {{--{{dd($details->participant_first_name)}}--}}

                    <!-- Main content -->
                    <section class="content">
                        <!-- Default box -->
                        <div class="box">
                            <div class="box-header with-border">
                                <h3 class="box-title">{{ __('ENTER TRAINING INFOMATION AND DETAILS') }}</h3>

                                <div class="box-tools pull-right">
                                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                                    <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                                </div>
                            </div>
                            <div class="box-body">
                            <form method="POST" enctype="multipart/form-data" id="upload-file" action="{{ route('training.update',$training['id']) }}" >
                                                                    @csrf
                                 <input type="hidden" name="_method" value="PATCH">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">  
                                       
                                          <div class="box-body">
                                          <h4 class="box-title text-info"> SECTION A</h4>
                                                <hr class="my-15">
                                                <div class="row">
                                                   <div class="form-group col-md-6">
                                                   <label for="island_id">{{ __('ISLAND') }} <span class="text-danger">*</span></label>
                                                   <select name="island_id" id="island_id" class="form-control">
                                                        <option value="" selected disabled>{{ __('Select one') }}</option>
                                                        @foreach($islands as $island)
                                                         <option value="{{ $island['id'] }}" {{  $island['id'] == $training['island_id'] ? 'selected' : '' }}>{{ $island['island_name'] }}</option>
                                                        @endforeach
                                                    </select>
                                                          @if ($errors->has('island_id'))
                                                                <span class="help-block">
                                                                    <strong>{{ $errors->first('island_id') }}</strong>
                                                                </span>
                                                          @endif
                                                      
                                                   </div>
                                                   <div class="form-group col-md-6">
                                                   <label for="training_type_id">{{ __('TRAINING NAME') }} <span class="text-danger">*</span></label>
                                                   <select name="training_type_id" id="training_type_id" class="form-control">
                                                        <option value="" selected disabled>{{ __('Select one') }}</option>
                                                        @foreach($types as $trainingtype)
                                                            <option value="{{ $trainingtype['id'] }}" {{  $trainingtype['id'] == $training['training_type_id'] ? 'selected' : '' }}>{{ $trainingtype['training_name'] }}</option>
                                                        @endforeach
                                                    </select>
                                                          @if ($errors->has('training_type_id'))
                                                                <span class="help-block">
                                                                    <strong>{{ $errors->first('training_type_id') }}</strong>
                                                                </span>
                                                          @endif
                                                      
                                                   </div>
                                                <div class="row">
                                               
                                                   <div class="form-group col-md-6">
                                                      <label for="training_date"><span class="text-danger">*</span>TRAINING DATE</label>
                                                   
                                                          
                                                            <input type="date" class="form-control datepicker pull-right{{ $errors->has('training_date') ? ' is-invalid' : '' }}"  value="{{ \Carbon\Carbon::parse($training['training_date'])->format('Y-m-d') }}" id="training_date"  name="training_date" autocomplete="off">
                                                           @if(session()->has('error'))
                                                            <div class="alert alert-danger">
                                                               {{ session()->get('error') }}
                                                            </div>
                                                         @endif
                                                   
                                                   </div>
                                               </div>   
                                             
                                                <!-- new input -->
                                                <h4 class="box-title text-info"> SECTION B</h4>
                                                <hr class="my-15">
                                                <div class="row">
                                             
                                                   <div class="form-group col-md-2">
                                                   <label for="participant_first_name"><span class="text-danger">*</span> FIRST NAME</label>
                                                   <input type="text" class="form-control {{ $errors->has('participant_first_name') ? ' is-invalid' : '' }}" value="{{$details->participant_first_name}}" id="participant_first_name" placeholder="Enter a first name" name="participant_first_name" autocomplete="off">
                                                           @if(session()->has('error'))
                                                            <div class="alert alert-danger">
                                                               {{ session()->get('error') }}
                                                            </div>
                                                         @endif
                                                      
                                                   </div>
                                                   <div class="form-group col-md-2">
                                                   <label for="participant_last_name"><span class="text-danger">*</span> LAST NAME</label>
                                                   <input type="text" class="form-control {{ $errors->has('participant_last_name') ? ' is-invalid' : '' }}" value="{{$details->participant_last_name }}" id="participant_last_name" placeholder="Enter a last name" name="participant_last_name" autocomplete="off">
                                                           @if(session()->has('error'))
                                                            <div class="alert alert-danger">
                                                               {{ session()->get('error') }}
                                                            </div>
                                                         @endif
                                                      
                                                   </div>
                                                   <div class="form-group col-md-3">
                                                   <label for="village_id"><span class="text-danger">*</span> VILLAGE NAME</label>
                                                   <select name="village_id" id="island_id" class="form-control">
                                                        <option value="" selected disabled>{{ __('Select one') }}</option>
                                                        @foreach($villages as $village)

                                                        <option value="{{ $village['id'] }}" {{  $village['id'] == $details->village_id ? 'selected' : '' }}>{{ $village['village_name'] }}</option>
                                                       
                                                        @endforeach
                                                    </select>
                                                           @if(session()->has('error'))
                                                            <div class="alert alert-danger">
                                                               {{ session()->get('error') }}
                                                            </div>
                                                         @endif
                                                      
                                                   </div>
                                                   <div class="form-group col-md-2">
                                                   <label for="age">{{ __('AGE') }} <span class="text-danger">*</span></label>
                                                        <div class="form-group{{ $errors->has('age') ? ' has-error' : '' }} has-feedback">
                                                        <input type="text" class="form-control datepicker pull-right{{ $errors->has('age') ? ' is-invalid' : '' }}" value="{{$details->age}}" id="age" placeholder="Enter age" name="age" autocomplete="off">
                                                            @if ($errors->has('age'))
                                                            <span class="help-block">
                                                                <strong>{{ $errors->first('age') }}</strong>
                                                            </span>
                                                            @endif
                                                        </div>
                                                  
                                                   </div>

                                                   <div class="form-group col-md-3">
                                                   <label for="gender"><span class="text-danger">*</span> Gender</label>
                                                   <select name="gender" id="gender" class="form-control">
                                                        <option value="" selected disabled>{{ __('Select one') }}</option>
                                                       
                                                      <option value="1" {{$details->gender == 1 ? 'selected' : '' }}>{{ __('Male') }}</option>
                                                      <option value="0" {{$details->gender == 0 ? 'selected' : '' }}>{{ __('Female') }}</option>
                                                       
                                                    </select>
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

                       
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.0.0-alpha1/css/bootstrap.min.css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        
@endsection
   