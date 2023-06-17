@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Create Course</h1>

        <form method="POST" action="{{ route('course.store') }}">
            @csrf

            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" name="title" id="title" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea name="description" id="description" class="form-control" required></textarea>
            </div>

            <div class="form-group">
                <label for="duration">Duration</label>
                <input type="number" name="duration" id="duration" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Create</button>
        </form>
    </div>
@endsection
