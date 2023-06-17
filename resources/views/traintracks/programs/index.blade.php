@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Program</h1>

        <div class="row mb-3">
            <div class="col-md-6">
                <input type="text" id="search-input" class="form-control" placeholder="Search...">
            </div>
            <div class="col-md-6 text-right">
                <a href="{{ route('program.create') }}" class="btn btn-primary">Create Program</a>
            </div>
        </div>

        <table id="program-table" class="table table-bordered">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Duration</th>
                    <th>Program ID</th>
                    <th>Trainer</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <!-- Course data will be dynamically loaded here -->
            </tbody>
        </table>

        <div class="d-flex justify-content-center">
            <!-- Pagination links will be displayed here -->
            <div id="pagination-links"></div>
        </div>
    </div>
@endsection

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function () {
        // Function to fetch and populate course data
        function fetchCourses() {
            $.ajax({
                url: '{{ route("program.datatables") }}',
                type: 'GET',
                dataType: 'json',
                success: function (response) {
                    console.log(response);
                    // Clear existing table data
                    $('#program-table tbody').empty();

                    // Check if data is available
                    if (response && response.data && response.data.length > 0) {
                        // Iterate through the response data and add rows to the table
                        $.each(response.data, function (index, course) {
                            var row = '<tr>' +
                                '<td>' + course.title + '</td>' +
                                '<td>' + course.description + '</td>' +
                                '<td>' + course.duration + '</td>' +
                                '<td>' + (course.program ? course.program.program_id : '') + '</td>' +
                                '<td>' + (course.program ? course.program.trainer : '') + '</td>' +
                                '<td>' +
                                '<div class="btn-group">' +
                                '<button type="button" class="btn btn-sm btn-secondary dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">' +
                                'Actions' +
                                '</button>' +
                                '<div class="dropdown-menu">' +
                                '<a class="dropdown-item" href="#">Show</a>' +
                                '<a class="dropdown-item" href="#">Edit</a>' +
                                '</div>' +
                                '</div>' +
                                '</td>' +
                                '</tr>';

                            $('#program-table tbody').append(row);
                        });
                    } else {
                        // Display a message when no data is available
                        var noDataMessage = "<tr><td colspan='6'>No data available</td></tr>";
                        $('#program-table tbody').append(noDataMessage);
                    }

                    // Update the pagination links
                    $('#pagination-links').html(response.pagination);
                },
                error: function (xhr, status, error) {
                    console.log(xhr.responseText);
                }
            });
        }

        // Call the fetchCourses function to load initial data
        fetchCourses();

        // Event listener for search input
        $('#search-input').on('keyup', function () {
            fetchCourses();
        });
    });
</script>
@endpush
