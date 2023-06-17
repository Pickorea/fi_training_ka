@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>EMPLOYEES WORK STATUS</h1>
            <div>
                <a href="{{ route('employeeworkstatuses.create') }}" class="btn btn-primary">Create Contract</a>
                <a href="{{ route('employeeworkstatuses.toexcel') }}" class="btn btn-primary">Export to Excel</a>
            </div>
        </div>
        <div class="mb-3">
            <div class="input-group">
                <input type="text" id="search" name="search" class="form-control" placeholder="Search">
                <button id="searchBtn" class="btn btn-primary">Search</button>
            </div>
        </div>

        <div class="table-responsive">
            <table id="workStatusTable" class="table table-striped">
                <thead>
                    <tr>
                        <th>EMPLOYEE</th>
                        <th>WORK</th>
                        <th>START</th>
                        <th>END</th>
                        <th>LIMIT</th>
                        <th>DEPARTMENT</th>
                        <th>JOB</th>
                        <th>SALARY</th>
                        <th>STATUS</th>
                        <th>BALANCE</th>
                        <th>ACTION</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.5.0/dist/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">

    <script>
        $(document).ready(function() {
            // Function to fetch and display data
            function fetchData(search) {
                $.ajax({
                    url: "{{ route('employeeworkstatuses.getDataTables') }}",
                    type: 'GET',
                    data: { search: search },
                    success: function(response) {
                        console.log(response);
                        // Clear the existing table rows
                        $('#workStatusTable tbody').empty();

                        // Check if response contains data
                        if (response && response.data && response.data.length > 0) {
                            // Iterate through the response data and add rows to the table
                            $.each(response.data, function(index, item) {
                                var row = "<tr>" +
                                    "<td>" + item.employee + "</td>" +
                                    "<td>" + item.work_status_name + "</td>" +
                                    "<td>" + item.start_date + "</td>" +
                                    "<td>" + item.end_date + "</td>" +
                                    "<td>" + item.day_count + "</td>" +
                                    "<td>" + (item.department ? item.department : '') + "</td>" +
                                    "<td>" + item.job_title + "</td>" +
                                    "<td>" + item.recommended_salary_scale + "</td>" +
                                    "<td>" + item.status + "</td>" +
                                    "<td>" + item.countdown + "</td>" + // Include balance attribute
                                    "<td>" + item.action + "</td>" + // Include the action value from the response
                                    "</tr>";

                                $('#workStatusTable tbody').append(row);
                            });
                        } else {
                            // Display a message when no data is available
                            var noDataMessage = "<tr><td colspan='11'>No data available</td></tr>";
                            $('#workStatusTable tbody').append(noDataMessage);
                        }
                    },
                    error: function(xhr) {
                        // Handle error cases
                        console.log('Error:', xhr.responseText);
                    }
                });
            }

            // Initial data fetch
            fetchData('');

            // Search button click event
            $('#searchBtn').click(function() {
                var searchValue = $('#search').val();
                fetchData(searchValue);
            });

            // Initialize DataTables
            $('#workStatusTable').DataTable();
        });
    </script>
@endsection
