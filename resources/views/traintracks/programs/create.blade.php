@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Create Program</h1>

        <form action="{{ route('program.store') }}" method="POST">
    @csrf

    <div class="form-group">
        <label for="course_id">Course:</label>
        <select name="course_id" id="course_id" class="form-control">
            <option value="">Select a course</option>
           
            @foreach ($courses as $key => $course)
                <option value="{{ $key }}">{{ $course }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="department_id">Department:</label>
        <select name="department_id" id="department_id" class="form-control">
            <option value="">Select a department</option>
            @foreach ($departments as $key => $department)
                <option value="{{ $key }}">{{ $department }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label for="trainer">Trainer:</label>
        <input type="text" name="trainer" id="trainer" class="form-control">
    </div>

    <div class="form-group">
        <label for="start_date">Start Date:</label>
        <input type="date" name="start_date" id="start_date" class="form-control">
    </div>

    <div class="form-group">
        <label for="end_date">End Date:</label>
        <input type="date" name="end_date" id="end_date" class="form-control">
    </div>

    <button type="submit" class="btn btn-primary">Create Program</button>
</form>

    </div>
@endsection
