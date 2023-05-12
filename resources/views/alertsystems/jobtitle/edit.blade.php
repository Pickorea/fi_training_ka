@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card card-new-task">
                <div class="card-header">
                    <h3>{{ __('EDIT JOB TITLE DETAILS') }}</h3>
                </div>
                <div class="card-body">
                    <div class="content-wrapper">
                        {{ html()->modelForm($jobtitle, 'PUT', route('jobtitle.update', $jobtitle->id))->open() }}
                        @csrf
                        @method('PUT')
<div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                {{ html()->label('Job Title Name')->class('form-control-label')->for('name') }}
                                {{ html()->text('name')->class('form-control' . ($errors->has('name') ? ' is-invalid' : ''))->placeholder('Enter a Job title name') }}
                                @if($errors->has('name'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('name') }}
                                </div>
                                @endif
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                {{ html()->label('Department Name')->class('form-control-label')->for('department_id') }}
                                {{ html()->select('department_id', $departments, $jobtitle->department_id)->class('form-control' . ($errors->has('department_id') ? ' is-invalid' : ''))->placeholder(__('Select one')) }}
                                @if($errors->has('department_id'))
                                <div class="invalid-feedback">
                                    {{ $errors->first('department_id') }}
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-bordered table-hover" id="job_descriptions_table">
                                <thead>
                                    <tr>
                                        <th>Description</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @if($jobtitle->jobdescription)

                                    @foreach ($jobtitle->jobdescription as $description)
                                       <tr>
                                          <td><textarea class="form-control job_description" name="description[{{$description->id}}][description]" rows="3">{{$description->description}}</textarea></td>
                                          <td><input type="hidden" name="description[{{$description->id}}][id]" value="{{$description->id}}"></td>
                                       </tr>
                                    @endforeach


                                    @endif
                                </tbody>
                            </table>
                            <button type="button" name="add_row" id="add_row" class="btn btn-success btn-sm">{{ __('Add New Description') }}</button>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">{{ __('Update') }}</button>
                                <a href="{{ route('jobtitle.index') }}" class="btn btn-danger">{{ __('Cancel') }}</a>
                            </div>
                        </div>
                    </div>

                    {{ html()->form()->close() }}
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function(){
    var i = {{ count($jobtitle->jobdescription) }};
    $('#add_row').click(function(){
        i++;
        $('#job_descriptions_table').append('<tr id="job_description'+i+'"><td><textarea class="form-control" name="description['+i+'][description]" rows="3" placeholder="Enter job description"></textarea></td><td><input type="hidden" name="description['+i+'][id]" value=""><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn-sm remove-job-description"><i class="fa fa-times"></i></button></td></tr>');
    });

    $(document).on('click', '.remove-job-description', function(){
        var button_id = $(this).attr("id");
        $("#job_description"+button_id+"").remove();
    });

    $(document).on('click', '.delete-job-description', function(){
        var id = $(this).data("id");
        $.ajax({
            url: '/jobtitle/description/delete/'+id,
            type: 'DELETE',
            dataType: 'json',
            data: {
                "id": id,
                "_token": "{{ csrf_token() }}",
            },
            success: function (data) {
                if (data.success) {
                    $('#row'+id).remove();
                }
            }
        });
    });
});

</script>


@endsection




