<!DOCTYPE html>
<html>
<head>
	<title>Training Report</title>
	<style>
		/* Body styles */
		body {
			font-family: Arial, sans-serif;
			background-color: #ffffff;
			padding: 20px;
		}

		/* Table styles */
		table {
			border-collapse: collapse;
			background-color: #ffffff;
			box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
			margin-bottom: 20px;
			width: 100%;
			max-width: 1000px;
			margin-left: auto;
			margin-right: auto;
			border: 1px solid #cccccc;
			outline: 1px solid #cccccc;
		}

		table thead tr {
			background-color: #f8f8f8;
			border-bottom: 1px solid #cccccc;
		}

		table th {
			padding: 10px;
			text-align: left;
			font-weight: bold;
			border-right: 1px solid #cccccc;
		}

		table td {
			padding: 10px;
			border-bottom: 1px solid #cccccc;
			border-right: 1px solid #cccccc;
		}

		table tfoot tr {
			background-color: #f8f8f8;
			border-top: 1px solid #cccccc;
		}

		table tfoot td {
			padding: 10px;
			font-weight: bold;
			border-right: 1px solid #cccccc;
		}

		/* Page title styles */
		h1 {
			font-size: 24px;
			color: #444;
			margin-bottom: 20px;
			text-align: center;
			text-transform: uppercase;
			letter-spacing: 2px;
		}

		/* Footer styles */
		footer {
			font-size: 14px;
			color: #666;
			text-align: center;
			margin-top: 20px;
			padding-top: 20px;
			border-top: 1px solid #cccccc;
		}

	</style>
</head>
<body>
	<header>
		<h1>Training Report</h1>
	</header>

	<table>
	    <thead>
	        <tr>
	            <th>ID</th>
	            <th>Island Name</th>
	            <th>Village Name</th>
	            <th>Training Date</th>
	            <th>Participant First Name</th>
	            <th>Participant Last Name</th>
	            <th>Age</th>
	            <th>Gender</th>
	            <th>Training Name</th>
	        </tr>
	    </thead>
	    <tbody>
	        @foreach($trainings as $training)
	            <tr>
	                <td>{{ $training->id }}</td>
	                <td>{{ $training->island_name }}</td>
	                <td>{{ $training->village_name }}</td>
	                <td>{{date('d-m-Y', strtotime($training->training_date ))}}</td>
	                <td>{{ $training->participant_first_name }}</td>
	                <td>{{ $training->participant_last_name }}</td>
	                <td>{{ $training->age }}</td>
	                <td>{{ $training->gender ==='1'?"Male":"Female" }}</td>
	                <td>{{ $training->training_name }}</td>
	            </tr>
	        @endforeach
	    </tbody>
	    <tfoot>
	    	<tr>
	    		<td colspan="9">Total Trainings: {{ count($trainings) }}</td>
	    	</tr>
	    </tfoot>
	</table>

	<footer>
		<p>&copy; 2023 Training Report</p>
	</footer>

</body>
</html>
