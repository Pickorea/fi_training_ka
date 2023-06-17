@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Edit Course</h1>

        <form method="POST" action="{{ route('course.update', $course->course_id) }}">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ $course->title }}">
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea class="form-control" id="description" name="description">{{ $course->description }}</textarea>
            </div>

            <div class="form-group">
                <label for="duration">Duration</label>
                <input type="number" class="form-control" id="duration" name="duration" value="{{ $course->duration }}">
            </div>

            <button type="submit" class="btn btn-primary">Update Course</button>
        </form>
    </div>
@endsection
