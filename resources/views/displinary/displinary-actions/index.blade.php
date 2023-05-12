@extends('layouts.app')

@section('title', __('Displinary'))

@section('content')
<head>
  <!-- Include jQuery -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <!-- Include Popper.js -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>

  <!-- Include Bootstrap -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

  <!-- Your other head content -->

</head>

<div class="container">
    
    <div class="content-wrapper">
       
        <section class="content">
            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">{{ __('Manage Displinary') }}</h3>

                    <div class="box-body">
                        <div>
                            <div class="dropdown float-end">
                                <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    {{ __('Actions') }}
                                </button>
                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="{{ route('displinary-action.create') }}">{{ __('Add Displinary') }}</a>
                                    <a class="dropdown-item" href="{{route('displinary-action.displinary-action._allreport')}}">{{ __('View Displinary Actions') }}</a>
                                    <!-- add more items here as needed -->
                                </div>
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
                            {{--{{dd($disciplinaryAction)}}--}}
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
   

    <script>
        $(document).ready(function() {
            // Add click event listener to dropdown items
            $('.dropdown-item').on('click', function() {
            // Get the URL from the href attribute of the clicked item
            var url = $(this).attr('href');
            // Redirect to the URL
            window.location.href = url;
            });
        });
    </script>

@endsection

  
