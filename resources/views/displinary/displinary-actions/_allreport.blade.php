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
                            <th>{{ __('Name') }}</th>
                            <th>{{ __('Action Type') }}</th>
                            <th>{{ __('Description') }}</th>
                            <th>{{ __('Severity Level') }}</th>
                            <th>{{ __('Action Date') }}</th>
                            <th>{{ __('Days Suspended') }}</th>
                            <th>{{ __('With Pay') }}</th>
                            <!-- <th>{{ __('Freeze Increment') }}</th> -->
                            <th>{{ __('Start Date') }}</th>
                            <th>{{ __('End Date') }}</th>
                             <th>{{ __('Reason') }}</th>
                             <th>{{ __('Generate') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($reportData as $actionData)
                    {{--{{dd($actionData)}}--}}

                   

                        <tr>
                          
                            <td>{{ $actionData['employee_name'] }}</td>
                            <td>{{ $actionData['action_type'] }}</td>
                            <td>{{ $actionData['description'] }}</td>
                            <td>{{ $actionData['severity_level'] }}</td>
                            <td> {{ date("d F Y", strtotime($actionData['action_date'])) }}</td>                           
                            <td>{{ $actionData['days'] ?? '' }}</td>
                            <td>@if(isset($actionData['with_pay']) && $actionData['with_pay'] == 0)
                                    Yes
                                 @else
                                     NO
                                 @endif
                            </td>
                            {{--<td>{{ $actionData['duration'] ?? '' }}</td>--}}
                            <td> @if (array_key_exists('start_date', $actionData) && $actionData['start_date'])
                                @php
                                    $actionDateFormatted = Carbon::createFromFormat('Y-m-d', $actionData['start_date'])->format('M d, Y');
                                @endphp
                                {{ $actionDateFormatted }}
                            @else
                                N/A
                            @endif</td> 
                            <td> 
                            @if (array_key_exists('end_date', $actionData) && $actionData['end_date'])
                                @php
                                    $actionDateFormatted = Carbon::createFromFormat('Y-m-d', $actionData['end_date'])->format('M d, Y');
                                @endphp
                                {{ $actionDateFormatted }}
                            @else
                                N/A
                            @endif
                            </td> 
                             <td>{{ $actionData['reason'] ?? '' }}</td>
                    
                             <td><a href="{{ route('displinary-action.displinary-action.generateLetter', [$actionData['action_type'],$actionData['employee_id']]) }}" class="btn btn-sm btn-primary">{{ $actionData['action_type'] == 'reprimand' ? 'Reprimand' : ($actionData['action_type'] == 'suspension' ? 'Suspension' : ($actionData['action_type'] == 'final warning' ? 'Warning' : 'Termination')) }}</a></td>


                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- <style>
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
</style> -->

@endsection
