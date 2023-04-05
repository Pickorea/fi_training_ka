@extends('layouts.app')

@section('content')
<div class="container">
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row justify-content-center mt-0">
    <div class="col-lg-8">
        <div class="box-header with-border">
            <h3 class="box-title">{{ __('EDIT DISCIPLINARY DETAILS') }}</h3>
        </div>

        <form method="POST" action="{{ route('displinary-action.update', $displinaryAction->id) }}">
            @csrf
            @method('PUT')

            <input type="hidden" name="id" value="{{ $displinaryAction->id }}">

            <div class="form-group">
                <label for="employee_id">Employee:</label>
                <select name="employee_id" id="employee_id" class="form-control">
                    @foreach($employees as $employee)
                        <option value="{{ $employee->id }}" @if($employee->id == $displinaryAction->employee_id) selected @endif>{{ $employee->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="action_type">Action Type:</label>
                <select name="action_type" id="action_type" class="form-control">
                    <option value="reprimand" @if($displinaryAction->action_type == 'reprimand') selected @endif>Reprimand</option>
                    <option value="suspension" @if($displinaryAction->action_type == 'suspension') selected @endif>Suspension</option>
                    <option value="final warning" @if($displinaryAction->action_type == 'final warning') selected @endif>Final Warning</option>
                    <option value="termination" @if($displinaryAction->action_type == 'termination') selected @endif>Termination</option>
                </select>
            </div>

            <!-- <div class="form-group">
                <label for="description">Description:</label>
                <textarea name="description" id="description" class="form-control">{{ $displinaryAction->description }}</textarea>
            </div> -->

            <!-- Nested form for suspension details -->
            <div class="suspension-details" @if($displinaryAction->action_type != 'suspension') style="display:none" @endif>
                <div class="form-group">
                    <label for="suspension_days">Suspension Days:</label>
                    <input type="number" name="suspension_days" id="suspension_days" class="form-control" value="{{ $displinaryAction->suspension->days ?? ''}}">

               </div>
               <div class="form-group">
            <label for="start_date">Start Date:</label>
            <input type="date" name="start_date" id="start_date" class="form-control" value="{{ $displinaryAction->suspension->start_date ?? ''}}">
            </div>
        <div class="form-group">
            <label for="end_date">End Date:</label>
            <input type="date" name="end_date" id="end_date" class="form-control" value="{{ $displinaryAction->suspension->end_date  ?? '' }}">
        </div>
            </div>
            
            <!-- Submit button -->
            <div class="form-group">
                <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
            </div>
        </form>
    </div>
</div>
</div>
@endsection

