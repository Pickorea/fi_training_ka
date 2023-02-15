@extends('layouts.app')
@section('title', __('Weather'))

@section('content')
<div class="container">
<div class="content-wrapper">

    <section class="content-header">
        <h1>
            {{ __('WEATHER FORECAST FOR KIRIBATI') }}
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
                <h3 class="box-title">{{ __('KIRIBATI 3 HOUR WEATHER FORCAST') }}</h3>

            </div>
                    <div id="printable_area" class="col-md-12 table-responsive">
                        <h4>Coordinates</h4>
                       cod: {{$response["cod"]}} <br>
                       message: {{$response["message"]}} <br>
                       cnt: {{$response["cnt"]}} <br>
                       
                       <hr>
                        <h4>List 0</h4>
                        dt: {{$response["list"][0]["dt"]}} <br>
                        temp: {{$response["list"][0]["main"]["temp"]}} <br>
                        feels_like: {{$response["list"][0]["main"]["feels_like"]}} <br>
                        temp_min: {{$response["list"][0]["main"]["temp_min"]}} <br>
                        temp_max: {{$response["list"][0]["main"]["temp_max"]}} <br>
                        pressure: {{$response["list"][0]["main"]["pressure"]}} <br>
                        sea_level: {{$response["list"][0]["main"]["sea_level"]}} <br>
                        grnd_level: {{$response["list"][0]["main"]["grnd_level"]}} <br>
                        humidity: {{$response["list"][0]["main"]["humidity"]}} <br>
                        temp_kf: {{$response["list"][0]["main"]["temp_kf"]}} <br>
                       <hr>
                        <h4>Weather</h4>
                        id: {{$response["list"][0]["weather"][0]["id"]}} <br>
                         main: {{$response["list"][0]["weather"][0]["main"]}} <br>
                        description: {{$response["list"][0]["weather"][0]["description"]}} <br>
                        icon: {{$response["list"][0]["weather"][0]["icon"]}} <br>
                 
                        <hr>
                        <h4>clouds</h4>
                        all: {{$response["list"][0]["clouds"]["all"]}} <br>
                        
                        <hr>
                        <h4>wind</h4>
                        speed:{{$response["list"][0]["wind"]["speed"]}} <br>
                        deg:{{$response["list"][0]["wind"]["deg"]}} <br>
                        deg:{{$response["list"][0]["wind"]["gust"]}} <br>
                   
                   <hr>
                        <h4>visibility</h4>
                        visibility:{{$response["list"][0]["visibility"]}} <br>
                        <hr>
                
                        <h4>pop</h4>
                        pop:{{$response["list"][0]["pop"]}} <br>
                        <hr>

                        <h4>sys</h4>
                        sys:{{$response["list"][0]["sys"]["pod"]}} <br>
                        dt_txt:{{$response["list"][0]["dt_txt"]}} <br>
                        <hr>
                        <hr>
                        <h4>List 1</h4>
                         dt: {{$response["list"][1]["dt"]}} <br>
                         temp: {{$response["list"][1]["main"]["temp"]}} <br>
                        feels_like: {{$response["list"][1]["main"]["feels_like"]}} <br>
                        temp_min: {{$response["list"][1]["main"]["temp_min"]}} <br>
                        temp_max: {{$response["list"][1]["main"]["temp_max"]}} <br>
                        pressure: {{$response["list"][1]["main"]["pressure"]}} <br>
                        sea_level: {{$response["list"][1]["main"]["sea_level"]}} <br>
                        grnd_level: {{$response["list"][1]["main"]["grnd_level"]}} <br>
                        humidity: {{$response["list"][1]["main"]["humidity"]}} <br>
                        temp_kf: {{$response["list"][1]["main"]["temp_kf"]}} <br>

                        <hr>
                        <h4>Weather</h4>
                        id: {{$response["list"][1]["weather"][0]["id"]}} <br>
                         main: {{$response["list"][1]["weather"][0]["main"]}} <br>
                        description: {{$response["list"][1]["weather"][0]["description"]}} <br>
                        icon: {{$response["list"][1]["weather"][0]["icon"]}} <br>

                        <hr>
                        <h4>clouds</h4>
                        all: {{$response["list"][1]["clouds"]["all"]}} <br>
                        
                        <hr>
                        <h4>wind</h4>
                        speed:{{$response["list"][1]["wind"]["speed"]}} <br>
                        deg:{{$response["list"][1]["wind"]["deg"]}} <br>
                        deg:{{$response["list"][1]["wind"]["gust"]}} <br>
                   
                   <hr>
                        <h4>visibility</h4>
                        visibility:{{$response["list"][1]["visibility"]}} <br>
                        <hr>
                
                        <h4>pop</h4>
                        pop:{{$response["list"][1]["pop"]}} <br>
                        <hr>

                        <h4>sys</h4>
                        sys:{{$response["list"][1]["sys"]["pod"]}} <br>
                        dt_txt:{{$response["list"][1]["dt_txt"]}} <br>
                        <hr>

                        <hr>
                        <hr>
                        <h4>List 2</h4>
                         dt: {{$response["list"][2]["dt"]}} <br>
                         temp: {{$response["list"][2]["main"]["temp"]}} <br>
                        feels_like: {{$response["list"][2]["main"]["feels_like"]}} <br>
                        temp_min: {{$response["list"][2]["main"]["temp_min"]}} <br>
                        temp_max: {{$response["list"][2]["main"]["temp_max"]}} <br>
                        pressure: {{$response["list"][2]["main"]["pressure"]}} <br>
                        sea_level: {{$response["list"][2]["main"]["sea_level"]}} <br>
                        grnd_level: {{$response["list"][2]["main"]["grnd_level"]}} <br>
                        humidity: {{$response["list"][2]["main"]["humidity"]}} <br>
                        temp_kf: {{$response["list"][2]["main"]["temp_kf"]}} <br>

                        <hr>
                        <h4>Weather</h4>
                        id: {{$response["list"][2]["weather"][0]["id"]}} <br>
                         main: {{$response["list"][2]["weather"][0]["main"]}} <br>
                        description: {{$response["list"][2]["weather"][0]["description"]}} <br>
                        icon: {{$response["list"][2]["weather"][0]["icon"]}} <br>

                        <hr>
                        <h4>clouds</h4>
                        all: {{$response["list"][2]["clouds"]["all"]}} <br>
                        
                        <hr>
                        <h4>wind</h4>
                        speed:{{$response["list"][2]["wind"]["speed"]}} <br>
                        deg:{{$response["list"][2]["wind"]["deg"]}} <br>
                        deg:{{$response["list"][2]["wind"]["gust"]}} <br>
                   
                   <hr>
                        <h4>visibility</h4>
                        visibility:{{$response["list"][2]["visibility"]}} <br>
                        <hr>
                
                        <h4>pop</h4>
                        pop:{{$response["list"][2]["pop"]}} <br>
                        <hr>

                        <h4>sys</h4>
                        sys:{{$response["list"][2]["sys"]["pod"]}} <br>
                        dt_txt:{{$response["list"][2]["dt_txt"]}} <br>
                        <hr>

                        <hr>
                        <hr>
                        <h4>List 3</h4>
                         dt: {{$response["list"][3]["dt"]}} <br>
                         temp: {{$response["list"][3]["main"]["temp"]}} <br>
                        feels_like: {{$response["list"][3]["main"]["feels_like"]}} <br>
                        temp_min: {{$response["list"][3]["main"]["temp_min"]}} <br>
                        temp_max: {{$response["list"][3]["main"]["temp_max"]}} <br>
                        pressure: {{$response["list"][3]["main"]["pressure"]}} <br>
                        sea_level: {{$response["list"][3]["main"]["sea_level"]}} <br>
                        grnd_level: {{$response["list"][3]["main"]["grnd_level"]}} <br>
                        humidity: {{$response["list"][3]["main"]["humidity"]}} <br>
                        temp_kf: {{$response["list"][3]["main"]["temp_kf"]}} <br>

                        <hr>
                        <h4>Weather</h4>
                        id: {{$response["list"][3]["weather"][0]["id"]}} <br>
                         main: {{$response["list"][3]["weather"][0]["main"]}} <br>
                        description: {{$response["list"][3]["weather"][0]["description"]}} <br>
                        icon: {{$response["list"][3]["weather"][0]["icon"]}} <br>

                        <hr>
                        <h4>clouds</h4>
                        all: {{$response["list"][3]["clouds"]["all"]}} <br>
                        
                        <hr>
                        <h4>wind</h4>
                        speed:{{$response["list"][3]["wind"]["speed"]}} <br>
                        deg:{{$response["list"][3]["wind"]["deg"]}} <br>
                        deg:{{$response["list"][3]["wind"]["gust"]}} <br>
                   
                   <hr>
                        <h4>visibility</h4>
                        visibility:{{$response["list"][3]["visibility"]}} <br>
                        <hr>
                
                        <h4>pop</h4>
                        pop:{{$response["list"][3]["pop"]}} <br>
                        <hr>

                        <h4>sys</h4>
                        sys:{{$response["list"][3]["sys"]["pod"]}} <br>
                        dt_txt:{{$response["list"][3]["dt_txt"]}} <br>
                        <hr>
                 
                      

        




            
            

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