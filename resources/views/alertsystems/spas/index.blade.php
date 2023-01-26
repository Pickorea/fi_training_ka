@extends('layouts.app')
@section('title', __('EMPLOYEE PERFORMANCE ASSESSMENT'))

@section('content')


    <section class="content-header">
        <h1>
            {{ __('EMPLOYEE PERFORMANCE ASSESSMENT') }}
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
                <h3 class="box-title">{{ __('Employee Performance Assessment File') }}</h3>

                <div class="box-header with-border">
                        <div class="alert alert-info clearfix">
                            <a href="{{ route('spas.create') }}" class="alert-link"><button type="button" class="btn btn-primary btn-sm float-end">{{ __(' Add SPA File') }}</button></a> 
                        </div>
                     </div>
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
        <div id="printable_area" class="col-md-12 table-responsive">
               <table  class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>{{ __(' SL#') }}</th>
                                       
                            <th>{{ __(' File Name') }}</th>
                            <th>{{ __(' From Date') }}</th>
                            <th>{{ __(' To Date') }}</th>
                            <!-- <th>{{ __(' Alert') }}</th> -->
                            <th>{{ __(' Created At') }}</th>
                            <th class="text-center">{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody id="myTable">
                     
                        <!-- @php
                        $now = Carbon::now();
                 
                        @endphp -->
                      
                        @foreach($spas as $spa)
                        <tr>
                            
                            <td>{{ $spa->id }}</td>
                            
                            <td>{{ $spa['file_name'] }}</td>
                            <td> {{ $spa->from_date }}</td>
                            <td> {{ $spa->to_date }}</td>
                            <!-- @if ($now->between ($spa->from_date,$spa->to_date))
                            <td  class="alert alert-success">Active</td>
                            @else
                            <td class="alert alert-warning">Expired</td>
                            @endif -->
                      
                      
                           
                           
                            <td class="text-center">{{ date("d F Y", strtotime($spa['created_at'])) }}</td>
                           
                           
                            <td class="text-center">
                            <a class="btn btn-info text-center" href="{{route('spas.show', $spa['id'])}}">Show</a>      
                               <a href="{{ route('spas.edit', $spa['id']) }}"><i class="icon fa fa-edit"></i> {{ __('Edit') }}</a>
                              
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
    </section>
    <!-- /.content -->
@endsection

@push('custom-scripts')
<link href="{{ asset('css/app.css') }}" rel="stylesheet">

@endpush