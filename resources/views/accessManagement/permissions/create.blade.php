@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left">
                <h2>Create New Permission</h2>
            </div>
            <div class="pull-right">
                <a class="btn btn-primary" href="{{ route('access-management.permissions.index') }}"> Back</a>
            </div>
        </div>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {!! Form::open(array('route' => 'access-management.permissions.store','method'=>'POST')) !!}
         @csrf

         <div class="row">
             <div class="col-xs-12 col-sm-12 col-md-12">
                 <div class="form-group">
                     <strong>Name:</strong>
                     {!! Form::text('name', null, array('placeholder' => 'Name','class' => 'form-control')) !!}
                 </div>
             </div>
             <div class="col-xs-12 col-sm-12 col-md-12">
                 <div class="form-group">
                     <strong>Roles:</strong>
                     <br/>
                     @foreach($roles as $role)
                         <label>{{ Form::checkbox('roles[]', $role->id, false, array('class' => 'name')) }}
                         {{ $role->name }}</label>
                     <br/>
                     @endforeach
                 </div>
             </div>
             <div class="col-xs-12 col-sm-12 col-md-12 text-center">
               <button type="submit" class="btn btn-primary">Submit</button>
             </div>
         </div>
    {!! Form::close() !!}

@endsection
