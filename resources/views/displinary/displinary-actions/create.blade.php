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
                <label>
                    <input type="checkbox" id="with_pay_checkbox" value="true">
                    With pay
                </label>
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
                    <div>
                        <label>
                            <input type="radio" name="suspension_type" value="20_days" checked>
                            20 Days Suspension
                        </label>
                    </div>

                    <div>
                        <label>
                            <input type="radio" name="suspension_type" value="stoppage_of_increment" checked>
                            Stoppage of Increment
                        </label>
                    </div>
                   
                    <div>
                        <label>
                            <input type="radio" name="suspension_type" value="interim" checked>
                            Interim Suspension
                        </label>
                    </div>
                    <div>
                        <label>
                            <input type="radio" name="suspension_type" value="final">
                            Final Suspension
                        </label>
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
                  <!-- Nested form for termination details -->
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

                 <!-- Nested form for stoppage_of_increments details -->
                 <div class="stoppage-increments-details" style="display:none">
                    <div class="form-group">
                        <label for="stoppage_of_increments">Stoppage of Increment:</label>
                        <input type="number" name="stoppage_duration" id="stoppage_duration" class="form-control">
                    </div>
                    <!-- <div class="form-group">
                        <label for="termination_reason">Termination Reason:</label>
                        <textarea name="termination_reason" id="termination_reason" class="form-control"></textarea>
                    </div> -->
                </div>

                <!-- Nested form for severityLevel-details details -->
                <div class="severityLevel-details" style="display:none">
                <div class="form-group">
                    <label for="severityLevel">Severity Level:</label>
                    <select name="severityLevel" id="severityLevel" class="form-control">
                        <option value="low">Low</option>
                        <option value="moderate">Moderate</option>
                        <option value="high">High</option>
                        <option value="extreme">Extreme</option>
                    </select>
                </div>
                </div>
                <div class="form-group" id="salary_input" style="display:none">
                <label for="salary">Salary:</label>
                <input type="number" name="salary" id="salary" class="form-control">
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">{{ __('Submit') }}</button>
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
  $('.severityLevel-details').hide();

  // Show/hide the suspension, final warning, and termination details form based on the selected action type
  $('#action_type').change(function() {
    var selectedOption = $(this).val();
    if (selectedOption == 'suspension') {
      $('.suspension-details').show();
      $('.severityLevel-details').show();
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

  // Show/hide the additional form for "Final Suspension" based on radio button selection
  $('input[name="suspension_type"]').change(function() {
    var selectedSuspensionType = $('input[name="suspension_type"]:checked').val();
    if (selectedSuspensionType == 'stoppage_of_increment') {
      $('.stoppage-increments-details').show();
    } else if (selectedSuspensionType == '20_days' || selectedSuspensionType == 'interim' || selectedSuspensionType == 'final') {
      $('.stoppage-increments-details').hide();
    }
  });

  // Show/hide the salary input based on the selected severity level
  $('#severityLevel').change(function() {
    var selectedSeverityLevel = $(this).val();
    if (selectedSeverityLevel == 'Extreme') {
      $('.salary-details').show();
    } else {
      $('.salary-details').hide();
    }
  });

  // Update the hidden input value based on the checkbox state
  $('#with_pay_checkbox').change(function() {
    var isChecked = $(this).prop('checked');
    if (isChecked) {
      // Checkbox is checked, set with_pay to true
      $('#with_pay_hidden_input').val('true');
    } else {
      // Checkbox is not checked, set with_pay to false
      $('#with_pay_hidden_input').val('false');
    }
  });

  // When submitting the form, include the value of the hidden input in the request
  $('#your_form').submit(function() {
    // Get the current value of with_pay
    var withPayValue = $('#with_pay_hidden_input').val();
    // Update the value of the hidden input with the current value of with_pay
    $('#with_pay_hidden_input').val(withPayValue);
  });
});
</script>

@endsection
