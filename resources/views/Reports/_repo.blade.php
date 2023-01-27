@extends('layouts.app')
@section('title', __('Training Report'))

@section('content')
    <section class="content-header">
        <h1>
            {{ __('TRAINING REPORTS') }}
        </h1>
    </section>

    

    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box">
        <form method="POST" enctype="multipart/form-data" id="upload-file" action="{{ route('training.store') }}" >
                                                                    @csrf
                                       
                                          <div class="box-body">
                                                                                          
                                                   <div class="form-group col-md-3">
                                                   <label for="route"><span class="text-danger">*</span> REPORT NAME</label>
                                                   <select name="forma"  data-placeholder="Select island" style="width:350px;"   class="chosen-select" tabindex="5" onchange="location =    this.options[this.selectedIndex].value;">
                                                        <option value="" selected disabled>{{ __('Select one') }}</option>
                                                        @foreach($urls as $url)
                                                        <option value="{{route($url->url, $url->id)}}"> <a href="{{route('excelreport.excel', $url->id)}}">{{ $url['name'] }}</a> </option>
                                                        @endforeach
                                                    </select>
                                                           @if(session()->has('error'))
                                                            <div class="alert alert-danger">
                                                               {{ session()->get('error') }}
                                                            </div>
                                                         @endif
                                                      
                                                   </div>
                                             
                                                   
                                                </div>
                                            
                                       </form>
           
    </section>
    <!-- /.content -->

@endsection