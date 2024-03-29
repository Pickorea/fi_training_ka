<!-- resources/views/vacancies/create.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Create New Vacancy') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('vacancy.store') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="department_id" class="col-md-4 col-form-label text-md-right">{{ __('Department') }}</label>

                            <div class="col-md-6">
                                <select id="department_id" class="form-control" name="department_id" required>
                                    <option value="" selected disabled>Select department</option>
                                    @foreach($departments as $key => $department)
                                          <option value="{{ $key }}">{{ $department }}</option>
                                    @endforeach
                                </select>

                                @error('department_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="job_title_id" class="col-md-4 col-form-label text-md-right">{{ __('Job Title') }}</label>

                            <div class="col-md-6">
                                <select id="job_title_id" class="form-control" name="job_title_id">
                                    <option value="" selected disabled>Select job title</option>
                                </select>

                                @error('job_title_id')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{--<div class="form-group row">
                            <label for="type" class="col-md-4 col-form-label text-md-right">{{ __('Type') }}</label>

                            <div class="col-md-6">
                                <input id="type" type="text" class="form-control @error('type') is-invalid @enderror" name="type" value="{{ old('type') }}" required autocomplete="type" autofocus>

                                @error('type')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>--}}

                        <div class="form-group row">
                            <label for="status" class="col-md-4 col-form-label text-md-right">{{ __('Vacancy Status') }}</label>
                            <div class="col-md-6">
                                <select id="status" class="form-control" name="status" required>
                                    <option value="" selected disabled>Select status</option>
                                    <option value="open">Open</option>
                                    <!-- <option value="closed">Closed</option> -->
                                </select>
                                @error('status')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Create Vacancy') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
// $(document).ready(function() {
//     $('#department_id').change(function() {
//         var departmentId = $(this).val();
//         if (departmentId) {
//             $.ajax({
//                 url: '{{ url("jobtitle/jobtitles") }}/' + departmentId,
//                 type: 'GET',
//                 dataType: 'json',
//                 success: function(data) {
//                     console.log(data);
//                     $('#job_title_id').empty();
//                     $('#job_title_id').append('<option value="" selected disabled>Select job title</option>');
//                     for (var key in data) {
//                         if (data.hasOwnProperty(key)) {
//                             $('#job_title_id').append('<option value="' + data[key] + '">' + data[key] + '</option>');
//                         }
//                     }
//                 }
//             });
//         } else {
//             $('#job_title_id').empty();
//             $('#job_title_id').append('<option value="" selected disabled>Select department first</option>');
//         }
//     });
// });
$(document).ready(function() {
    $('#department_id').change(function() {
        var departmentId = $(this).val();
        if (departmentId) {
            $.ajax({
                url: '{{ url("jobtitle/jobtitles") }}/' + departmentId,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
    console.log(data); // add this line
    $('#job_title_id').empty();
    $('#job_title_id').append('<option value="" selected disabled>Select job title</option>');
    $.each(data.data, function(key, jobTitle) {
        $('#job_title_id').append('<option value="' + jobTitle.id + '">' + jobTitle.name + '</option>');
    });



                },
                error: function(jqXHR, textStatus, errorThrown) {
                    console.log(textStatus, errorThrown); // add this line
                }
            });
        } else {
            $('#job_title_id').empty();
            $('#job_title_id').append('<option value="" selected disabled>Select department first</option>');
        }
    });
});


</script>
