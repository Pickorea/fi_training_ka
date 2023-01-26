@extends('layouts.app')

@section('content')
    <div class="box">
            <div class="box-header with-border">
                <div class="box-header with-border">
                <div class="alert alert-info clearfix">
                    <a href="{{ route('report._kooltrainingindex') }}" class="alert-link"><button type="button" class="btn btn-primary btn-sm float-end">{{ __(' EXCEL') }}</button></a> 
                </div>
            </div>
    </div>
<?php $report->render(); ?>
@endsection