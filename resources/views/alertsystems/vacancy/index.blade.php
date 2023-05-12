@extends('layouts.app')
@section('title', __('Job Title'))

@section('content')
<div class="container">
    <div class="content-wrapper">

        <section class="content-header">
            <h1>{{ __('Vacancy') }}</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('/home') }}">{{ __('Dashboard') }}</a></li>
                    <li class="breadcrumb-item"><a href="{{ url('/island') }}">{{ __('Island List') }}</a></li>
                    <li class="breadcrumb-item active" aria-current="page">{{ __('Job Title List') }}</li>
                </ol>
            </nav>
        </section>

        <section class="content">
            <div class="box">
                
                <div class="box-body">
                    <div class="col-md-6">
                        <input type="text" id="myInput" class="form-control" placeholder="{{ __('Search..') }}">
                    </div>

                    <!-- Notification Box -->
                    <div class="col-md-12">
                        @if (session('message'))
                        <div class="alert alert-success alert-dismissible" id="notification_box">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <i class="icon fa fa-check"></i> {{ session('message') }}
                        </div>
                        @elseif (session('exception'))
                        <div class="alert alert-warning alert-dismissible" id="notification_box">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                            <i class="icon fa fa-warning"></i> {{ session('exception') }}
                        </div>
                        @endif
                    </div>
                    <!-- /.Notification Box -->
                    {{--@can('isAdmin')--}}
                    <div class="table-responsive">
                    <div class="card">
    <div class="card-header">
        <h3 class="card-title">{{ __('Manage Vacancy') }}</h3>
        <div class="card-tools">
            {{--@can('isUser')--}}
            <div>
                <a href="{{ route('vacancy.create') }}" class="alert-link"><button type="button" class="btn btn-primary btn-sm float-end">{{ __('Add Vacancy') }}</button></a>
            </div>
            {{--@endcan--}}
        </div>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>{{ __('Department') }}</th>
                        <th>{{ __('Job Title') }}</th>
                       {{-- <th>{{ __('Type') }}</th>--}}
                        <th>{{ __('Status') }}</th>
                        <th>{{ __('Action') }}</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($vacancies as $vacancy)
                    <tr>
                        <td>{{ $vacancy->department->department_name }}</td>
                        <td>{{ $vacancy->jobTitle->name }}</td>
                        {{--<td>{{ $vacancy->type }}</td>--}}
                        <td>{{ $vacancy->statuses->last()->status }}</td>
                        <td>
                            <a href="{{ route('vacancy.show', ['vacancy' => $vacancy]) }}" class="btn btn-xs btn-primary">{{ __('View') }}</a>
                            <a href="{{ route('vacancy.edit', ['vacancy' => $vacancy]) }}" class="btn btn-xs btn-success">{{ __('Edit') }}</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- /.box -->
</section>
<!-- /.content -->
</div>

</div>
@endsection
@section('scripts')

<script>
    $(document).ready(function(){
        $("#myInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("table tbody tr").filter(function() {
            $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
        });
    });
</script>
@endsection