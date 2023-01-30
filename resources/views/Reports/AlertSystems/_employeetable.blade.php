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
                            <th>{{ __(' Age') }}</th>
                            <th>{{ __(' Email') }}</th>
                            <th>{{ __(' Work Status') }}</th>
                            <th>{{ __(' Created At') }}</th>
                         
                        </tr>
                    </thead>
                    <tbody id="myTable">
                        @php $sl = 1; @endphp
                     
                        @foreach($employees as $employee)
                        <tr>
                            <td>{{ $sl++ }}</td>
                            <td>{{ $employee->name}}</td>
                            <td>{{ $employee->age}}</td>
                            <td>{{ $employee->email}}</td>
                            <td>{{ $employee->work_status_name}}</td>
                            <td class="text-center">{{ date("d F Y", strtotime($employee->created_at)) }}</td>
                         </tr>
                        @endforeach
                    </tbody>
                </table>
</body>
</html>