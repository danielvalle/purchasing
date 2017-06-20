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
                            <span style="font-size: 20px;">Issuance</span> 
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">

                        <div class="panel-body">
                            {!! Form::open(['class' => 'form-inline', 'method' => 'post', 'url' => 'transaction/abstract-quotation-search']) !!}
                        <div class="form-group">   

                            <div class="form-group" style="margin-right: 6px">                          
                                <div class="form-group">
                                    <label for="">Agency</label>
                                    <select class="selectpicker" name="select-rfq-no" id="select-rfq-no">
                                    </select>                              
                                </div>
                            </div>

                            <div class="form-group" style="margin-right: 6px">                          
                                <div class="form-group">
                                    <label for="">Department</label>
                                    <select class="selectpicker" name="select-rfq-no" id="select-rfq-no">
                                    </select>                              
                                </div>
                            </div>

                            <div class="form-group" style="margin-right: 6px">                          
                                <div class="form-group">
                                    <label for="">Office</label>
                                    <select class="selectpicker" name="select-rfq-no" id="select-rfq-no">
                                    </select>                              
                                </div>
                            </div>

                             <div class="form-group">                          
                                <div class="form-group">
                                    <label for="">Reasonability Center</label>
                                    <input type="text" class="form-control">                              
                                </div>
                            </div>
                        </div>

                        <div style="margin: 20px 0"></div>

                        <div class="form-group">   

                            <div class="form-group" style="margin-right: 50px">                          
                                <div class="form-group">
                                    <label for="">RIS No.</label>
                                    <input type="text" class="form-control">                            
                                </div>
                            </div>

                            <div class="form-group" style="margin-right: 50px">                          
                                <div class="form-group">
                                    <label for="">RIS Date</label>
                                    <input type="date" class="form-control">                           
                                </div>
                            </div>

                            <div class="form-group" style="margin-right: 50px">                          
                                <div class="form-group">
                                    <label for="">SAI No.</label>
                                    <input type="text" class="form-control">                            
                                </div>
                            </div>

                             <div class="form-group">                          
                                <div class="form-group">
                                    <label for="">SAI Date.</label>
                                    <input type="date" class="form-control">                              
                                </div>
                            </div>
                        </div>

                         <div class="panel-body">
                            <div class="panel panel-default">
                                <div class="panel-heading"><button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#add-item">Add New Item</button> </div>
                                <div class="panel-body">
                                    <div class="form-group col-lg-12">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Stock No.</th>
                                                    <th style="width: 20%;">Item</th>
                                                    <th>Quantity</th>
                                                    <th>Unit</th>
                                                    <th>Item Description</th>
                                                    <th>Remarks</th>
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

                        <div class="form-group" style="width: 100%">   

                            <div class="form-group" style="margin-right: 50px; width: 100%">                          
                                <div class="form-group" style="width: 100%">
                                    <label for="">Purpose</label>
                                    <textarea style="width: 90%" class="form-control"></textarea>                      
                                </div>
                            </div>

                        </div>

                        <div style="margin: 20px 0"></div>

                        <div class="form-group">
                            <div class="form-group" style="margin-right: 50px">                          
                                <div class="form-group">
                                    <label for="">Requested By</label>
                                    <select class="selectpicker"></select>                                                  
                                </div>
                            </div>

                            <div class="form-group" style="margin-right: 50px">                          
                                <div class="form-group">
                                    <label for="">Requestor Designation</label>
                                    <select class="selectpicker"></select>                         
                                </div>
                            </div>

                             <div class="form-group">                          
                                <div class="form-group">
                                    <label for="">Request Date</label>
                                    <input type="date" class="form-control">                              
                                </div>
                            </div>
                        </div>

                        <div style="margin: 20px 0"></div>

                        <div class="form-group">
                            <div class="form-group" style="margin-right: 50px">                          
                                <div class="form-group">
                                    <label for="">Requested By</label>
                                    <select class="selectpicker"></select>                                                  
                                </div>
                            </div>

                            <div class="form-group" style="margin-right: 50px">                          
                                <div class="form-group">
                                    <label for="">Requestor Designation</label>
                                    <select class="selectpicker"></select>                         
                                </div>
                            </div>

                             <div class="form-group">                          
                                <div class="form-group">
                                    <label for="">Request Date</label>
                                    <input type="date" class="form-control">                              
                                </div>
                            </div>
                        </div>

                        <div style="margin: 20px 0"></div>

                        <div class="form-group">
                            <div class="form-group" style="margin-right: 50px">                          
                                <div class="form-group">
                                    <label for="">Approved By</label>
                                    <select class="selectpicker"></select>                                                  
                                </div>
                            </div>

                            <div class="form-group" style="margin-right: 50px">                          
                                <div class="form-group">
                                    <label for="">Approver Designation</label>
                                    <select class="selectpicker"></select>                         
                                </div>
                            </div>

                             <div class="form-group">                          
                                <div class="form-group">
                                    <label for="">Approved Date</label>
                                    <input type="date" class="form-control">                              
                                </div>
                            </div>
                        </div>                        
                        
                        <div style="margin: 20px 0"></div>

                        <div class="form-group">
                            <div class="form-group" style="margin-right: 50px">                          
                                <div class="form-group">
                                    <label for="">Issued By</label>
                                    <select class="selectpicker"></select>                                                  
                                </div>
                            </div>

                            <div class="form-group" style="margin-right: 50px">                          
                                <div class="form-group">
                                    <label for="">Issuer Designation</label>
                                    <select class="selectpicker"></select>                         
                                </div>
                            </div>

                             <div class="form-group">                          
                                <div class="form-group">
                                    <label for="">Issued Date</label>
                                    <input type="date" class="form-control">                              
                                </div>
                            </div>
                        </div>

                        </div>             
                        {!! Form::close() !!}

                        <div id="add-item" class="modal fade" role="dialog">
                            <div class="modal-dialog">
                                {!! Form::open(['url' => 'transaction/purchase-request/add-item', 'method' => 'post']) !!}
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title">Add New Item</h4>
                                    </div>
                                    <div class="modal-body container-fluid">
                                        <div class="col-lg-12">
                                            <div class="form-group col-lg-6">
                                                <label for="">Item:</label>
                                                <select class="form-control" name="add-item" id="add-item">

                                                </select>
                                            </div>        
                                            <div class="form-group col-lg-3">
                                                <label for="">Quantity</label>
                                                <input type="number" class="form-control" name="add-quantity" id="add-quantity" required>
                                            </div>   
                                            <div class="form-group col-lg-3">
                                                <label for="">Unit</label>
                                                <select class="form-control" name="add-unit" id="add-unit">

                                                </select>
                                            </div>    
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="form-group col-lg-12">
                                                <label for="">Remarks:</label>
                                                <textarea type="text" class="form-control"></textarea>
                                            </div>        
                                        </div>


                                    </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-success">Add</button>
                                            <button type="button" class="btn btn-default" data-dismiss="modal" id="modal-close">Close</button>
                                        </div>
                                </div>
                                {!! Form::close() !!}
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