@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-between align-items-center mb-4">
            <h1>Job Titles</h1>
            <div>
                <a href="{{ route('jobtitle.create') }}" class="btn btn-primary">Create Job Title</a>
                <a href="{{ route('jobtitle.toexcel') }}" class="btn btn-primary">Export to Excel</a>
            </div>
        </div>

        <div class="mb-3">
            <div class="input-group">
                <input type="text" id="search" name="search" class="form-control" placeholder="Search">
                <button id="searchBtn" class="btn btn-primary">Search</button>
            </div>
        </div>

        <div class="table-responsive">
            <table class="table" id="jobTitleTable">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Job Title Name</th>
                        <th>Department Name</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        $(document).ready(function() {
            // Function to fetch and display data
            function fetchData(search) {
                $.ajax({
                    url: "{{ route('jobtitle.datatables') }}",
                    type: 'GET',
                    data: { search: search },
                    success: function(response) {
                        console.log(response);
                        // Clear the existing table rows
                        $('#jobTitleTable tbody').empty();

                        // Check if response contains data
                        if (response && response.data && response.data.length > 0) {
                            // Iterate through the response data and add rows to the table
                            $.each(response.data, function(index, item) {
                                var showUrl = "{{ route('jobtitle.show', ['jobtitle' => 'jobtitle_id']) }}".replace('jobtitle_id', item.id);
                                var editUrl = "{{ route('jobtitle.edit', ['jobtitle' => 'jobtitle_id']) }}".replace('jobtitle_id', item.id);

                                var row = "<tr>" +
                                    "<td>" + item.id + "</td>" +
                                    "<td>" + (item.job_title ? item.job_title.name : '') + "</td>" +
                                    "<td>" + item.department_name + "</td>" +
                                    "<td>" +
                                    "<a href='" + showUrl + "' class='btn btn-sm btn-secondary'>Show</a> " +
                                    "<a href='" + editUrl + "' class='btn btn-sm btn-primary'>Edit</a>" +
                                    "</td>" +
                                    "</tr>";

                                $('#jobTitleTable tbody').append(row);
                            });
                        } else {
                            // Display a message when no data is available
                            var noDataMessage = "<tr><td colspan='5'>No data available</td></tr>";
                            $('#jobTitleTable tbody').append(noDataMessage);
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
