@extends('layouts.app')
@section('title', __('Weather'))

@section('content')
<div class="container">
<div class="content-wrapper">

    <section class="content-header">
        <h1>
            {{ __('WEATHER FORCAST FOR KIRIBATI') }}
        </h1>
         <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ url('/home') }}">Dashboard</a></li>
                <li class="breadcrumb-item"><a href="{{ url('/island') }}">Island List</a></li>
                <li class="breadcrumb-item active" aria-current="page">Employee List</li>
            </ol>
        </nav>
    </section>

    <!-- Main content -->
    <section class="content">
        <!-- Default box -->
        <div class="box">
            <div class="box-header with-border">
                <h3 class="box-title">{{ __('KIRIBATI WEATHER') }}</h3>

            </div>
                    <div id="printable_area" class="col-md-12 table-responsive">
                        <h4>Coordinates</h4>
                        Long: {{$response["coord"]["lon"]}} <br>
                        Lat: {{$response["coord"]["lat"]}} <br>
                        <hr>
                        <h4>Weather</h4>
                        ID: {{$response["weather"][0]["id"]}} <br>
                        Main: {{$response["weather"][0]["main"]}} <br>
                        Description: {{$response["weather"][0]["description"]}} <br>
                        Icon: {{$response["weather"][0]["icon"]}} <br>
                        <hr>
                        <h4>Main</h4>
                        Temp:{{$response["main"]["temp"]}} <br>
                        Humid:{{$response["main"]["humidity"]}} <br>
                        Pressure:{{$response["main"]["pressure"]}} <br>
                        Temp_min:{{$response["main"]["temp_min"]}} <br>
                        Temp_max:{{$response["main"]["temp_max"]}} <br>
                        <hr>
                        <h4>Wind</h4>
                        Speed:{{$response["wind"]["speed"]}} <br>
                        Deg:{{$response["wind"]["deg"]}} <br>
                        <hr>
                        <h4>dt</h4>
                        dt:{{$response["dt"]}} <br>
                        id:{{$response["id"]}} <br>
                        name:{{$response["name"]}} <br>
                        cod:{{$response["cod"]}} <br>
                        <hr>
                        <h4>Clouds</h4>
                        all:{{$response["clouds"]["all"]}} <br>
                        <hr>
                        <h4>sys</h4>
                        country:{{$response["sys"]["country"]}} <br>
                        sunrise:{{$response["sys"]["sunrise"]}} <br>
                        sunset:{{$response["sys"]["sunset"]}} <br>

        




            
            

            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </section>
    <!-- /.content -->
</div>
</div>
@endsection

@push('custom-scripts')
<!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> -->
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script> -->
@endpush