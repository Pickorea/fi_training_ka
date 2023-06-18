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
                    <option value="0">New Course</option>
                </select>
            </div>

            <div id="new_course_fields" style="display: none;">
                <div class="form-group">
                    <label for="title" id="title_label">Title</label>
                    <input type="text" name="title" id="coursetitle" class="form-control" placeholder="Enter new Course Title">
                </div>

                <div class="form-group">
                    <label for="description" id="description_label">Description</label>
                    <textarea name="description" id="description" class="form-control" required></textarea>
                </div>

                <div class="form-group">
                    <label for="duration" id="duration_label">Duration</label>
                    <input type="number" name="duration" id="duration" class="form-control" required>
                </div>
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

            <button type="submit" class="btn btn-primary btn-lg btn-block">Create Program</button>
        </form>
    </div>
@endsection

@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
       $(document).ready(function () {
    $(document).on('change', '#course_id', function(){
        var course_id = $(this).val();
        if (course_id == 0) {
            $('#new_course_fields').show();
            $('#description').prop('disabled', false);
            $('#duration').prop('disabled', false);
        } else {
            $('#new_course_fields').hide();
            $('#description').prop('disabled', true);
            $('#duration').prop('disabled', true);
        }
        });
    });
     </script>
@endpush
