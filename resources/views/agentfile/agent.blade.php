@extends('include.master')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row ">
                <div class="col-12">
                    <div class="card card-primary card-outline">
                        <div class="card-header">  
                            <br>                        
                            <form action="{{route('agentfile.search')}}" method="POST" id="agent">
                                @csrf
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <div class="input-group input-group-lg">
                                                <input type="search" name="search" id="search" class="form-control form-control-lg" placeholder="Enter Phone Number">
                                                <div class="input-group-append">
                                                    <button type="submit" class="btn btn-lg btn-default">
                                                    <i class="fa fa-search"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>    
                    </div>
                    @isset($results)
                    <div class="card card-primary card-outline">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="name">Name:</label>
                                        <input name="name" type="text" value="{{$results[0]->name}}" class="form-control" id="name" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="email">Email:</label>
                                        <input name="email" type="email" value="{{$results[0]->email}}" class="form-control" id="email" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="phone">Phone Number:</label>
                                        <input name="phone" type="text" value="{{$results[0]->phone}}" class="form-control" id="phone" readonly>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>CusID:</label>
                                        <input name="cusid" type="text" value="{{$results[0]->cusid}}" class="form-control" id="cusid" readonly>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3>Customer Details : </h3>
                        </div>
                        <div class="card-body">  
                            <br>                        
                            <form action="{{route('agentfile.cti')}}" id="cti" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Call Disposition : <span class="text-danger">*</span></label>
                                            <select class="form-control select2bs4" style="width: 100%;" name="call_disposition" id="call_disposition">
                                                <option value="">Select</option>
                                                <option value="Call Back">Call Back</option>
                                                <option value="Call Not Connected">Call Not Connected</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Call Back: <span class="text-danger">*</span></label>
                                              <div class="input-group date" id="reservationdate" name="reservationdate" data-target-input="nearest">
                                                  <input type="text" id="callback" name="callback" class="form-control datetimepicker-input" data-target="#reservationdate"/>
                                                  <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                                                      <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                                                  </div>
                                              </div>
                                          </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="remarks">Remarks : <span class="text-danger">*</span></label>
                                            <textarea name="remarks" type="text" class="form-control" id="remarks"></textarea>
                                        </div>
                                    </div>
                                    <input name="id1" type="hidden" value="{{$results[0]->id}}" id="id1"/>
                                    <div class="col-md-1">
                                        <br><br>
                                        <div class="form-group">
                                            <button onclick="" name="submit" type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>    
                    </div>
                    @endisset
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $(function() {
        $('#agent').validate({
            rules: {
                search: {
                    required: true
                },  
            },

            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });
    });
</script>
<script>
    $(function() {
        $('#cti').validate({
            rules: {
                call_disposition: {
                    required: true
                },  
                callback: {
                    required: true,
                },
                remarks: {
                    required: true
                },
            },

            errorElement: 'span',
            errorPlacement: function(error, element) {
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
            },
            highlight: function(element, errorClass, validClass) {
                $(element).addClass('is-invalid');
            },
            unhighlight: function(element, errorClass, validClass) {
                $(element).removeClass('is-invalid');
            }
        });
    });
</script>

<script>
    $(function () {
      //Datemask dd/mm/yyyy
      $('#datemask').inputmask('dd/mm/yyyy', { 'placeholder': 'dd/mm/yyyy' })
      //Datemask2 mm/dd/yyyy
      $('#datemask2').inputmask('mm/dd/yyyy', { 'placeholder': 'mm/dd/yyyy' })
      //Money Euro
      $('[data-mask]').inputmask()
  
      //Date picker
      $('#reservationdate').datetimepicker({
          format: 'L'
      });
  
      //Date and time picker
      $('#reservationdatetime').datetimepicker({ icons: { time: 'far fa-clock' } });
  
      //Date range picker
      $('#reservation').daterangepicker()
      //Date range picker with time picker
      $('#reservationtime').daterangepicker({
        timePicker: true,
        timePickerIncrement: 30,
        locale: {
          format: 'MM/DD/YYYY hh:mm A'
        }
      });
      //Date range as a button
      $('#daterange-btn').daterangepicker(
        {
          ranges   : {
            'Today'       : [moment(), moment()],
            'Yesterday'   : [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
            'Last 7 Days' : [moment().subtract(6, 'days'), moment()],
            'Last 30 Days': [moment().subtract(29, 'days'), moment()],
            'This Month'  : [moment().startOf('month'), moment().endOf('month')],
            'Last Month'  : [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
          },
          startDate: moment().subtract(29, 'days'),
          endDate  : moment()
        },
        function (start, end) {
          $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
        });
    });
  </script>

@endsection