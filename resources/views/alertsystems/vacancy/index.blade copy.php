@extends('layouts.app')

@push('styles')
<script src="{{ asset('css/datatable/jquery.dataTables.css') }}"></script>
@endpush

@push('scripts')
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css">
    <script src="{{ asset('js/datatable/jquery.dataTables.js') }}"></script>
@endpush


<script>
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
                type: 'POST',
                data: function (d) {
                    d._token = '{{ csrf_token() }}';
                },
                dataSrc: function(json) {
                    return json.data;
                },
                error: function (xhr, error, thrown) {
                    console.log('DataTables error: ' + thrown);
                }
            },

            columns: [
    {data: 'name', name: 'name'},
    {data: 'id', name: 'id', searchable: false, sortable: false},
],

        columnDefs: [
            {
                // The `data` parameter refers to the data for the cell (defined by the
                // `data` option, which defaults to the column being worked with, in
                // this case `data: 0`.
                "render": function ( data, type, row ) {
                    if (permissionEditAll || permissionEdit ) {
                        return "<!-- Split button -->" +
                            '<div class="btn-group pull-right">' +
                            '<a href="{{ route('jobtitle.show',0) }}' + data + '" class="btn btn-outline-info"> @lang('buttons.general.crud.view')</a>' +
                            '<button class="btn btn-outline-info dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">' +
                            '<span class="caret"></span>' +
                            '<span class="sr-only">Toggle Dropdown</span>' +
                            '</button>' +
                            '<ul class="dropdown-menu">' +
                            '<li><a href="{{ route('jobtitle.show',0) }}' + data + '/edit"><i class="fa fa-pencil-alt" aria-hidden="true"></i> @lang('buttons.general.crud.edit')</a></li>' +
                            '<li data-item-id="' + data + '" data-title="Delete License" data-message="Are you sure you want to delete this License record ?" >' +
                            '<a class="formConfirm" href="" onClick="deleteConfirm(event, this)"><i class="fa fa-trash" aria-hidden="true"></i> @lang('buttons.general.crud.delete')</a>' +
                            '</li></ul></div>';
                    } else {
                        return '<a href="{{ route('jobtitle.show', 0) }}' + data + '" class="btn btn-outline-info pull-right">@lang('buttons.general.crud.view')</a>';
                    }
                },
                "targets": 1
            },
        ]
    });
};


    var isColumnVisible = function(columnname) {
        var column = table.column( columnname );
        return (column) ? column.visible() : false ;
        }

        var toggleColumn  = function(columnname) {
            var column = table.column( columnname );
            var visible = (! column.visible()) ;
            column.visible( visible );
        }

        var draw = function() { table.draw() ;}
        var row = function(rowSelector) { return table.row(rowSelector) ;}

        // return public methods
        return {
            init: init,
            draw: draw,
            row: row,
            isColumnVisible: isColumnVisible,
            toggleColumn: toggleColumn
        };

    })();
    // $(function() {
    //     datatable.init('#data-table');
    //     $('#data-table').DataTable();
    // });
</script>
 

@section('content')
    <h1>Index Job Title</h1>
    <table class="table table-hover" id="data-table" width="100%" data-page-length="100" data-href="{{ route("jobtitle.datatables") }}" data-order='[[ 0, "desc" ]]'>
        <thead>
        <tr>
            <th> Name</th>
            <th>Department Name</th>
         
      
            <th><div align="right"><a href="{{ route('jobtitle.create') }}" class="btn btn-outline-info">Add</a></div></th>
        </tr>
        </thead>

        <tbody>

        </tbody>
    </table>
@endsection
