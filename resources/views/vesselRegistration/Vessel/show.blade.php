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
                    <a  class="d-inline-block text-primary text-uppercase " href="{{route('island.edit',$island)}}">Edit Island Profile</a>
                    <h3>Island-Info</h3>
                    </form>
                    </div>
                    <div>

                    <div class="col-md-8">
                        <div class="tab-content profile-tab" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                    
                                     
                            <h1>{{ $vesselRegistration->name }}</h1>
                                <p><strong>Registration Number:</strong> {{ $vesselRegistration->registration_number }}</p>
                                <p><strong>Village:</strong> {{ $vesselRegistration->village->name }}</p>
                                <p><strong>Owner:</strong> {{ $vesselRegistration->owner->name }}</p>
                                <p><strong>Island:</strong> {{ $vesselRegistration->island->name }}</p>
                                <a href="{{ route('vessel-registrations.edit', $vesselRegistration->id) }}">Edit</a>

                                       
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

