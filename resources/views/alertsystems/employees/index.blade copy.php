@extends('layouts.app')
@section('title', __('Employee'))

@section('content')
<div class="container">
<div class="content-wrapper">

    <section class="content-header">
        <h1>
            {{ __('EMPLOYEE') }}
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
                <h3 class="box-title">{{ __('Manage Employee') }}</h3>

                <div class="box-header with-border">
                {{--@can('isUser')--}}
                        <div class="alert alert-info clearfix">
                            <a href="{{ route('employee.create') }}" class="alert-link"><button type="button" class="btn btn-primary btn-sm float-end">{{ __(' Add Employee') }}</button></a> 
                          
                            <a href="{{ route('excelreport.employeeexcel') }}" class="alert-link"><button type="button" class="btn btn-primary btn-sm float-start">{{ __('TO EXCEL') }}</button></a>
                      
                            <a href="{{ route('excelreport.pdf') }}" class="alert-link"><button type="button" class="btn btn-primary btn-sm float-middle">{{ __('TO PDF') }}</button></a>
                        </div>
                     </div>
                {{--@endcan--}}
            </div>
            <div class="box-body">
                
            
            </div>
                
                <div  class="col-md-6">
                    <input type="text" id="myInput" class="form-control" placeholder="{{ __('Search..') }}">
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
         {{--@can('isAdmin')--}}
        <div id="printable_area" class="col-md-12 table-responsive">
               <table  class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>{{ __(' SL#') }}</th>
                            <th>{{ __(' Full Name') }}</th>
                            <th>{{ __(' Martial Status') }}</th>
                            <th>{{ __(' Email') }}</th>
                            <th>{{ __(' Work Status') }}</th>
                            <th>{{ __(' PF') }}</th>
                            <th>{{ __(' Joining Date') }}</th>
                            <th>{{ __(' Gender') }}</th> 
                            <th>{{ __(' DoB') }}</th>
                            <th class="text-center">{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody id="myTable">
                        @php $sl = 1; @endphp
                     
                        @foreach($employees as $employee)
                        <tr>
                            <td>{{ $sl++ }}</td>
                            <td>{{ $employee->name}}</td>
                            <td>{{ $employee->marital_status === "1"?"Maried":
                                ($employee->marital_status === "2"?"Single":
                                ($employee->marital_status === "3"?"Divorced":
                                ($employee->marital_status === "4"?"Separated":"Widowed")))}}</td>
                            <td>{{ $employee->email}}</td>
                            <td>{{ $employee->work_status_name}}</td>
                            <td>{{ $employee->pf_number}}</td>
                            <td>{{ date("d F Y", strtotime($employee->joining_date))}}</td>
                            <td>{{ $employee->gender === "1"?"Male":"Female"}}</td>
                            <td>{{ date("d F Y", strtotime($employee->date_of_birth))}}</td>
                   
                          
                           
                           
                            <td class="text-center">
                            <a href="{{route('employee.show', $employee->id)}}">Show</a>      
                            <a href="{{ route('employee.edit', $employee->id) }}"><i class="icon fa fa-edit"></i> {{ __('Edit') }}</a>
                              
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
        {{--@endcan--}}
    </section>
    <!-- /.content -->
</div>
</div>
@endsection