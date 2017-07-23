@extends('layouts.master')

@section('title', 'SLSU - Request For Quotation')

@section('content')
        <head>
            @if(Session::has('rfq_new_check'))
                <meta http-equiv="refresh" content="0; url=/purchasing/public/transaction/request-for-quotation-pdf">
            @endif
        </head>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Transaction</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            @if(Session::has('rfq_add_success'))
            <div class="row">
                <div class="col-lg-12">
                    <div class="alert alert-success alert-dismissable">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>{!! session('rfq_add_success') !!}</strong>
                        <a href="{{ URL::to('transaction/request-for-quotation-pdf') }}" class="btn-sm btn-info">Save PDF</a>
                    </div>
                </div>
            </div>
            @endif

            @if(Session::has('rfq_add_fail'))
            <div class="row">
                <div class="col-lg-12">
                    <div class="alert alert-danger alert-dismissable">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>{!! session('rfq_add_fail') !!}</strong>
                    </div>
                </div>
            </div>
            @endif

            @if(Session::has('rfq_search_error'))
            <div class="row">
                <div class="col-lg-12">
                    <div class="alert alert-warning alert-dismissable">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>{!! session('rfq_search_error') !!}</strong>
                    </div>
                </div>
            </div>
            @endif
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
                                            <option value="" selected disabled>Select a PR No.</option>
                                        @foreach($pr_headers as $pr_header)
                                            <option value="{{ $pr_header->id }}" @if($pr_id == $pr_header->id) selected @endif>{{ $pr_header->pr_number }}</option>
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
                    
                        {!! Form::open(['method' => 'post', 'url' => 'transaction/request-for-quotation']) !!}
                            <div class="panel-body">
                                <div class="panel panel-default">
                                    <div class="panel-heading"></div>
                                    <div class="panel-body">

                                        <input type="hidden" id="Date" name="Date">
                                        <input type="hidden" id="transaction_date" name="transaction_date" />

                                        <div class="form-inline col-lg-6" style="margin-bottom: 20px;">
                                            <label for="">Supplier(s): </label>
                                            <select class="selectpicker" multiple data-max-options="5" data-size="10" data-live-search="true" name="add-supplier[]" id="add-supplier" required>
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
                                                @foreach($purchase_requests as $i => $purchase_request)                          
                                                    <tr>
                                                        <td>{{ $purchase_request->stock_no }}</td>
                                                        <td>{{ $purchase_request->item_name }}</td>
                                                        <input type="hidden" name="item_id{{ $i }}" value="{{ $purchase_request->item_id }}">
                                                        <td>{{ $purchase_request->quantity }}</td>
                                                        <input type="hidden" name="quantity{{ $i }}" value="{{ $purchase_request->quantity }}">
                                                        <td>{{ $purchase_request->unit_name }}</td>        
                                                        <input type="hidden" name="unit_id{{ $i }}" value="{{ $purchase_request->unit_id }}">                                    
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
                                        <option value="">None</option>
                                        @foreach($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->first_name }} {{ $user->middle_name }} {{ $user->last_name }}</option>
                                        @endforeach
                                    </select>
                                </div>  
                                <div class="form-group col-lg-6">
                                    <label for="">Requestor Designation</label>
                                    <select class="form-control" name="add-requestor-designation" id="add-requestor-designation">                                        
                                        @foreach($designations as $designation)
                                            <option value="{{ $designation->id }}">{{ $designation->designation_name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="form-group col-lg-6">
                                    <label for="">Canvasser</label>
                                    <select class="form-control" name="add-canvasser" id="add-canvasser" required>
                                        @foreach($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->first_name }} {{ $user->middle_name }} {{ $user->last_name }}</option>
                                        @endforeach                                                
                                    </select>   
                                </div>   
                                <div class="form-group col-lg-6">
                                    <label for="">Canvasser Designation</label>
                                    <select class="form-control" name="add-canvasser-designation" id="add-canvasser-designation" required>
                                        @foreach($designations as $designation)
                                            <option value="{{ $designation->id }}">{{ $designation->designation_name }}</option>
                                        @endforeach
                                    </select>
                                </div>                           
                            </div>
                                <div id="submit-rfq" class="modal fade" role="dialog">
     
                                    <div class="modal-dialog">
                                
                                        <!-- Modal content-->
                                        <div class="modal-content ">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Save Request for Quotation?</h4>
                                            </div>
                                            <div class="modal-body container-fluid">
                                                <div class="form-group col-lg-12">   
                                                    <label for="add-department">Select Supplier to be printed an RFQ Form</label>         
                                                </div>
                                                <div class="form-group col-lg-12">
                                                    <select style="width: 100% !important" class="selectpicker" multiple name="add-print-supplier[]" id="add-print-supplier">
                                                    </select>   
                                                </div>      
                                            </div>
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-success">Save</button>
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>

                                    </div>
                                
                                </div>
                        {!! Form::close() !!} 
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#submit-rfq" style="float: right; width: 20%;">Convert to AQ</button> 
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


        $('select#add-requestor option:eq(1)').prop('selected', 1);

    });


    $(document).ready(function(){
          
        var $options = $("#add-supplier > option:selected").clone();

        $('#add-print-supplier').append($options); 
        $('#add-print-supplier').selectpicker('refresh');
          

        $("#add-supplier").on("change", function(){
  
            $("#add-print-supplier").find('option').remove();
          
            var $options = $("#add-supplier > option:selected").clone();

            $('#add-print-supplier').append($options); 
            $('#add-print-supplier').selectpicker('refresh');
          
        });


        $('#modal-close').click(function(){
            location.reload(true);
        });
    });


    $('#add-requestor').change(function(){

        var id = "#" + $(this).attr('id');
        var id_designation = id + "-designation";

        var designations = {!! json_encode($designations) !!}

        if($(id).val() == "") 
        {
            $(id_designation).val($(id_designation + " option:first").val());
            $(id_designation).find('option').remove();
            $(id_designation).prepend("<option value='' selected disabled>None</option>");
        }
        else
        {
            $(id_designation).find('option').remove();

            $.each(designations, function (i, designation) {
                $(id_designation).append($('<option>', { 
                    value: designation.id,
                    text : designation.designation_name 
                }));
            });
        }

    });
    </script>

@stop