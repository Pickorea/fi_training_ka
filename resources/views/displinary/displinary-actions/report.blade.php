@extends('layouts.app')

@section('title', __('Disciplinary'))

@section('content')
<div class="container">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/home') }}">{{ __('Dashboard') }}</a></li>
            <li class="breadcrumb-item"><a href="{{ route('employee.index') }}">{{ __('Employee List') }}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{ __('Disciplinary Actions') }}</li>
        </ol>
    </nav>

    <div class="waterfall">
        <div class="waterfall-left">
            <h1>{{ $employeeName }} {{ __('Disciplinary Report') }}</h1>
        </div>
        <div class="waterfall-right">
            <a href="{{ route('displinary-action.create') }}" class="btn btn-primary">{{ __('Add Disciplinary') }}</a>
        </div>
    </div>

    @if (!empty(Session::get('message')))
    <div class="alert alert-success alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="{{ __('Close') }}"><span aria-hidden="true">&times;</span></button>
        {{ Session::get('message') }}
    </div>
    @elseif (!empty(Session::get('exception')))
    <div class="alert alert-danger alert-dismissible" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="{{ __('Close') }}"><span aria-hidden="true">&times;</span></button>
        {{ Session::get('exception') }}
    </div>
    @endif

    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>{{ __('Action Type') }}</th>
                            <th>{{ __('Description') }}</th>
                            <th>{{ __('Severity Level') }}</th>
                            <th>{{ __('Action Date') }}</th>
                            <th>{{ __('Days Suspended') }}</th>
                            <th>{{ __('With Pay') }}</th>
                            <th>{{ __('Freeze Salary Increment') }}</th>
                            <th>{{ __('Start Date') }}</th>
                            <th>{{ __('End Date') }}</th>
                            <th>{{ __('Reason') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($reportData as $actionData)
                        <tr>
                            <td>{{ $actionData['action_type'] }}</td>
                            <td>{{ $actionData['description'] }}</td>
                            <td>{{ $actionData['severity_level'] }}</td>
                            <td> {{ date("d F Y", strtotime($actionData['action_date'])) }}</td>                           
                            <td>{{ $actionData['days'] ?? '' }}</td>
                            <td>{{ $actionData['with_pay'] ?? '' }}</td>
                            <td>{{ $actionData['duration'] ?? '' }}</td>
                            <td> {{ date("d F Y", strtotime($actionData['start_date'] ?? '' )) }}</td> 
                            <td> 
                                @if ($actionData['end_date']){{ $actionData['end_date']->format('d/m/Y') }}
                                 @else
                                    N/A
                                @endif
                            </td> 
                          {{--<td> {{ date("d F Y", strtotime($actionData['date'] ?? '' )) }}</td>--}}
                            <td>{{ $actionData['reason'] ?? '' }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<style>
    .waterfall {
        display: flex;
        margin-bottom: 20px;
    }

    .waterfall-left {
        flex-grow: 1;
        margin-right: 10px;
        position: relative;
    }

    .waterfall-content {
        position: absolute;
        top: 0;
        bottom: 0;
        left: 0;
        right: 0;
        border: 1px solid #000; /* Add border for the waterfall effect */
        background-color: #f8f9fa; /* Set background color */
    }

    .waterfall-right {
        flex-shrink: 0;
    }
</style>

@endsection
