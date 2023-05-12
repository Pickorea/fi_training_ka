@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h3>{{ __('Employees') }}</h3>
            <div class="d-flex">
                <a href="{{ route('employee.create') }}" class="btn btn-primary btn-sm me-2">{{ __('Add Employee') }}</a> 
                <div class="dropdown">
                    <button class="btn btn-primary btn-sm dropdown-toggle" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                        {{ __('Export') }}
                    </button>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <li><a class="dropdown-item" href="{{ route('excelreport.employeeexcel') }}">{{ __('To Excel') }}</a></li>
                        <li><a class="dropdown-item" href="{{ route('excelreport.pdf') }}">{{ __('To PDF') }}</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                        <th>{{ __(' SL#') }}</th>
                            <th>{{ __(' Full Name') }}</th>
                            <th>{{ __(' Martial Status') }}</th>
                            <th>{{ __(' Email') }}</th>
                            <th>{{ __(' Work Status') }}</th>
                            <th>{{ __(' Job Title') }}</th>
                            <th>{{ __(' PF') }}</th>
                            <th>{{ __(' Joining Date') }}</th>
                            <th>{{ __(' Gender') }}</th> 
                            <th>{{ __(' DoB') }}</th>
                            <th class="text-center">{{ __('Actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                       
                    @php $sl = 1; @endphp
                     
                     @foreach($employees as $employee)
              {{--{{dd($employee)}}--}}
                     <tr>
                         <td>{{ $sl++ }}</td>
                         <td>{{ $employee->name}}</td>
                         <td>{{ $employee->marital_status === "1"?"Maried":
                             ($employee->marital_status === "2"?"Single":
                             ($employee->marital_status === "3"?"Divorced":
                             ($employee->marital_status === "4"?"Separated":"Widowed")))}}</td>
                         <td>{{ $employee->email}}</td>
                         <td>{{ $employee->work_status_name}}</td>
                         <td>{{ $employee->job_title_name }}</td>
                         <td>{{ $employee->pf_number}}</td>
                         <td>{{ date("d F Y", strtotime($employee->joining_date))}}</td>
                         <td>{{ $employee->gender === "1"?"Male":"Female"}}</td>
                         <td>{{ date("d F Y", strtotime($employee->date_of_birth))}}</td>
                
                       
                        
                        
                         <td class="text-center">
                            <a href="{{ route('employee.show', $employee->id) }}" class="btn btn-info btn-sm">{{ __('Show') }}</a>      
                        </td>
                        <td class="text-center">
                            <a href="{{ route('employee.edit', $employee->id) }}" class="btn btn-warning btn-sm"><i class="icon fa fa-edit"></i> {{ __('Edit') }}</a>
                        </td>

                     </tr>
                     @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
