@extends('layouts.master')

@section('content')


        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Transaction</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>

            <div class="row">   
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <span style="font-size: 20px;">Disbursement Voucher</span> 
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            
                            <div class="form-group col-lg-12">
                                <label for="">Mode Of Payment:&nbsp&nbsp&nbsp&nbsp</label>
                                <label class="radio-inline"><input type="radio" name="optradio">MDS Check</label>
                                <label class="radio-inline"><input type="radio" name="optradio">Commercial Check</label>
                                <label class="radio-inline"><input type="radio" name="optradio">ADA</label>
                                <label class="radio-inline"><input type="radio" name="optradio">Others</label>
                            </div>


                            <div class="form-group col-lg-4">
                                <label for="">Payee</label>
                                <select class="form-control">
                                </select>    
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="">TIN/Employee No.</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="">OR/BUR No.</label>
                                <input type="text" class="form-control">
                            </div>


                            <div class="form-group col-lg-6">
                                <label for="">Address</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="">Office/Unit/Projet</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="form-group col-lg-2">
                                <label for="">Code</label>
                                <input type="text" class="form-control">
                            </div>


                            <div class="form-group col-lg-10">
                                <label for="">Explanation</label>
                                <textarea type="text" class="form-control" rows="2"></textarea>
                            </div>
                            <div class="form-group col-lg-2">
                                <label for="">Amount</label>
                                <input type="number" class="form-control">
                            </div>

                        </div>
                            
                        <div class="panel-body">
                        
                            <div class="form-group col-lg-12">
                                <label for="">Certified:&nbsp&nbsp&nbsp&nbsp</label>
                                <label class="radio-inline"><input type="radio" name="optradio">MDS Check</label>
                                <label class="radio-inline"><input type="radio" name="optradio">Commercial Check</label>
                                <label class="radio-inline"><input type="radio" name="optradio">ADA</label>
                                <label class="radio-inline"><input type="radio" name="optradio">Others</label>
                            </div>
                            <div class="form-group col-lg-4">
                                <label>Certifier:</label>
                                <select class="form-control">
                                </select> 
                            </div>
                            <div class="form-group col-lg-4">
                                <label>Date:</label>
                                <input type="date" class="form-control" id="add-sai-date" name="add-sai-date" value="{{ date("Y-m-d") }}" required>
                            </div>

                        </div>

                        <div class="panel-body">
                        
                            <div class="form-group col-lg-12">
                                <label for="">Approved For Payment:</label>
                                <textarea type="text" class="form-control" rows="2"></textarea>
                            </div>
                            <div class="form-group col-lg-4">
                                <label>Approver:</label>
                                <select class="form-control">
                                </select> 
                            </div>
                            <div class="form-group col-lg-4">
                                <label>Date:</label>
                                <input type="date" class="form-control" id="add-sai-date" name="add-sai-date" value="{{ date("Y-m-d") }}" required>
                            </div>

                        </div>

                        <div class="panel-body">
                        
                            <div class="form-group col-lg-4">
                                <label for="">Check/ADA No.</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="form-group col-lg-2">
                                <label>Date:</label>
                                <input type="date" class="form-control" id="add-sai-date" name="add-sai-date" value="{{ date("Y-m-d") }}" required>
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="">Bank Name</label>
                                <input type="text" class="form-control">
                            </div>
                            <div class="form-group col-lg-2">
                                <label>Date:</label>
                                <input type="date" class="form-control" id="add-sai-date" name="add-sai-date" value="{{ date("Y-m-d") }}" required>
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="">Printed Name</label>
                                <select class="form-control"></select>
                            </div>
                            <div class="form-group col-lg-2">
                                <label>Date:</label>
                                <input type="date" class="form-control" id="add-sai-date" name="add-sai-date" value="{{ date("Y-m-d") }}" required>
                            </div>

                            <div class="form-group col-lg-4">
                                <label for="">JEV No.</label>
                                <input type="text" class="form-control">
                            </div>         
                            <div class="form-group col-lg-2">
                                <label>Date:</label>
                                <input type="date" class="form-control" id="add-sai-date" name="add-sai-date" value="{{ date("Y-m-d") }}" required>
                            </div>   

                            <div class="form-group col-lg-12">
                                <label for="">Official Receipt/Other Documents</label>
                                <input type="text" class="form-control">
                            </div>

                        </div>                        


                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
  
        </div>
        <!-- /#page-wrapper -->

@stop

@section('scripts')

    <script>
    $(document).ready(function() {
        $('#dt-designation').DataTable({
            responsive: true
        });

        var monthNames = [ "January", "February", "March", "April", "May", "June",
        "July", "August", "September", "October", "November", "December" ];
        
        var dayNames= ["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"]

        var newDate = new Date();
        newDate.setDate(newDate.getDate());    
        $('#Date').html(dayNames[newDate.getDay()] +" | " +" " + " " + newDate.getDate() + ' ' + monthNames[newDate.getMonth()] + "," + ' ' + newDate.getFullYear());
        $('#transaction_date').val(newDate.getFullYear() + "-" +  (newDate.getMonth()+1) + "-" + newDate.getDate());


    });


    $(document).ready(function(){

        $('#modal-close').click(function(){
            location.reload(true);
        });

        $('#btn-add-supplier').click(function(){

            $.ajaxSetup({
                headers:
                { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') }
            });

            $.ajax({
                url: 'purchase-request/add-supplier',
                type: "post",
                data: {
                    'id': $('#select-add-supplier').find('option:selected').val(), 
                    'name' : $('#select-add-supplier').find('option:selected').text()
                },
                dataType: 'json',
                success: function(data){

                    $('#select-add-supplier option[value=' + data.id + ']').remove();
                    $('#table-suppliers tbody').append(
                        '<tr>' +
                        '<td>' + data.name + '</td>' +
                        '<td>' +
                            '<input type="hidden" id="' + data.id + '" value="' + data.id + '" >' +
                            '<button type="button" style="color:red" id="btn-del-supplier"><span class="glyphicon glyphicon-trash"></span></button>' +
                        '</td>' +
                        '</tr>'
                    );

                    if($('#select-add-supplier').has('option').length == 0 ) {
                        $('#btn-add-supplier').prop('disabled', true);
                    }
                }

            });      

        }); 
    
    });

    </script>

@stop