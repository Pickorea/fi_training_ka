@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h5>Create Recommended Salary Scale</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('recommendedsalaryscales.store') }}" method="POST">
                @csrf

                <div class="form-group">
                    <label for="job_title_id">Job Title:</label>
                    <select name="job_title_id" class="form-control">
                        @foreach ($jobTitles as $id => $name)
                            <option value="{{ $id }}">{{ $name }}</option>
                        @endforeach
                    </select>

                </div>

                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" name="name" id="name" class="form-control" required>
                </div>

                
                <div class="form-group">
                    <label for="recommended_minimum_salary">Recommended Minimum Salary:</label>
                    <input type="number" name="recommended_minimum_salary" id="recommended_minimum_salary" class="form-control" step="0.01" required>
                </div>

                <div class="form-group">
                    <label for="recommended_maximum_salary">Recommended Maximum Salary:</label>
                    <input type="number" name="recommended_maximum_salary" id="recommended_maximum_salary" class="form-control" step="0.01" required>
                </div>

                <button type="submit" class="btn btn-primary">Create</button>
            </form>
        </div>
    </div>
</div>
@endsection
