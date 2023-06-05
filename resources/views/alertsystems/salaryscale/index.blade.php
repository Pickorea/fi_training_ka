@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h1>Salary Scales</h1>
            <div>
                <a href="{{ route('salaryscales.create') }}" class="btn btn-primary">Create Salary Scale</a>
            </div>
        </div>

        <div class="mb-3">
            <div class="input-group">
                <input type="text" id="search" name="search" class="form-control" placeholder="Search">
                <button id="searchBtn" class="btn btn-primary">Search</button>
            </div>
        </div>

        <div class="table-responsive">
            <table id="salaryTable" class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Job Title</th>
                        <th>Minimum Salary</th>
                        <th>Maximum Salary</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
    // Function to fetch and display data
    function fetchData(search) {
        $.ajax({
            url: "{{ route('salaryscales.getDataTables') }}",
            type: 'GET',
            data: { search: search },
            success: function(response) {
                console.log(response);
                // Clear the existing table rows
                $('#salaryTable tbody').empty();

                // Check if response contains data
                if (response && response.data && response.data.length > 0) {
                    // Iterate through the response data and add rows to the table
                    $.each(response.data, function(index, salaryScale) {
                        var editUrl = "{{ route('salaryscales.edit', ':id') }}";
                        editUrl = editUrl.replace(':id', salaryScale.id);

                        var showUrl = "{{ route('salaryscales.show', ':id') }}";
                        showUrl = showUrl.replace(':id', salaryScale.id);

                        var row = "<tr>" +
                            "<td>" + salaryScale.id + "</td>" +
                            "<td>" + salaryScale.name + "</td>" +
                            "<td>" + (salaryScale.job_title ? salaryScale.job_title.name : '') + "</td>" +
                            "<td>" + salaryScale.minimum_salary + "</td>" +
                            "<td>" + salaryScale.maximum_salary + "</td>" +
                            "<td><a href=\"" + editUrl + "\" class=\"btn btn-sm btn-primary\">Edit</a> <a href=\"" + showUrl + "\" class=\"btn btn-sm btn-secondary\">Show</a></td>" +
                            "</tr>";

                        $('#salaryTable tbody').append(row);
                    });
                } else {
                    // Display a message when no data is available
                    var noDataMessage = "<tr><td colspan='6'>No data available</td></tr>";
                    $('#salaryTable tbody').append(noDataMessage);
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
});

    </script>
@endsection
