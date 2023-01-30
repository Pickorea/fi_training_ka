<!DOCTYPE html>
<html>
<head>
<style>
#customers {
  font-family: Arial, Helvetica, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

#customers td, #customers th {
  border: 1px solid #ddd;
  padding: 8px;
}

#customers tr:nth-child(even){background-color: #f2f2f2;}

#customers tr:hover {background-color: #ddd;}

#customers th {
  padding-top: 12px;
  padding-bottom: 12px;
  text-align: left;
  background-color: #04AA6D;
  color: white;
}
</style>
</head>
<body>
<table  class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>{{ __(' SL#') }}</th>                     
                            <th>{{ __(' Full Name') }}</th>
                          <th>{{ __(' WORK STATUS') }}</th>
                            <th>{{ __(' START DATE') }}</th>
                            <th>{{ __(' END DATE') }}</th>
                            <th>{{ __('DAYS') }}</th>
                            <th>{{ __('ALERT') }}</th>
                           
                        </tr>
                    </thead>
                    <tbody id="myTable">
                        @php $sl = 1; @endphp
                        @php
                        $now = Carbon::now();
                                       
                        @endphp
                      
                     {{--dd($employees)--}}
                        @forelse($employees as $employeeworkstatus)
                        <tr>
                           
                        <td>{{ $sl++ }}</td>
                            <td>{{$employeeworkstatus->name}}</td>
                            @if ($employeeworkstatus->work_status_name !='Permenant')
                            <td>  {{$employeeworkstatus->work_status_name}}</td>
                            @elseif($employeeworkstatus->work_status_name ='Permenant') 
                            <td> {{$employeeworkstatus->unestablished =='unestblished'?'Archived':'Archived'}}</td>
                            @endif
                            <td>{{$employeeworkstatus->start_date}}</td>
                            <td>{{$employeeworkstatus->end_date}}</td>
                            @php
                            $start_date=Carbon::parse($employeeworkstatus->start_date);
                             $end_date=Carbon::parse($employeeworkstatus->end_date);
                            @endphp
                             <td>
                            {{ $start_date->diffInDays($end_date)}}
                            </td>
                            @if ($employeeworkstatus->start_date <= carbon::now())
                            <td  style="background-color:lightgreen">Expire</td>
                            @else ($employeeworkstatus->end_date >= carbon::now())
                            <td  style="background-color:lightyellow">Active</td>
                            @endif
                          
                       
                        </tr>
                            
                            @empty
                            <p>
                                <strong>
                                    
                                <h4 class='card'> NO WORK STATUS AT THE MOMENT PLEASE COME BACK AGAIN </h4>
                               
                                </strong>
                            </p>
                          
                           
                      
                        @endforelse
                          
                        
                    </tbody>
                </table>
</body>
</html>