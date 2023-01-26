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
                <section class="content-header">
                    <h1>
                        {{ __('files') }}
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="{{ url('/home') }}"><i class="fa fa-dashboard"></i>{{ __('Dashboard') }} </a></li>
                        <li><a>{{ __('Setting') }}</a></li>
                        <li><a href="{{ url('/setting/filess') }}">{{ __('filess') }}</a></li>
                        <li class="active">{{ __('Details') }}</li>
                    </ol>
                    </ol>
                </section>

                    <!-- Main content -->
                    <section class="content">
                        <!-- Default box -->
                        <div class="box">
                            <div class="box-header with-border">
                                <h3 class="box-title">{{ __('Details of files') }}</h3>

                                <div class="box-tools pull-right">
                                    <button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                                    <button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
                                </div>
                            </div>
                            <div class="box-body">
                                <a href="" class="btn btn-primary btn-flat"><i class="fa fa-arrow-left"></i>{{ __('Back') }} </a>
                                <hr>
                                <table  class="table table-bordered table-striped">
                                    <tbody id="myTable">
                                       <tr>
                                            <td>{{ __('files Name') }}</td>
                                           <td>
                                         
    

                                                <div class="row justify-content-center">
                                                            <div class="row justify-content-center">
                                                            <iframe src="{{asset('/spa/' . $spa->file_name)}}" type="application/pdf" style="height: 850px; width: 990px;">
                                                                </iframe>
                                                            </div>
                                                </div>
                                            
                                            </td>
                                        </tr>
                                        <tr>
                                          
                                        </tr>
                                        <tr>
                                           <td>{{ __('File Name') }}</td>
                                       
                                          
                                            {{--<td><a href="{{ route('pdf.download',  $data->id) }}" class='btn btn-primary'><i class="fa fa-download">{{ $data->name }}</i></a></td>--}}
                                        </tr>
                                        {{--<tr>
                                            <td>{{ __('Exam_end_date') }}</td>
                                            <td>{{ $files['exam_end_date'] }}</td>
                                        </tr>
                                        <tr>
                                            <td>{{ __('Date Added') }}</td>
                                            <td>{{ date("D d F Y h:ia", strtotime($files['created_at'])) }}</td>
                                        </tr>
                                        <tr>
                                            <td>{{ __('Last Updated') }}</td>
                                            <td>{{ date("D d F Y h:ia", strtotime($files['updated_at'])) }}</td>
                                        </tr>

                                        <tr>
                                            <td>{{ __('Last Updated') }}</td>
                                            <td>{{ date("D d F Y h:ia", strtotime($files['updated_at'])) }}</td>
                                        </tr>--}}


                                        <tr>
                                    
                                            
                                            
                                                <div class="btn-group">
                                                    <a href="" class="tip btn btn-success tip btn-flat" title="" data-original-title="Edit Product">
                                                        <i class="fa fa-edit"></i>
                                                        <span class="hidden-sm hidden-xs"> {{ __('Edit') }}</span>
                                                    </a>
                                                </div>
                                                
                                            </div>
                                        

                                        </tr>


                                    </tbody>
                                </table>
                            </div>
                            <!-- /.box-body -->
                        </div>
                        <!-- /.box -->
                    </section>
                    <!-- /.content -->

                </div>
            </div>
        </div>
    </div>

</div>
@endsection

