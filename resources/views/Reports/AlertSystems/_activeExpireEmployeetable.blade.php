<!DOCTYPE html>
<html>
<head>
<style>
.styled-table {
    border-collapse: collapse;
    margin: 25px 0;
    font-size: 0.9em;
    font-family: sans-serif;
    min-width: 400px;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
}
.styled-table thead tr {
    background-color: #009879;
    color: #ffffff;
    text-align: left;
}
.styled-table th,
.styled-table td {
    padding: 12px 15px;
}

.styled-table tbody tr {
    border-bottom: 1px solid #dddddd;
}

.styled-table tbody tr:nth-of-type(even) {
    background-color: #f3f3f3;
}

.styled-table tbody tr:last-of-type {
    border-bottom: 2px solid #009879;
}

.styled-table tbody tr.active-row {
    font-weight: bold;
    color: #009879;
}
.header {
                position: fixed;
                top: -60px;
                left: 0px;
                right: 0px;
                height: 50px;
                font-size: 20px !important;
                background-color: #000;
                color: white;
                text-align: center;
                line-height: 35px;
            }
</style>
</head>
<body>
  
<table class="styled-table">
    
                    <thead>
                        <tr>
                        <th class="header" colspan="8"><center><b> ACTIVE AND EXPIRED CONTRACTED EMPLOYEE LIST </b></center></th >
                        </tr>
                        <tr>
                            <th>{{ __(' SL#') }}</th>                     
                            <th>{{ __(' FULL NAME') }}</th>
                          <th>{{ __(' WORK STATUS') }}</th>
                            <th>{{ __(' START DATE') }}</th>
                            <th>{{ __(' END DATE') }}</th>
                            <th>{{ __('DAYS') }}</th>
                           {{--<th>{{ __('LEFT DAYS') }}</th>--}}
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
                            $left_days = Carbon\Carbon::now()->diffInDays($end_date, false);
                            $no_of_days = $start_date->diffInDaysFiltered(function(Carbon $date) {
                            return !$date->isSunday();
                        }, $end_date);

                            @endphp
                            <td>
                             {{$no_of_days}}
                             </td>
                             {{--<td>
                             {{$left_days}}
                             </td>--}}
                            @if ($employeeworkstatus->end_date <= carbon::now())
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

