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
                            <th>Employee</th>
                            <th>WORK STATUS</th>
                            <th>START DATE</th>
                            <th>END DATE</th>
                            <th>DAYS COUNT</th>
                            <th>DEPARTMENT</th>
                            <th>JOB TITLE</th>
                            <th>SALARY SCALE</th>
                            <th>STATUS</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($employees as $employee)
                        <tr>
                            <td>{{ $employee->name }}</td>
                            <td>{{ $employee->work_status_name }}</td>
                            <td>{{ $employee->start_date }}</td>
                            <td>{{ $employee->end_date }}</td>
                            <td>{{ $employee->day_count }}</td> <!-- Display the day count -->
                            <td>{{ $employee->department_name }}</td>
                            <td>{{ $employee->job_title_name }}</td>
                            <td>{{ $employee->recommended_salary_scale }}</td>
                            <td>{{ $employee->status }}</td>
                            
                        </tr>
                        @endforeach
                    </tbody>
                </table>

</body>
</html>
