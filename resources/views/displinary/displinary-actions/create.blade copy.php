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
                <h3 class="box-title">{{ __('ENTER DISPLINARY DETAILS') }}</h3>
            </div>

            <form method="POST" action="{{ route('displinary-action.store') }}">
                @csrf

                <div class="form-group">
                    <label for="employee_id">Employee:</label>
                    <select name="employee_id" id="employee_id" class="form-control">
                        @foreach($employees as $employee)
                            <option value="{{ $employee->id }}">{{ $employee->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="action_type">Action Type:</label>
                    <select name="action_type" id="action_type" class="form-control">
                        <option value="reprimand">Reprimand</option>
                        <option value="suspension">Suspension</option>
                        <option value="final warning">Final Warning</option>
                        <option value="termination">Termination</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="description">Description:</label>
                    <textarea name="description" id="description" class="form-control"></textarea>
                </div>

                <!-- Nested form for suspension details -->
                <div class="suspension-details" style="display:none">
                    <div class="form-group">
                        <label for="suspension_days">Suspension Days:</label>
                        <input type="number" name="suspension_days" id="suspension_days" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="start_date">Start Date:</label>
                        <input type="date" name="start_date" id="start_date" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="end_date">End Date:</label>
                        <input type="date" name="end_date" id="end_date" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="suspension_reason">Suspension Reason:</label>
                        <textarea name="suspension_reason" id="suspension_reason" class="form-control"></textarea>
                    </div>
                </div>
                <!-- Nested form for final warning details -->
                <div class="final-warning-details" style="display:none">
                    <div class="form-group">
                        <label for="final_warning_date">Final Warning Date:</label>
                        <input type="date" name="final_warning_date" id="final_warning_date" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="final_warning_reason">Final Warning Reason:</label>
                        <textarea name="final_warning_reason" id="final_warning_reason" class="form-control"></textarea>
                    </div>
                </div>
                  <!-- Nested form for final warning details -->
                <div class="termination-details" style="display:none">
                    <div class="form-group">
                        <label for="termination_date">Termination Date:</label>
                        <input type="date" name="termination_date" id="termination_date" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="termination_reason">Termination Reason:</label>
                        <textarea name="termination_reason" id="termination_reason" class="form-control"></textarea>
                    </div>
                </div>


                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <a href="{{ route('displinary-action.index') }}" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function() {
  // Hide the suspension, final warning, and termination details form initially
  $('.suspension-details').hide();
  $('.final-warning-details').hide();
  $('.termination-details').hide();
  
  // Show/hide the suspension, final warning, and termination details form based on the selected action type
  $('#action_type').change(function() {
    var selectedOption = $(this).val();
    if (selectedOption == 'suspension') {
      $('.suspension-details').show();
      $('.final-warning-details').hide();
      $('.termination-details').hide();
    } else if (selectedOption == 'final warning') {
      $('.final-warning-details').show();
      $('.suspension-details').hide();
      $('.termination-details').hide();
    } else if (selectedOption == 'termination') {
      $('.termination-details').show();
      $('.suspension-details').hide();
      $('.final-warning-details').hide();
    } else {
      $('.suspension-details').hide();
      $('.final-warning-details').hide();
      $('.termination-details').hide();
    }
  });
});

</script>

@endsection
