@extends('layouts.app')
@section('title', __('Vessel Registration'))

@section('content')
<div class="container">
<div class="content-wrapper">

    <section class="content-header">
        <h1>
            {{ __('VESSEL REGISTRATION') }}
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
                <h3 class="box-title">{{ __('Manage Vessel Registration') }}</h3>

                <div class="box-header with-border">
                        <div class="alert alert-info clearfix">
                        <a href="{{ route('vessel-registrations.create') }}" class="breadcrumb-item btn btn-primary btn-sm float-end">{{ __('Register Vessel') }}</a> 
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
                            <th>Vessel Name</th>
                            <th>Registration Number</th>
                            <th>Village</th>
                            <th>Island</th>
                            <th>Vessel Owner</th>
                            <th>Actions</th>
                    </thead>
                    <tbody>
                        @foreach($vessels as $vessel)
                            <tr>
                            <td>{{ $vessel->name }}</td>
                            <td>{{ $vessel->registration_number }}</td>
                            <td>{{ optional($vessel->village)->village_name}}</td>
                            <td>{{ optional($vessel->island)->island_name }}</td>
                            <td>{{ optional($vessel->owner)->name }}</td>
                            
                                <td>
                                    <a href="{{ route('vessel-registrations.show', $vessel->id) }}">View</a>
                                    <a href="{{ route('vessel-registrations.edit', $vessel->id) }}">Edit</a>
                                    {{--<form method="POST" action="{{ route('vessel-registrations.destroy', $vessel->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit">Delete</button>
                                    </form>--}}
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