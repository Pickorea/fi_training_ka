@extends('layouts.app')

@section('content')
<div class="container">
<div class="content-wrapper">
    <title>User CV Template</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        h1, h2 {
            margin: 0;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        .header img {
            width: 100px;
        }
        .main {
            display: flex;
        }
        .main img {
            width: 150px;
            margin-right: 20px;
        }
        .sidebar {
            flex: 1;
            margin-right: 20px;
        }
        .main-content {
            flex: 3;
        }
        .section {
            margin-bottom: 20px;
        }
        .section h2 {
            margin-bottom: 10px;
        }
        .section ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        .section li {
            margin-bottom: 5px;
        }
    </style>

<body>
    <div class="header">
        <h1>User CV</h1>
        @if ($employee->picture)
          <img src="{{ asset('uploads/employees/' . $employee->picture) }}" alt="Profile Picture"  style="width:200px;height:auto;">
          @endif
    </div>
    <div class="main">
    <img src="{{ asset('uploads/employees/' . $employee->picture) }}" alt="Profile Picture"  style="width:50px;height:40;">
        <div class="sidebar">
            <div class="section">
                <h2>Personal Information</h2>
                <ul>
                    <li>Name: {{$employee->name}}</li>
                    <li>Email: {{$employee->email}}</li>
                    <li>Phone: 123-456-7890</li>
                    <li>DoB:  {{$employee->date_of_birth}}</li>
                    <li>Gender:  {{ $employee->gender === "1"?"Male":"Female"}}</li>
                    <li>Work Status:  {{$employee->work_status_name}}</li>
                    <li>Department:  {{$employee->department_name}}</li>
                    <li>Joining Date:  {{$employee->joining_date}}</li>
                    <li>Marital Status:  {{ $employee->marital_status === "1"?"Maried":
                                ($employee->marital_status === "2"?"Single":
                                ($employee->marital_status === "3"?"Divorced":
                                ($employee->marital_status === "4"?"Separated":"Widowed")))}}</li>
                    <li>PF:  {{$employee->pf_number}}</li>
                    <li>Present Address: {{$employee->present_address}}</li>
                </ul>
            </div>
            <div class="section">
                <h2>Skills</h2>
                <ul>
                    <li>Programming languages: PHP, JavaScript, HTML/CSS</li>
                    <li>Frameworks: Laravel, Vue.js, React</li>
                    <li>Databases: MySQL, MongoDB</li>
                </ul>
            </div>
        </div>
        <div class="main-content">
            <div class="section">
                <h2>Summary</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam porttitor mi vel nisi convallis, a volutpat massa fermentum.</p>
            </div>
            <div class="section">
                <h2>Education</h2>
                <ul>
                    <li>{{$employee->school_name??"Enter School"}}</li>
                    <li> {{$employee->from_year??"Enter from year"}} - {{$employee->to_year??"Enter to year"}}</li>
                </ul>
            </div>
            <div class="section">
                <h2>Experience</h2>
                <ul>
                    <li>Software Engineer, Company ABC, 2019-2021</li>
                    <li>Full Stack Developer, Company XYZ, 2021-present</li>
                </ul>
            </div>
        </div>
    </div>
</body>
    </div>
    </div>
@endsection
