@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card card-new-task">
                <div class="card-header"></div>
                <div class="card-body">
                <div class="content-wrapper">
                <!-- Content Header (Page header) -->
              

                    <!-- Main content -->
                    <section class="content">
                        <!-- Default box -->
                        <div class="box">
                            <div class="box-header with-border">
                                <h3 class="box-title">{{ __('EDIT ISLAND DETAILS') }}</h3>

                                <div class="box-tools pull-right">
                                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                                    <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                                </div>
                            </div>
                            <div class="box-body">
                            <form method="POST" action="{{ route('vessel-registrations.update', $vesselRegistration->id) }}">
    @csrf
    @method('PUT')

    <label for="name">Vessel Name:</label>
    <input type="text" name="name" id="name" value="{{ $vesselRegistration->name }}">

    <label for="registration_number">Registration Number:</label>
    <input type="text" name="registration_number" id="registration_number" value="{{ $vesselRegistration->registration_number }}">

    <label for="island">Island:</label>
    <select name="island" id="island">
        @foreach($islands as $island)
            <option value="{{ $island->id }}" {{ $island->id == $vesselRegistration->village->island->id ? 'selected' : '' }}>{{ $island->name }}</option>
        @endforeach
    </select>

    <label for="village">Village:</label>
    <select name="village" id="village">
        @foreach($villages as $village)
            <option value="{{ $village->id }}" {{ $village->id == $vesselRegistration->village->id ? 'selected' : '' }}>{{ $village->name }}</option>
        @endforeach
    </select>

    <label for="owner">Vessel Owner:</label>
    <select name="owner" id="owner">
        @foreach($owners as $owner)
            <option value="{{ $owner->id }}" {{ $owner->id == $vesselRegistration->owner->id ? 'selected' : '' }}>{{ $owner->name }}</option>
        @endforeach
    </select>

    <button type="submit">Submit</button>
</form>

        
@endsection
   