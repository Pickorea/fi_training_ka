@extends('layouts.app')
@section('title', __('Training'))

@section('content')
<div class="container">
<div class="content-wrapper">

    <section class="content-header">
        <h1>
            {{ __('TRAININGS') }}
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
                <h3 class="box-title">{{ __('Manage Training') }}</h3>

                <div class="box-header with-border">
                        <div class="alert alert-info clearfix">
                            <a href="{{ route('training.create') }}" class="alert-link"><button type="button" class="btn btn-primary btn-sm float-end">{{ __(' Add Training Information') }}</button></a> 
                            <a href="{{ route('excelreport.excel') }}" class="alert-link"><button type="button" class="btn btn-primary btn-sm float-start">{{ __('TO EXCEL') }}</button></a>
                            <a href="{{ route('excelreport.pdf') }}" class="alert-link"><button type="button" class="btn btn-primary btn-sm float-middle">{{ __('TO PDF') }}</button></a>
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
                            <th>{{ __(' Island name') }}</th>
                            <th>{{ __(' Village name') }}</th>
                             <th>{{ __(' Training name') }}</th>
                            <th>{{ __(' First name') }}</th>
                            <th>{{ __(' Last name') }}</th>
                            <th>{{ __(' Age') }}</th>
                            <th>{{ __(' Gender') }}</th>
                            <th>{{ __(' Training Date') }}</th>
                           {{--<th>{{ __(' Created At') }}</th>--}}
                            <th class="text-center">{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody id="myTable">
                        @php $sl = 1; @endphp
                      {{--{{dd($trainings)}}--}}
                        @foreach($trainings as $training)
                        <tr>
                            <td>{{ $sl++ }}</td> 
                            <td>{{ $training->island_name }}</td> 
                            <td>{{ $training->village_name }}</td>                       
                            <td>{{ $training->training_name }}</td>
                            <td>{{ $training->participant_first_name }}</td>
                            <td>{{ $training->participant_last_name }}</td>
                            <td>{{ $training->age }}</td>
                            <td>{{ $training->gender ?'Male':'Female' }}</td>
                            <td class="text-center">{{ date("Y", strtotime($training->training_date)) }}</td>         
                           {{--<td class="text-center">{{ date("d F Y", strtotime($training->created_at)) }}</td>--}}
                           
                            <td class="text-center">
                            <a class="btn btn-info text-center" href="{{route('training.show', $training->id)}}">Show</a>      
                               <a href="{{ route('training.edit', $training->id) }}"><i class="icon fa fa-edit"></i> {{ __('Edit') }}</a>
                              
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
</div>
</div>
@endsection

@push('custom-scripts')
<!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> -->
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script> -->
@endpush