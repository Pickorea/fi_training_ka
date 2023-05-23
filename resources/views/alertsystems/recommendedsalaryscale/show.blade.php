@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h5 class="card-title">Recommended Salary Scale Details</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-6">
                    <h6 class="font-weight-bold">Name:</h6>
                    <p>{{ $recommendedSalaryScale->name }}</p>
                    <h6 class="font-weight-bold">Job Title:</h6>
                    <p>{{ $recommendedSalaryScale->jobTitle->name }}</p>
                    <h6 class="font-weight-bold">Recommended Minimum Salary:</h6>
                    <p>{{ $recommendedSalaryScale->recommended_minimum_salary }}</p>
                    <h6 class="font-weight-bold">Recommended Maximum Salary:</h6>
                    <p>{{ $recommendedSalaryScale->recommended_maximum_salary }}</p>
                </div>
            </div>
        </div>
        <div class="card-footer">
            <a href="{{ route('recommendedsalaryscales.edit', $recommendedSalaryScale->id) }}" class="btn btn-warning">Edit</a>
            {{--<form action="{{ route('recommendedsalaryscales.destroy', $recommendedSalaryScale->id) }}" method="POST" style="display: inline-block;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this record?')">Delete</button>
            </form>--}}
        </div>
    </div>
</div>
@endsection
