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
        <th>Island</th>
        <th>Village</th>
        <th> Date</th>
        <th>Training</th>
        <th>Male</th>
        <th>Female</th>
        <th>Total</th>
    </tr>
    </thead>
    <tbody>
    
    @foreach($collection as $item)
        <tr>
            <td>{{ $item->Island  }}</td>
            <td>{{ $item->Village  }}</td>
            <td>{{date('d-m-Y', strtotime($item->Date ))}}</td>
            <td>{{ $item->Training   }}</td>
            <td>{{ $item->Male  }}</td>
            <td>{{ $item->Female  }}</td>
            <td>{{ $item->Total   }}</td>
            
        </tr>
    @endforeach
    </tbody>
</table>
</body>
</html>