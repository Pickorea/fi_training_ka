@extends('layouts.app')


@push('after-scripts')
<script src="{{asset('js/jquery.dataTables.js')}}"></script>

    <script>
        var datatable = (function () {
            var permissionEdit =true;
			var permissionEditAll = true;
            var permissionVms = false;
            // var ownerOrganisation = 1;

            var table ;

            var init = function (item) {
                var htmlTable = $(item);
                table = htmlTable.DataTable({
                    searching: false,
                    bLengthChange: false,
                    searchDelay: 500,
                    processing: true,
                    serverSide: true,
                    ajax: {
                        url: htmlTable.data('href'),
                        type: 'post',
                        data: function (d) {
                            d._token = '{!! csrf_token() !!}';
                            //d.search = $('input[name=search]').val();

                        }
                    },
                    columns: [
                        {data: 'work_status_name', name: 'work_status_name'},
                        {data: 'id', name: 'id', searchable: false, sortable: false},

                    ],
                    columnDefs: [
                        {
                            // The `data` parameter refers to the data for the cell (defined by the
                            // `data` option, which defaults to the column being worked with, in
                            // this case `data: 0`.
                            "render": function ( data, type, row ) {
                                if (true || true ) {
                                    return "<!-- Split button -->" +
                                        '<div class="btn-group pull-right">' +
                                        '<a href="{{ route('work_status.show',0) }}' + data + '" class="btn btn-outline-info"> @lang('buttons.general.crud.view')</a>' +
                                        '<button class="btn btn-outline-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">' +
                                        '<span class="caret"></span>' +
                                        '<span class="sr-only">Toggle Dropdown</span>' +
                                        '</button>' +
                                        '<ul class="dropdown-menu">' +
                                        '<li><a href="{{ route('work_status.show',0) }}' + data + '/edit"><i class="fa fa-pencil-alt" aria-hidden="true"></i> @lang('buttons.general.crud.edit')</a></li>' +
                                        '<li data-item-id="' + data + '" data-title="Delete License" data-message="Are you sure you want to delete this License record ?" >' +
                                        '<a class="formConfirm" href="" onClick="deleteConfirm(event, this)"><i class="fa fa-trash" aria-hidden="true"></i> @lang('buttons.general.crud.delete')</a>' +
                                        '</li></ul></div>';
                                } else {
                                    return '<a href="{{ route('work_status.show', 0) }}' + data + '" class="btn btn-outline-info pull-right">@lang('buttons.general.crud.view')</a>';
                                }
                            },
                            "targets": 1
                        },
                    ]
                });
            };

           


        $(function() {
            datatable.init('#data-table');
            //$('#data-table').DataTable();
        });

    </script>
@endpush

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>

    <h1>Index Work Status</h1>

    <table class="table table-hover" id="data-table" width="100%" data-page-length="100" data-href="{{ route("work_status.datatable") }}" data-order='[[ 0, "desc" ]]'>
        <thead>
        <tr>
            <th>Work Status Name</th>

            <th>
		
			<a href="{{ route('work_status.create') }}" class="btn btn-outline-info">Add</a>
		
		

			</th>
        </tr>
        </thead>

        <tbody>

        </tbody>
    </table>
@endsection
