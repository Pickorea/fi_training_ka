@extends('layouts.app')
@section('title', __('status'))

@section('content')
<!-- CSS -->
<!-- <link rel="stylesheet" type="text/css" href="{{asset('asset/datatables.min.css')}}"> -->

<!-- Script -->
<!-- <script src="{{asset('asset/jquery-3.6.0.min.js')}}" type="text/javascript"></script> -->
<!-- <script src="{{asset('asset/datatables.min.js')}}" type="text/javascript"></script> -->

<table id='empTable' width='100%' border="1" style='border-collapse: collapse;'>
      <thead>
        <tr>
          <td>ID.no</td>
          <td>Work Status Name</td>
        
        </tr>
      </thead>
    </table>
<!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.min.css">
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>  -->
    <!-- <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="http://code.jquery.com/jquery-3.5.1.js"></script> -->
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.5/jquery.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.12/datatables.min.css"/>
 
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.12/datatables.min.js"></script>
<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/2.0.0/jquery.min.js"></script>

    <script type="text/javascript">
  
    $(document).ready(function(){

      // DataTable
      $('#empTable').DataTable({
         processing: true,
         serverSide: true,
         ajax: "{{route('work_status.datatable')}}",
         columns: [
            { data: 'id' },
            { data: 'work_status_name' },
                   ]
      });

    });
    </script>
    @endsection