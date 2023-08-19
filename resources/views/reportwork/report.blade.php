@extends('include.master')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="container-fluid">
                    <br>
                    <!-- Date and time range -->
                    <form action="{{route('reportwork.daterange')}}" method="POST" id="daterange">
                        @csrf
                        <div class="col-md-12">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Date range:</h3>
                                </div>  
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group" style="margin-left:20px;">
                                                <label>Date range button:</label>
                                                <input name="dateRangehid" type="hidden" id="dateRangehid">
                                                <div class="input-group">
                                                    <button type="button" class="btn btn-default float-right" id="reportrange">
                                                        <i class="far fa-calendar-alt"></i> <span></span>
                                                        <i class="fas fa-caret-down"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2 ">
                                            <br>
                                            <div class="form-group">
                                                <button onclick="" name="search" type="submit"
                                                class="btn btn-primary">Search</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- /.form group -->
                    <div class="row">
                        <div class="col-12">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Datatable </h3>
                                </div>
                                <div class="card-body">
                                    <table id="reportwork" action="reportwork.report" class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>S.No.</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Phone</th>
                                                <th>CusID</th>
                                                <th>Call Disposition</th>
                                                <th>Call Back</th>
                                                <th>Remarks</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data as $item)
                                                <tr>
                                                    <td>{{$item->id}}</td>  
                                                    <td>{{$item->name}}</td>  
                                                    <td>{{$item->email}}</td>  
                                                    <td>{{$item->phone}}</td>  
                                                    <td>{{$item->cusid}}</td>  
                                                    <td>{{$item->call_disposition}}</td>  
                                                    <td>{{$item->call_back}}</td>  
                                                    <td>{{$item->remarks}}</td>  
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <br>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                </div>
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>

<script type="text/javascript">
        $(function() {
            var start = moment().subtract(0, 'days');
            var end = moment();
    
            function cb(start, end) {
                $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
                $('#dateRangehid').val(start.format('YYYY-MM-DD') + '@' + end.format('YYYY-MM-DD'));
            }
            $('#reportrange').daterangepicker({
                startDate: start,
                endDate: end,
                ranges: {
                    'Today': [moment(), moment()],
                    'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                }
            }, cb);
            cb(start, end);
        });
    </script>
    <script>
        $(function () {
          $("#reportwork").DataTable({
            "responsive": true, "lengthChange": false, "autoWidth": false,
            "buttons": ["csv"]
          }).buttons().container().appendTo('#reportwork_wrapper .col-md-6:eq(0)');
        });
      </script>
@endsection