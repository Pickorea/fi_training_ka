@extends('layouts.app')

@section('content')
    <div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
    <h1>EMPLOYEES</h1>
    <div>
        <a href="{{ route('employee.create') }}" class="btn btn-primary">Create Employees</a>
        <div class="btn-group">
            <button type="button" class="btn btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Export
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="{{ route('employee.toexcel', ['format' => 'xlsx']) }}">Excel (XLSX)</a></li>
                <!-- <li><a class="dropdown-item" href="{{ route('employee.toexcel', ['format' => 'csv']) }}">CSV</a></li> -->
            </ul>
        </div>
    </div>
</div>

        <div class="mb-3">
            <div class="input-group">
                <input type="text" id="search" name="search" class="form-control" placeholder="Search">
                <button id="searchBtn" class="btn btn-primary">Search</button>
            </div>
        </div>

        <div class="table-responsive">
            <table id="employeeTable" class="table">
                <thead>
                    <tr>
                        <th>{{ __('SL#') }}</th>
                        <th>{{ __('Full Name') }}</th>
                        <th>{{ __('Martial Status') }}</th>
                        <th>{{ __('Email') }}</th>
                        <th>{{ __('Work Status') }}</th>
                        <th>{{ __('Job Title') }}</th>
                        <th>{{ __('Department') }}</th>
                        <th>{{ __('PF') }}</th>
                        <th>{{ __('Joining Date') }}</th>
                        <th>{{ __('Gender') }}</th>
                        <th>{{ __('DoB') }}</th>
                        <th class="text-center">{{ __('Actions') }}</th>
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
                    url: "{{ route('employee.datatables') }}",
                    type: 'GET',
                    data: { search: search },
                    success: function(response) {
                        console.log(response);
                        // Clear the existing table rows
                        $('#employeeTable tbody').empty();

                        // Check if response contains data
                        if (response && response.data && response.data.length > 0) {
                            // Iterate through the response data and add rows to the table
                            $.each(response.data, function(index, item) {
                                var showUrl = "{{ route('employee.show', ['employee' => 'employee_id']) }}".replace('employee_id', item.id);
                                var editUrl = "{{ route('employee.edit', ['employee' => 'employee_id']) }}".replace('employee_id', item.id);

                                var gender = item.gender === '1' ? 'Female' : 'Male';

                                var row = "<tr>" +
                                "<td>" + item.id + "</td>" +
                                "<td>" + item.name + "</td>" +
                                "<td>" + (item.marital_status === '1' ? "{{ __('Married') }}" :
                                item.marital_status === '2' ? "{{ __('Single') }}" :
                                item.marital_status === '3' ? "{{ __('Divorced') }}" :
                                item.marital_status === '4' ? "{{ __('Separated') }}" :
                                item.marital_status === '5' ? "{{ __('Widowed') }}" : '') +
                                "</td>" +

                                "<td>" + item.email + "</td>" +
                                "<td>" + item.work_status_name + "</td>" +
                                "<td>" + item.job_title_name + "</td>" +
                                "<td>" + item.department_name + "</td>" +
                                "<td>" + item.pf_number + "</td>" +
                                "<td>" + item.joining_date + "</td>" +
                                "<td>" + gender + "</td>" +
                                "<td>" + item.date_of_birth + "</td>" +
                                "<td>" +
                                "<div class='btn-group'>" +
                                "<button type='button' class='btn btn-sm btn-secondary dropdown-toggle' data-bs-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>" +
                                "Actions" +
                                "</button>" +
                                "<div class='dropdown-menu'>" +
                                "<a class='dropdown-item' href='" + showUrl + "'>Show</a>" +
                                "<a class='dropdown-item' href='" + editUrl + "'>Edit</a>" +
                                "</div>" +
                                "</div>" +
                                "</td>" +
                                "</tr>";


                                $('#employeeTable tbody').append(row);
                            });
                        } else {
                            // Display a message when no data is available
                            var noDataMessage = "<tr><td colspan='11'>No data available</td></tr>";
                            $('#employeeTable tbody').append(noDataMessage);
                        }
                    },
                    error: function(xhr) {
                        // Handle error cases
                        console.log('Error:', xhr.responseText);
                    }
                });

                // Initialize DataTables
                $('#employeeTable').DataTable();
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
