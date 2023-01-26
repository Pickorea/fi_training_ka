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
                  
                    <div class="col-md-8">
                        <div class="tab-content profile-tab" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                    
                                     
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Training Name</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p>{{$trainingType['training_name']}}</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Training Description</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p>{{$trainingType['training_description']}}</p>
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
    </div>
    <!-- About End -->
  
      

</div>
@endsection

