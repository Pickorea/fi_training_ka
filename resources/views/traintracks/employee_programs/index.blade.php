@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Employee Programs</h1>

        <ul class="treeview">
            @foreach ($employeePrograms as $key => $employeeProgram)
                @if ($key === 0 || $employeeProgram->employee_name !== $employeePrograms[$key - 1]->employee_name)
                    <li>
                        <span class="employee-name">{{ $employeeProgram->employee_name }}</span>
                        <ul class="program-list">
                @endif
                <li>{{ $employeeProgram->program_course }}</li>
                @if ($key === count($employeePrograms) - 1 || $employeeProgram->employee_name !== $employeePrograms[$key + 1]->employee_name)
                        </ul>
                    </li>
                @endif
            @endforeach
        </ul>
    </div>

    <style>
        .treeview {
            list-style-type: none;
        }

        .employee-name {
            font-weight: bold;
        }

        .program-list {
            margin-left: 20px;
        }

        ul.treeview li {
            margin-bottom: 5px;
        }
    </style>
@endsection
