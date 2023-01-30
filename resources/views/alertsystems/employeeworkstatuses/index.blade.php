@extends('layouts.app')
@section('title', __('Employee work status'))

@section('content')
<div class="container">
<div class="content-wrapper">

    <section class="content-header">
        <h1>
           {{--{{ __('NON PERMENANT EMPLOYEE WORK STATUS') }}--}}
        </h1>
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/home') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ url('/island') }}">Island List</a></li>
                <li class="breadcrumb-item active" aria-current="page">Employee List</li>
            </ol>
        </nav>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">{{ __('Manage Non Permenant Employee Work Status') }}</h3>

                <div class="box-header with-border">
                        <div class="alert alert-info clearfix">
                            <a href="{{ route('employeeworkstatuses.create') }}" class="alert-link"><button type="button" class="btn btn-primary btn-sm float-end">{{ __(' Add Employee Work Status') }}</button></a> 
                            <a href="{{ route('excelreport.activeExpireEmployeelist') }}" class="alert-link"><button type="button" class="btn btn-primary btn-sm float-start">{{ __('TO EXCEL') }}</button></a>
                        </div>
                     </div>
            </div>
            <div class="box-body">
                
            
            </div>
                
               

                <!-- Notification Box -->
                <div class="col-md-12">
                    @if (!empty(Session::get('message')))
                    <div class="alert alert-success alert-dismissible" id="notification_box">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <i class="icon fa fa-check"></i> {{ Session::get('message') }}
                    </div>
                    @elseif (!empty(Session::get('exception')))
                    <div class="alert alert-warning alert-dismissible" id="notification_box">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                        <i class="icon fa fa-warning"></i> {{ Session::get('exception') }}
                    </div>
                    @endif
                </div>
                <!-- /.Notification Box -->
        <div id="printable_area" class="col-md-12 table-responsive">
               <table  class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>{{ __(' SL#') }}</th>                     
                            <th>{{ __(' FULL NAME') }}</th>
                          <th>{{ __(' WORK STATUS') }}</th>
                            <th>{{ __(' START DATE') }}</th>
                            <th>{{ __(' END DATE') }}</th>
                            <th>{{ __('DAYS') }}</th>
                            <th>{{ __('ALERT') }}</th>
                            <!-- <th>{{ __(' Created At') }}</th> -->
                            <th class="text-center">{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody id="myTable">
                        @php $sl = 1; @endphp
                        @php
                        $now = Carbon::now();
                                       
                        @endphp
                      
           
                        @forelse($employees as $employeeworkstatus)
                        <tr>
                           
                        <td>{{ $sl++ }}</td>
                            <td>{{$employeeworkstatus->name}}</td>
                            @if ($employeeworkstatus->work_status_name !='Permenant')
                            <td>  {{$employeeworkstatus->work_status_name}}</td>
                            @elseif($employeeworkstatus->work_status_name ='Permenant') 
                            <td> {{$employeeworkstatus->unestablished =='unestblished'?'Archived':'Archived'}}</td>
                            @endif
                            <td>{{$employeeworkstatus->start_date}}</td>
                            <td>{{$employeeworkstatus->end_date}}</td>
                            @php
                            $start_date=Carbon::parse($employeeworkstatus->start_date);
                             $end_date=Carbon::parse($employeeworkstatus->end_date);
                            @endphp
                             <td>
                            {{ $start_date->diffInDays($end_date)}}
                            </td>
                            @if ($employeeworkstatus->start_date <= carbon::now())
                            <td  style="background-color:lightgreen">Expire</td>
                            @else ($employeeworkstatus->end_date >= carbon::now())
                            <td  style="background-color:lightyellow">Active</td>
                            @endif
                          
                           <td class="text-center">
                           <a  href="{{route('employeeworkstatuses.show', $employeeworkstatus->id)}}"><i class="icon fa fa-show"></i>{{__('Show')}}</a>      
                               <a href="{{ route('employeeworkstatuses.edit', $employeeworkstatus->id) }}"><i class="icon fa fa-edit"></i> {{ __('Edit') }}</a>
                            </td>
                        </tr>
                            
                            @empty
                            <p>
                                <strong>
                                    
                                <h4 class='card'> NO WORK STATUS AT THE MOMENT PLEASE COME BACK AGAIN </h4>
                               
                                </strong>
                            </p>
                          
                           
                      
                        @endforelse
                          
                        
                    </tbody>
                </table>
            </div>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </section>
    <!-- /.content -->
</div>
</div>
@endsection