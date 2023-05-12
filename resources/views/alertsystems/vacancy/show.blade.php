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
                    <a  class="d-inline-block text-primary text-uppercase " href="{{route('employee.edit',$department)}}">Edit Profile</a>
                      
                    </form>
                    </div>
                    <div>

                    <div class="col-md-8">
                        <div class="tab-content profile-tab" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                    
                                     
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Department Name</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p>{{$department['department_name']}}</p>
                                            </div>
                                        </div>

                                     

                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Vacancy Status</label>
                                            </div>
                                            <div class="col-md-6">
                                            <p>{{ optional($vacancyStatuses)->status }}</p>
                                                @if(isset($vacancyStatuses[$vacancy->status]))
                                                    {{ $vacancyStatuses[$vacancy->status] }}
                                                @endif
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

    <form action="{{ route('vacancy.updateStatus', $vacancy->id) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="form-group">
        <label for="status">Status</label>
        <select name="status" id="status" class="form-control">
            <option value="Open" {{$statuses->status == 'Open' ? 'selected' : '' }}>{{ __('Open') }}</option>
            <option value="Closed" {{$statuses->status =='Closed' ? 'selected' : '' }}>{{ __('Closed') }}</option>
            <option value="Filled" {{$statuses->status =='Filled' ? 'selected' : '' }}>{{ __('Filled') }}</option>
        </select>

    </div>
    <button type="submit" class="btn btn-primary">Update Status</button>
</form>


</div>
@endsection
