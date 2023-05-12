@extends('layouts.app')

@section('content')

<div class="container">

<div class="row justify-content-center">

<!-- Employee Profile Start -->
<div class="col-md-12">
    <div class="card card-new-task">
        <div class="card-header">
            <h3>{{ $employee->name }}'s Profile</h3>
        </div>

        <div class="card-body">
            <div class="row">
            <div class="col-md-7">
                    <h5>Personal Information</h5>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>Full Name:</strong> {{ $employee->name }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Department:</strong> {{ $employee->department->department_name }}</p>
                        </div>
                        <div class="col-md-6">
                            <p><strong>Job Title:</strong> {{ $employee->jobTitle->name }}</p>
                        </div>
                    </div>
                </div>
                @php
                        $now = Carbon::now();
                                       
                @endphp
                <div class="col-md-5">
                    <h5>Employment Information</h5>
                    <hr>
                    <div class="row">
                        <div class="col-md-6">
                
                        <p><strong>Start Date:</strong> {{ Carbon::parse($employee->employeeWorkStatuses->first()->start_date)->format('Y-m-d') }}</p>

                        </div>
                        <div class="col-md-6">
                        <p><strong>Start Date:</strong> {{ Carbon::parse($employee->employeeWorkStatuses->first()->end_date)->format('Y-m-d') }}</p>

                        </div>
                    </div>
                    <div class="row">
                    <div class="col-md-6">
                        <label>Work Status</label>
                       
                    </div>
                    <div class="col-md-6">
                      
                    @if (optional($employee->workstatus)->work_status_name)
    <p>{{ $employee->workstatus->work_status_name }}</p>
@endif

                    </div>


                    </div>

                        <div class="col-md-6">
                            <p><strong>Joining Date:</strong> {{ $employee->joining_date }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<!-- Employee Profile End -->

</div>


</div>
@endsection

