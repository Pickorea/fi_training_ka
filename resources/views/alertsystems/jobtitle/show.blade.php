@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ $jobtitle->name }}</div>

                    <div class="card-body">
                        <h4>Job Descriptions</h4>
                        <ul>
                            @foreach ($jobdescriptions as $jobdescription)
                                <li>{{ $jobdescription->description }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
