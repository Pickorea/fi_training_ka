<!-- index.blade.php -->

@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Job Titles</div>

                    <div class="card-body">
                        <table class="table" id="dataTable">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Job Title ID</th>
                                    <th>Job Title Name</th>
                                    <th>Department Name</th>
                                    <th>Edit</th>
                                    <th>Show</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function() {
    // DataTable initialization and configuration
    $('#dataTable').DataTable({
        serverSide: true,
        processing: true,
        ajax: {
            url: '{{ route("jobtitle.datatables") }}',
            type: 'GET',
            data: function (data) {
                data.search = $('#searchInput').val();
                data.order_by = $('#orderBySelect').val();
                data.sort = $('#sortSelect').val();
            },
        },
        columns: [
            { data: 'id', name: 'id' },
            { data: 'job_title_id', name: 'job_title_id' },
            { data: 'name', name: 'name' },
            { data: 'department_name', name: 'department_name' },
            { 
                data: null,
                render: function (data, type, row) {
                    return '<a href="{{ route("jobtitle.edit", ":id") }}">Edit</a>'.replace(':id', data.id);
                }
            },
            { 
                data: null,
                render: function (data, type, row) {
                    return '<a href="{{ route("jobtitle.show", ":id") }}">Show</a>'.replace(':id', data.id);
                }
            },
        ],
        initComplete: function(settings, json) {
            console.log('Data retrieved:', json); // Log the data retrieved from the server
        }
    });
});

    </script>
@endsection
