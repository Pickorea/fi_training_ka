@extends('layouts.app')

@section('title', __('Displinary'))

@section('content')
<div class="container">
    
    <div class="content-wrapper">
        <section class="content-header">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/home') }}">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('employee.index') }}">Employee List</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Island List</li>
                </ol>
            </nav>
        </section>
        <div class="row">
            <div class="col-md-12">
                <form action="{{--{{ route('displinary-action.employeeReport', $disciplinaryAction->id) }}--}}" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="{{ __('Search...') }}" name="search" value="{{--{{ $search }}--}}">
                        <button type="submit" class="btn btn-primary">{{ __('Search') }}</button>
                    </div>
                </form>
            </div>
        </div>

        <section class="content">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">{{ __('Manage Displinary') }}</h3>

                    <div class="box-body">
                        <div>
                            <a href="{{ route('displinary-action.create') }}" class="breadcrumb-item btn btn-primary btn-sm float-end">{{ __(' Add Displinary') }}</a>
                        </div>
                    </div>
                </div>

                <div class="box-body">
                    <div class="col-md-6">
                        <input type="text" id="myInput" class="form-control" placeholder="{{ __('Search..') }}">
                    </div>
                </div>

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

                <div id="printable_area" class="col-md-12 table-responsive">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>Employee</th>
                                <th>Action Type</th>
                                <th>Severity Level</th>
                                <th>Description</th>
                                <th>Action Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($disciplinaryActions as $disciplinaryAction)
                                <tr>
                                    <td>{{ $disciplinaryAction->employee->name }}</td>
                                    <td>{{ $disciplinaryAction->action_type }}</td>
                                    <td>{{ $disciplinaryAction->severity_level }}</td>
                                    <td>{{ $disciplinaryAction->description }}</td>
                                    <td class="text-center">{{ date("d F Y", strtotime($disciplinaryAction->action_date)) }}</td>
                                    <td>
                                        <a href="{{ route('displinary-action.edit', $disciplinaryAction->id) }}" class="btn btn-primary">Edit</a>
                                        {{--<form action="{{ route('displinary-action.destroy', $disciplinaryAction->id) }}" method="POST" style="display: inline-block;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </form>--}}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
   

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
        $(document).ready(function() {
            $('#myInput').on('keyup', function() {
                var value = $(this).val().toLowerCase();
                $('table tbody tr').filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>
@endsection

  
