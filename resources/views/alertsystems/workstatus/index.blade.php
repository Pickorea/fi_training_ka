@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Work Status</h1>
        <div>
            <a href="{{ route('work_status.create') }}" class="btn btn-primary">Create Work Status</a>
        </div>
    </div>

    <div class="mb-3">
        <div class="input-group">
            <input type="text" id="search" name="search" class="form-control" placeholder="Search">
            <button id="searchBtn" class="btn btn-primary">Search</button>
        </div>
    </div>

    <div class="table-responsive">
        <table id="workStatusTable" class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Work Status Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
            </tbody>
        </table>
    </div>

    <div id="pagination" class="mt-4">
        <nav>
            <ul class="pagination justify-content-center"></ul>
        </nav>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function() {
        // Function to fetch and display data
        function fetchData(search, page) {
            $.ajax({
                url: "{{ route('work_status.getDataTables') }}",
                type: 'GET',
                data: { search: search, page: page },
                success: function(response) {
                    console.log(response);
                    // Clear the existing table rows
                    $('#workStatusTable tbody').empty();

                    // Check if response contains data
                    if (response && response.data && response.data.length > 0) {
                        // Iterate through the response data and add rows to the table
                        $.each(response.data, function(index, workStatus) {
                            var editUrl = "{{ route('work_status.edit', ':id') }}";
                            editUrl = editUrl.replace(':id', workStatus.id);

                            var showUrl = "{{ route('work_status.show', ':id') }}";
                            showUrl = showUrl.replace(':id', workStatus.id);

                            var row = "<tr>" +
                                "<td>" + workStatus.id + "</td>" +
                                "<td>" + workStatus.work_status_name + "</td>" +
                                "<td><a href=\"" + editUrl + "\" class=\"btn btn-sm btn-primary\">Edit</a> <a href=\"" + showUrl + "\" class=\"btn btn-sm btn-secondary\">Show</a></td>" +
                                "</tr>";

                            $('#workStatusTable tbody').append(row);
                        });
                    } else {
                        // Display a message when no data is available
                        var noDataMessage = "<tr><td colspan='6'>No data available</td></tr>";
                        $('#workStatusTable tbody').append(noDataMessage);
                    }

                    // Update pagination links
                    $('#pagination ul').empty();
                    for (var i = 1; i <= response.meta.last_page; i++) {
                        var activeClass = i === response.meta.current_page ? 'active' : '';
                        var pageLink = "<li class='page-item " + activeClass + "'><a class='page-link' href='#'>" + i + "</a></li>";
                        $('#pagination ul').append(pageLink);
                    }
                },
                error: function(xhr) {
                    // Handle error cases
                    console.log('Error:', xhr.responseText);
                }
            });
        }

        // Initial data fetch
        fetchData('', 1);

        // Search button click event
        $('#searchBtn').click(function() {
            var searchValue = $('#search').val();
            fetchData(searchValue, 1);
        });

        // Pagination link click event
        $(document).on('click', '#pagination ul li a', function(e) {
            e.preventDefault();
            var page = $(this).text();
            fetchData($('#search').val(), page);
        });
    });
</script>
@endsection
