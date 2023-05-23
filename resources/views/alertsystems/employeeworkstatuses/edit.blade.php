@extends('layouts.app')

@section('content')

<div class="container">
   <div class="row justify-content-center">
      <div class="col-md-12">
         <div class="card">
            <div class="card-header">{{ __('RENEW EMPLOYEE WORK DURATION') }} - {{ $employees->first()->name }}</div>
            <div class="card-body">
               <form method="POST" action="{{ route('employeeworkstatuses.update', $employeeworkstatus->id) }}">
                  @csrf
                  @method('PUT')

                  <div class="form-group">
                     <label for="start_date">{{ __('Start Date') }}</label>
                     <input id="start_date" type="date" class="form-control @error('start_date') is-invalid @enderror" name="start_date" value="{{ old('start_date', $employeeworkstatus->start_date) }}" required autocomplete="start_date" autofocus>
                     @error('start_date')
                        <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                        </span>
                     @enderror
                  </div>






                  <div class="form-group">
                     <label for="end_date">{{ __('End Date') }}</label>
                     <input id="end_date" type="date" class="form-control @error('end_date') is-invalid @enderror" name="end_date" value="{{ old('end_date', $employeeworkstatus->end_date ? $employeeworkstatus->end_date->format('Y-m-d') : null) }}" required autocomplete="end_date" autofocus>
                     @error('end_date')
                        <span class="invalid-feedback" role="alert">
                              <strong>{{ $message }}</strong>
                        </span>
                     @enderror
                  </div>



                  <div class="form-group mb-0">
                     <button type="submit" class="btn btn-primary">
                        {{ __('Renew') }}
                     </button>
                  </div>
               </form>
            </div>
         </div>
      </div>
   </div>
</div>

@endsection
