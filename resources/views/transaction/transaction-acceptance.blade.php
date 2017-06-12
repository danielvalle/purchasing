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
                            <span style="font-size: 20px;">Acceptance</span> 
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">

                        <div class="panel-body">
                            {!! Form::open(['class' => 'form-inline', 'method' => 'post', 'url' => 'transaction/abstract-quotation-search']) !!}
                        <div class="form-group" style="width: 100%">   
                            <div class="form-group" style="width: 50%; float: left">
                                <div class="form-group" style="width: 100%">
                                    <label for="" style="width: 30%">Acceptance Number:</label>
                                    <input class="form-control" type="text" readonly>                               
                                </div>
                                
                                <div style="margin: 10px 0"></div>

                                <div class="form-group" style="width: 100%">
                                    <label for="" style="width: 30%">Purchase Order Number:</label>
                                    <select class="selectpicker" name="select-rfq-no" id="select-rfq-no">
                                    </select>     
                                </div>

                                <div style="margin: 10px 0"></div>

                                <div class="form-group" style="width: 100%">
                                    <label for="" style="width: 30%">Purchase Order Date:</label>
                                    <select class="selectpicker" name="select-rfq-no" id="select-rfq-no">
                                    </select>     

                                    <button class="form-control btn btn-success">Select</button> 
                                </div>
                            </div>

                            <div class="form-group" style="width: 50%; float: left">
                                
                                <div class="form-group" style="width: 100%">
                                    <label for="" style="width: 10%">Agency:</label>
                                    <select class="selectpicker" name="select-rfq-no" id="select-rfq-no">
                                    </select>                              
                                </div>

                                <div style="margin: 10px 0"></div>

                                <div class="form-group" style="width: 100%">
                                    <label for="" style="width: 10%">Supplier:</label>
                                    <select class="selectpicker" name="select-rfq-no" id="select-rfq-no">
                                    </select>                              
                                </div>

                                <div style="margin: 10px 0"></div>

                                <div class="form-group" style="width: 100%">
                                    <label for="" style="width: 10%">IAR:</label>
                                    <select class="selectpicker" name="select-rfq-no" id="select-rfq-no">
                                    </select>                              
                                </div>

                            </div>
                        </div>
                            {!! Form::close() !!}
                        </div>             

                         <div class="panel-body">
                            <div class="panel panel-default">
                                <div class="panel-heading"></div>
                                <div class="panel-body">
                                    <div class="form-group col-lg-12">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th style="width: 20%;">Item</th>
                                                    <th>Quantity</th>
                                                    <th>Unit</th>
                                                    <th>Item Description</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                </tr>
                                            </tbody>
                                        </table>
                                        
                                    </div>  
                                </div>             
                            </div>
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