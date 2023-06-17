@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Create Program</h1>

        <form action="{{ route('employee_program.store') }}" method="POST" id="create-program-form">
            @csrf

            <div class="form-group">
                <label for="employee_id">Employee:</label>
                <select name="employee_id" id="employee_id" class="form-control">
                    <option value="">Select an employee</option>
                    @foreach ($employees as $key => $employee)
                        <option value="{{ $key }}">{{ $employee }}</option>
                    @endforeach
                </select>
            </div>

            <div id="program-container">
                <div class="form-group program-group">
                    <label for="program_id">Program:</label>
                    <select name="program_id[]" class="form-control">
                        <option value="">Select a program</option>
                        @foreach ($programs as $key => $program)
                            <option value="{{ $key }}">{{ $program }}</option>
                        @endforeach
                    </select>
                    <button type="button" class="btn btn-sm btn-danger remove-program">Remove</button>
                </div>
            </div>

            <button type="button" class="btn btn-sm btn-primary add-program">Add Program</button>
            <button type="submit" class="btn btn-primary">Create Program</button>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Add Program
            $('.add-program').click(function() {
                var programGroup = $('.program-group').first().clone();
                programGroup.find('.remove-program').removeClass('d-none');
                programGroup.find('select').val('');

                $('#program-container').append(programGroup);
            });

            // Remove Program
            $(document).on('click', '.remove-program', function() {
                $(this).closest('.program-group').remove();
            });
        });
    </script>
@endsection
