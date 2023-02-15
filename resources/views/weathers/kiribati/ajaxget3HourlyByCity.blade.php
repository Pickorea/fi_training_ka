@extends('layouts.app')
@section('title', __('Weather'))

@section('content')

		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1.0,maximum-scale=1">
		
		<title>Compass Starter by Ariona, Rian</title>

		<!-- Loading third party fonts -->
		<link href="http://fonts.googleapis.com/css?family=Roboto:300,400,700|" rel="stylesheet" type="text/css">
		<link href="fonts/font-awesome.min.css" rel="stylesheet" type="text/css">

		<!-- Loading main css file -->
		<link rel="stylesheet" href="style.css">
		
		<!--[if lt IE 9]>
		<script src="js/ie-support/html5.js"></script>
		<script src="js/ie-support/respond.js"></script>
		<![endif]-->

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
            <body>
		
		<div class="site-content">
			
			<div class="hero" data-bg-image="images/banner.png">
				<div class="container">
					<form action="#" class="find-location">
						<input type="text" placeholder="Find your location...">
						<input type="submit" value="Find">
					</form>

				</div>
			</div>
			<div class="forecast-table">
				<div class="container">
					<div class="forecast-container">
						<div class="today forecast">
							<div class="forecast-header">
								<div class="day">Monday</div>
								<div class="date">6 Oct</div>
							</div> <!-- .forecast-header -->
							<div class="forecast-content">
								<div class="location">New York</div>
								<div class="degree">
									<div class="num">23<sup>o</sup>C</div>
									<div class="forecast-icon">
										<img src="{{asset('weather/images/icons/icon-1.svg')}}" alt="" width=90>
									</div>	
								
								<span><img src="{{asset('weather/images/icon-umberella.png')}}" alt="">20%</span>
								<span><img src="{{asset('weather/images/icon-wind.png')}}" alt="">18km/h</span>
								<span><img src="{{asset('weather/images/icon-compass.png')}}" alt="">East</span>
							</div>
						</div>
						<div class="forecast">
							<div class="forecast-header">
								<div class="day">Tuesday</div>
							</div> <!-- .forecast-header -->
							<div class="forecast-content">
								<div class="forecast-icon">
									<img src="{{asset('weather/images/icons/icon-3.svg')}}" alt="" width=48>
								</div>
								<div class="degree">23<sup>o</sup>C</div>
								<small>18<sup>o</sup></small>
							</div>
						</div>
						<div class="forecast">
							<div class="forecast-header">
								<div class="day">Wednesday</div>
							</div> <!-- .forecast-header -->
							<div class="forecast-content">
								<div class="forecast-icon">
									<img src="{{asset('weather/images/icons/icon-5.svg')}}" alt="" width=48>
								</div>
								<div class="degree">23<sup>o</sup>C</div>
								<small>18<sup>o</sup></small>
							</div>
						</div>
						<div class="forecast">
							<div class="forecast-header">
								<div class="day">Thursday</div>
							</div> <!-- .forecast-header -->
							<div class="forecast-content">
								<div class="forecast-icon">
									<img src="{{asset('weather/images/icons/icon-7.svg')}}" alt="" width=48>
								</div>
								<div class="degree">23<sup>o</sup>C</div>
								<small>18<sup>o</sup></small>
							</div>
						</div>
						<div class="forecast">
							<div class="forecast-header">
								<div class="day">Friday</div>
							</div> <!-- .forecast-header -->
							<div class="forecast-content">
								<div class="forecast-icon">
									<img src="{{asset('weather/images/icons/icon-12.svg')}}" alt="" width=48>
								</div>
								<div class="degree">23<sup>o</sup>C</div>
								<small>18<sup>o</sup></small>
							</div>
						</div>
						<div class="forecast">
							<div class="forecast-header">
								<div class="day">Saturday</div>
							</div> <!-- .forecast-header -->
							<div class="forecast-content">
								<div class="forecast-icon">
									<img src="{{asset('weather/images/icons/icon-13.svg')}}" alt="" width=48>
								</div>
								<div class="degree">23<sup>o</sup>C</div>
								<small>18<sup>o</sup></small>
							</div>
						</div>
						<div class="forecast">
							<div class="forecast-header">
								<div class="day">Sunday</div>
							</div> <!-- .forecast-header -->
							<div class="forecast-content">
								<div class="forecast-icon">
									<img src="{{asset('weather/images/icons/icon-14.svg')}}" alt="" width=48>
								</div>
								<div class="degree">23<sup>o</sup>C</div>
								<small>18<sup>o</sup></small>
							</div>
						</div>
					</div>
				</div>
			</div>
			
	</div>
		
		<script src="{{asset('weather/js/jquery-1.11.1.min.js')}}"></script>
		<script src="{{asset('weather/js/plugins.js')}}"></script>
		<script src="{{asset('weather/js/app.js')}}"></script>
		
	</body>
        </div>
        <!-- /.box -->
    </section>
    <!-- /.content -->
</div>
</div>
<script>

    //create an object
    var myReq = new XMLHttpRequest();
      myReq.responseType = 'text';
    //provide 3 values to the open methods
    //get methods to retrive an information
    //path to the information
    //true for asyncoronatiallay
    //next we set the send method to start the entire process rolling
   
    myReq.open('GET','https://api.openweathermap.org/data/2.5/weather?q=kiribati&appid=cbd28350662a84847471e9d985789b33',true);

    //In between we create a function that wait for the data to load sucessfully 
    myReq.onload = function(){
    // once the data comes in we can convert it from string to an object and put it in a variable cup
        if (myReq.status === 200){
            var cup = JSON.parse(myReq.responseText); 
            console.log(cup);
        }
    
        
    }


    myReq.send();


</script>
@endsection

@push('custom-scripts')
<!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> -->
<!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script> -->
@endpush



