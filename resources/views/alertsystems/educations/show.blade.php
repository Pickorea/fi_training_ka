@extends('layouts.app')

@section('content')

<div class="container">

    <div class="row justify-content-center">

     <!-- About Start -->
     <div class="col-md-12">
            <div class="card card-new-task">
                
     <div class="container-fluid py-5">
        <div class="container">
            <div class="row gx-5">
               
                <div class="col-lg-7">
                    <div class="mb-4">
                    <form method="post">
                    
                    
                        <h1>Training Infor:</h1>

                        
                    </form>
                    </div>
                    <div>

                    <div class="col-md-8">
                        <div class="tab-content profile-tab" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                    
                                     
                                        <div class="row">
                                        @foreach($training as $item)
                                            
                                            
                                            <div class="col-md-6">
                                                <label>Island Name:</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p>{{$item->island_name}}</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Village Name:</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p>{{$item->village_name}}</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Training Name:</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p>{{$item->training_name}}</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>First Name:</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p>{{$item->participant_first_name}}</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Last Name:</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p>{{$item->participant_last_name}}</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Age:</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p>{{$item->age}}</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Gender:</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p>{{$item->gender?'Male':'Female'}}</p>
                                            </div>
                                            @endforeach
                                        </div>
                                 
                                      
                                       
                            </div>
                           
                                       
                                       
                        </div>
                    </div>


                    </div>
                  
                   
                </div>
            </div>
        </div>
    </div>
    </div>
        </div>
    </div>
    <!-- About End -->
  
      

</div>
@endsection

