@extends('layouts.app')
@section('title', __('Department'))

@section('content')
<div class="container">
<div class="content-wrapper">

    <section class="content-header">
        <h1>
            {{ __('DEPARTMENTS') }}
        </h1>
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/home') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ url('/island') }}">Island List</a></li>
                <li class="breadcrumb-item active" aria-current="page">department List</li>
            </ol>
        </nav>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">{{ __('Manage department') }}</h3>

                <div class="box-header with-border">
                {{--@can('isUser')--}}
                        <div class="alert alert-info clearfix">
                            <a href="{{ route('department.create') }}" class="alert-link"><button type="button" class="btn btn-primary btn-sm float-end">{{ __(' Add department') }}</button></a> 
                          
                            {{--<a href="{{ route('excelreport.departmentexcel') }}" class="alert-link"><button type="button" class="btn btn-primary btn-sm float-start">{{ __('TO EXCEL') }}</button></a>--}}
                      
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
               <table  class="table">
                    <thead>
                        <tr>
                            <th>{{ __(' SL#') }}</th>
                            <th>{{ __(' Department Name') }}</th>
                            <th>{{ __(' Created At') }}</th>
                            <th class="text-center">{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody id="myTable">
                        @php $sl = 1; @endphp
                     
                        @foreach($departments as $department)
                        <tr>
                            <td>{{ $sl++ }}</td>
                            <td>{{ $department->department_name}}</td>
                            <td class="text-center">{{ date("d F Y", strtotime($department->created_at)) }}</td>
                            <td class="text-center">
                            <a class="btn btn-info text-center" href="{{route('department.show', $department->id)}}">Show</a>      
                               <a href="{{ route('department.edit', $department->id) }}"><i class="icon fa fa-edit"></i> {{ __('Edit') }}</a>
                              
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