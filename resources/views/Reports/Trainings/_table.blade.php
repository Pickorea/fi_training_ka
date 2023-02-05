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
</style>
</head>
<body>
<table class="styled-table">
    <thead>
    <tr>
        <th>Name</th>
        <th>Village Name</th>
        <th>Training Date</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Training Name</th>
        <th>Age</th>
        <th>Gender</th>
    </tr>
    </thead>
    <tbody>
    @foreach($trainings as $training)
        <tr>
            <td>{{ $training->island_name }}</td>
            <td>{{ $training->village_name }}</td>
            <td>{{date('d-m-Y', strtotime($training->training_date))}}</td>
            <td>{{ $training->participant_first_name }}</td>
            <td>{{ $training->participant_last_name }}</td>
            <td>{{ $training->training_name }}</td>
            <td>{{ $training->age }}</td>
            <td>{{ $training->gender ?'M':'F'}}</td>
            
        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>