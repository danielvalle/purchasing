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
                            <span style="font-size: 20px;">Request For Quotation</span> 
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                        

                        <div class="panel-body">
                            {!! Form::open(['class' => 'form-inline', 'method' => 'post', 'url' => 'transaction/request-for-quotation-search']) !!}
                            <div class="form-group">
                                <div class="form-group" style="margin-right: 50px;">
                                    <label for="">Select Purchase Number: </label>
                                    <select class="selectpicker" name="select-pr-no" id="select-pr-no">
                                        @foreach($pr_headers as $pr_header)
                                            <option value="{{ $pr_header->id }}">PR No. {{ $pr_header->id }}</option>
                                        @endforeach
                                    </select>                                  
                                </div>

                                <div class="form-group">
                                    <label for="">Select Category: </label>
                                    <select class="selectpicker" data-size="10" data-live-search="true" name="select-category" id="select-category">
                                        @foreach($categories as $category)
                                            <option data-tokens="{{ $category->category_name }}" value="{{ $category->id }}">{{ $category->category_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <button class="form-control btn btn-success">Select</button>
                            </div>
                            {!! Form::close() !!}
                        </div>
                    
                            <div class="panel-body">
                                <div class="panel panel-default">
                                    <div class="panel-heading"></div>
                                    <div class="panel-body">
                                        {!! Form::open(['method' => 'post', 'url' => 'transaction/request-for-quotation']) !!}

                                        <input type="hidden" id="Date" name="Date">
                                        <input type="hidden" id="transaction_date" name="transaction_date" />

                                        <div class="form-inline col-lg-6" style="margin-bottom: 20px;">
                                            <label for="">Supplier(s): </label>
                                            <select class="selectpicker" multiple data-max-options="5" data-size="10" data-live-search="true" name="add-supplier[]" id="add-supplier">
                                                @foreach($suppliers as $supplier)
                                                    <option data-tokens="{{ $supplier->supplier_name }}" value="{{ $supplier->id }}">{{ $supplier->supplier_name }}</option>   
                                                @endforeach
                                            </select>

                                            <input type="hidden" name="pr_id" value="{!! $pr_id !!}">
                                            <input type="hidden" name="category_id" value="{!! $category_id !!}">
                                        </div> 
                                        <div class="form-group col-lg-12">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th>Stock No.</th>
                                                        <th>Item</th>
                                                        <th>Quantity</th>
                                                        <th>Unit</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($purchase_requests as $purchase_request)                          
                                                    <tr>
                                                        <td>{{ $purchase_request->stock_no }}</td>
                                                        <td>{{ $purchase_request->item_name }}</td>
                                                        <input type="hidden" name="item_id" value="{{ $purchase_request->item_id }}">
                                                        <td>{{ $purchase_request->quantity }}</td>
                                                        <input type="hidden" name="quantity" value="{{ $purchase_request->quantity }}">
                                                        <td>{{ $purchase_request->unit_name }}</td>        
                                                        <input type="hidden" name="unit_id" value="{{ $purchase_request->unit_id }}">                                    
                                                        <input type="hidden" name="total" value="{{ $purchase_request->total_cost }}">
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>  
                                        </div>  
                                    </div>             
                                </div>
                            <div style="float: left; width: 100%; margin: 30px 0;">
                                <div class="form-group col-lg-3">
                                    <label for="">VAT/Non-VAT TIN</label>
                                    <input type="text" class="form-control" name="add-tin" id="add-tin">
                                </div>  
                                <div class="form-group col-lg-7">
                                    <label for="">Place Of Delivery</label>
                                    <input type="text" class="form-control" name="add-place-delivery" id="add-place-delivery">
                                </div>   
                                <div class="form-group col-lg-2">
                                    <label for="">Within No. Of Days</label>
                                    <input type="number" class="form-control" name="add-days" id="add-days">
                                </div>   

                                <div class="form-group col-lg-6">
                                    <label for="">Requestor</label>
                                    <select class="form-control" name="add-requestor" id="add-requestor">
                                        @foreach($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->first_name }} {{ $user->middle_name }} {{ $user->last_name }}</option>
                                        @endforeach
                                    </select>
                                </div>  
                                <div class="form-group col-lg-6">
                                    <label for="">Canvasser</label>
                                    <select class="form-control" name="add-canvasser" id="add-canvasser">
                                        @foreach($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->first_name }} {{ $user->middle_name }} {{ $user->last_name }}</option>
                                        @endforeach                                                
                                    </select>   
                                </div>                              
                            </div>

                            <button class="btn btn-success" style="float: right; width: 20%;">Convert to AQ</button> 
                        {!! Form::close() !!} 
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

        var monthNames = [ "January", "February", "March", "April", "May", "June",
        "July", "August", "September", "October", "November", "December" ];
        
        var dayNames= ["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"]

        var newDate = new Date();
        newDate.setDate(newDate.getDate());    
        $('#Date').html(dayNames[newDate.getDay()] +" | " +" " + " " + newDate.getDate() + ' ' + monthNames[newDate.getMonth()] + "," + ' ' + newDate.getFullYear());
        $('#transaction_date').val(newDate.getFullYear() + "-" +  (newDate.getMonth()+1) + "-" + newDate.getDate());


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