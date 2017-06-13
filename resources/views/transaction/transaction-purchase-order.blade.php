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
                            <span style="font-size: 20px;">Purchase Order</span> 
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">

                        <div class="panel-body">
                            {!! Form::open(['class' => 'form-inline', 'method' => 'post', 'url' => 'transaction/abstract-quotation-search']) !!}
                        <div class="form-group" style="width: 100%">   
                            <div class="form-group" style="width: 50%; float: left">
                                <div class="form-group" style="width: 100%">
                                    <label for="" style="width: 35%">Purchase Order Number:</label>
                                    <input class="form-control" type="text" readonly>                               
                                </div>
                                
                                <div style="margin: 10px 0"></div>

                                <div class="form-group" style="width: 100%">
                                    <label for="" style="width: 35%">Purchase Request Number:</label>
                                    <select class="selectpicker" name="select-rfq-no" id="select-rfq-no">
                                    </select>     

                                    <button class="form-control btn btn-success">Select</button> 
                                </div>
                            </div>

                            <div class="form-group" style="width: 50%; float: left">
                                
                                <div class="form-group" style="width: 100%">
                                    <label for="" style="width: 10%">Agency:</label>
                                    <select class="selectpicker" name="select-rfq-no" id="select-rfq-no">
                                        @foreach($agencies as $agency)
                                            <option value="{{ $user->id }}">{{ $agency->agency_name }}</option>
                                        @endforeach
                                    </select>                              
                                </div>

                                <div style="margin: 10px 0"></div>

                                <div class="form-group" style="width: 100%">
                                    <label for="" style="width: 10%">Supplier:</label>
                                    <select class="selectpicker" name="select-rfq-no" id="select-rfq-no">
                                    </select>                              
                                </div>

                            </div>
                        </div>
                            {!! Form::close() !!}
                        </div>        

                               
                        </div>  
       

                         <div class="panel-body">
                            <div class="panel panel-default">
                                <div class="panel-heading"></div>
                                <div class="panel-body">
                                    <div class="form-group col-lg-12">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Item No.</th>
                                                    <th style="width: 20%;">Item</th>
                                                    <th>Unit</th>
                                                    <th>Supplier 1 Amount</th>
                                                    <th>Supplier 2 Amount</th>
                                                    <th>Supplier 3 Amount</th>
                                                    <th>Supplier 4 Amount</th>
                                                    <th>Supplier 5 Amount</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td><input class="form-control" type="number"></td>
                                                    <td><input class="form-control" type="number"></td>
                                                    <td><input class="form-control" type="number"></td>
                                                    <td><input class="form-control" type="number"></td>
                                                    <td><input class="form-control" type="number"></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        
                                    </div>  
                                </div>             
                            </div>

                            <div style="float: left; width: 100%; margin: 30px 0;">
                                <div class="form-group col-lg-5">
                                    <label for="">Address</label>
                                    <input type="text" class="form-control" name="add-tin" id="add-tin">
                                </div>
                                <div class="form-group col-lg-3">
                                    <label for="">TIN</label>
                                    <input type="text" class="form-control" name="add-tin" id="add-tin">
                                </div>  
                                <div class="form-group col-lg-2">
                                    <label for="add-birthday" >Date</label>         
                                    <input type="date" class="form-control" id="add-birthday" name="add-birthday" value="{{ date("Y-m-d") }}" required>
                                </div>
                                <div class="form-group col-lg-2">
                                    <label for="">Mode Of Procurement</label>
                                    <input type="text" class="form-control" name="add-tin" id="add-tin">
                                </div>

                                <div class="form-group col-lg-6">
                                    <label for="">Place Of Delivery</label>
                                    <input type="text" class="form-control" name="add-place-delivery" id="add-place-delivery">
                                </div>   
                                <div class="form-group col-lg-2">
                                    <label for="">Date Of Delivery</label>
                                    <input type="date" class="form-control" id="add-birthday" name="add-birthday" value="{{ date("Y-m-d") }}" required>
                                </div>   
                                <div class="form-group col-lg-2">
                                    <label for="">Delivery Term</label>
                                    <input type="text" class="form-control" name="add-tin" id="add-tin">
                                </div>
                                <div class="form-group col-lg-2">
                                    <label for="">Payment Term</label>
                                    <input type="text" class="form-control" name="add-tin" id="add-tin">
                                </div>

                                <div class="form-group col-lg-4">
                                    <label for="">Authorized Official</label>
                                    <select class="form-control" name="add-requested-by" id="add-requested-by">
                                        @foreach($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->first_name }} {{ $user->middle_name }} {{ $user->last_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-lg-4">
                                    <label for="">Total Amount</label>
                                    <input type="number" class="form-control" name="add-tin" id="add-tin">
                                </div>
                                <div class="form-group col-lg-4">
                                    <label for="">ALOBS/BUB No.</label>
                                    <input type="text" class="form-control" name="add-tin" id="add-tin">
                                </div>                   
                            </div>

                            <button class="btn btn-success" style="float: right; width: 20%;">Convert to PO</button> 
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