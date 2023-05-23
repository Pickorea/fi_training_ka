@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h5>Edit Recommended Salary Scale</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('recommendedsalaryscales.update', $recommendedSalaryScales->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" name="name" id="name" class="form-control" value="{{ $recommendedSalaryScales->name }}" required>
                </div>

                <div class="form-group">
                    <label for="job_title_id">Job Title:</label>
                    <select name="job_title_id" id="job_title_id" class="form-control" required>
                        <!-- Populate job titles from your database -->
                        @foreach($jobTitles as $key => $jobTitle)
                        <option value="{{ $key }}" @if($recommendedSalaryScales->job_title_id == $key) selected @endif>{{ $jobTitle }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="recommended_minimum_salary">Recommended Minimum Salary:</label>
                    <input type="number" name="recommended_minimum_salary" id="recommended_minimum_salary" class="form-control" step="0.01" value="{{ $recommendedSalaryScales->recommended_minimum_salary }}" required>
                </div>

                <div class="form-group">
                    <label for="recommended_maximum_salary">Recommended Maximum Salary:</label>
                    <input type="number" name="recommended_maximum_salary" id="recommended_maximum_salary" class="form-control" step="0.01" value="{{ $recommendedSalaryScales->recommended_maximum_salary }}" required>
                </div>

                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        </div>
    </div>
</div>
@endsection
