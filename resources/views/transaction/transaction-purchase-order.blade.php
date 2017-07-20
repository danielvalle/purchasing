@extends('layouts.master')

@section('title', 'SLSU - Purchase Order')

@section('content')
        <head>
            @if(Session::has('po_new_check'))
                <meta http-equiv="refresh" content="0; url=/purchasing/public/transaction/purchase-order-pdf">
            @endif
        </head>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Transaction</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            @if(Session::has('po_add_success'))
            <div class="row">
                <div class="col-lg-12">
                    <div class="alert alert-success alert-dismissable">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>{!! session('po_add_success') !!}</strong>
                    </div>
                </div>
            </div>
            @endif

            @if(Session::has('po_add_fail'))
            <div class="row">
                <div class="col-lg-12">
                    <div class="alert alert-danger alert-dismissable">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>{!! session('po_add_fail') !!}</strong>
                    </div>
                </div>
            </div>
            @endif

            @if(Session::has('pr_select_fail'))
            <div class="row">
                <div class="col-lg-12">
                    <div class="alert alert-warning alert-dismissable">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>{!! session('pr_select_fail') !!}</strong>
                    </div>
                </div>
            </div>
            @endif

            @if(Session::has('aq_supplier_fail'))
            <div class="row">
                <div class="col-lg-12">
                    <div class="alert alert-warning alert-dismissable">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>{!! session('aq_supplier_fail') !!}</strong>
                    </div>
                </div>
            </div>
            @endif
            <div class="row">   
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <span style="font-size: 20px;">Purchase Order</span> 
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">

                        <div class="panel-body">
                            <div class="form-group" style="width: 100%">   
                                {!! Form::open(['class' => 'form-inline', 'method' => 'post', 'url' => 'transaction/purchase-order-search']) !!}

                                <div class="form-group" style="width: 100%">

                                    <div class="form-group" style="width: 100%">
                                        <label for="">Purchase Request Number:</label>
                                        <select style="margin-right: 20px;" class="selectpicker" name="select-pr-no" id="select-pr-no">
                                            <option value="" selected disabled>Select a PR No.</option>
                                            @foreach($pr_nos as $pr_no)
                                                <option value="{{ $pr_no->id }}" @if($selected_pr_no == $pr_no->id) selected @endif>{{ $pr_no->pr_number }}</option>
                                            @endforeach
                                        </select>     

                                        <label for="">Supplier:</label>
                                        <select class="selectpicker" name="add-supplier" id="add-supplier">
                                                <option disabled selected>Select a supplier</option>       
                                        </select> 

                                        <button class="form-control btn btn-success">Select</button> 
                                    </div>


                                {!! Form::close() !!}
                                </div>

                            {!! Form::open(['class' => 'form-inline', 'method' => 'post', 'url' => 'transaction/purchase-order']) !!}
                                <input type="hidden" name="hdn-pr-no" id="hdn-pr-no" value="{{ $selected_pr_no }}">
                                <input type="hidden" name="hdn-aq-no" id="hdn-aq-no" value="{{ $selected_aq_no }}">

                            </div>
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
                                                    <th>Stock No.</th>
                                                    <th style="width: 20%;">Item</th>
                                                    <th>Quantity</th>
                                                    <th>Unit</th>
                                                    <th>Unit Cost Amount</th>
                                                    <th>Amount</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($items as $i => $item)
                                                <input type="hidden" name="supplier-amount[]" id="supplier-amount{!! $i !!}">
                                                <tr>
                                                    <td>{{ $item->stock_no}}</td>
                                                    <td>{{ $item->item_name }}</td>
                                                    <td>{{ $item->quantity }}</td>
                                                    <td>{{ $item->unit_name }}</td>
                                                    <td id="amount{!! $i !!}">{{ $item->winning_supplier_amount }}</td>
                                                    <td id="total-amount{!! $i !!}">{{ $item->total }}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                        
                                    </div>  
                                </div>             
                            </div>

                            <div style="margin: 50px 0"></div>
                            <div style="float: left; width: 100%;">
                                <div class="form-group col-lg-4">                                 
                                    <label for="" >Entity</label>
                                    <select class="form-control" name="add-entity" id="add-entity" required>
                                        @foreach($entities as $entity)
                                            <option value="{{ $entity->id }}">{{ $entity->entity_name }}</option>
                                        @endforeach
                                    </select>                                      
                                </div>                                
                            </div>
                            <div style="float: left; width: 100%; margin-bottom: 30px">
                                <div class="form-group col-lg-5">
                                    <label for="">Address</label>
                                    <input type="text" class="form-control" name="add-address" id="add-address">
                                </div>
                                <div class="form-group col-lg-3">
                                    <label for="">TIN</label>
                                    <input type="text" class="form-control" name="add-tin" id="add-tin">
                                </div>  
                                <div class="form-group col-lg-2">
                                    <label for="add-birthday" >Date</label>         
                                    <input type="date" class="form-control" id="add-date" name="add-date" value="{{ date("Y-m-d") }}" required>
                                </div>
                                <div class="form-group col-lg-2">
                                    <label for="">Mode Of Procurement</label>
                                    <input type="text" class="form-control" name="add-mode-of-procurement" id="add-mode-of-procurement">
                                </div>

                                <div class="form-group col-lg-5">
                                    <label for="">Place Of Delivery</label>
                                    <input type="text" class="form-control" name="add-place-delivery" id="add-place-delivery">
                                </div>  
                                <div class="form-group col-lg-3">
                                    <label for="">Date Of Delivery</label>
                                    <input type="text" class="form-control" name="add-date-delivery" id="add-date-delivery">
                                </div>   
                                <div class="form-group col-lg-2">
                                    <label for="">Delivery Term</label>
                                    <input type="text" class="form-control" name="add-delivery-term" id="add-delivery-term">
                                </div>
                                <div class="form-group col-lg-2">
                                    <label for="">Payment Term</label>
                                    <input type="text" class="form-control" name="add-payment-term" id="add-payment-term">
                                </div>

                                <div class="form-group col-lg-6">
                                    <label for="">Authorized Official</label>
                                    <select class="form-control" name="add-authorized-official" id="add-authorized-official" required> 
                                        @foreach($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->first_name }} {{ $user->middle_name }} {{ $user->last_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-lg-6">
                                    <label for="">Authorized Official Designation</label>
                                    <select class="form-control" name="add-authorized-official-designation" id="add-authorized-official-designation" required> 
                                        @foreach($users as $user)
                                            <option value="{{ $user->id }}">{{ $user->first_name }} {{ $user->middle_name }} {{ $user->last_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-lg-3">
                                    <label for="">Total Amount</label>
                                    <input type="text" value="{{ $total }}" class="form-control" name="add-total-amount" id="add-total-amount" readonly>
                                </div>
                                <div class="form-group col-lg-9">
                                    <label for="">Total Amount in Words</label>
                                    <input type="text" class="form-control" name="add-total-words" id="add-total-words">
                                </div>                   
                            </div>
                                <div id="submit-po" class="modal fade" role="dialog">
     
                                    <div class="modal-dialog">
                                
                                        <!-- Modal content-->
                                        <div class="modal-content ">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Save Purchase Order?</h4>
                                            </div>
                                            <div class="modal-body container-fluid">
                                                <div class="form-group col-lg-12">   
                                                    <label for="add-department">
                                                        Are you sure you want to save your Purchase Order? Changes cannot be made after it is sent.
                                                    </label>         
                                                </div>  
                                                <div class="form-group col-lg-12">
                                                    <span><i>A PDF will automatically be downloaded after saving.</i></span>
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
                            <button button type="button" class="btn btn-success" data-toggle="modal" data-target="#submit-po" style="float: right; width: 20%;">Submit PO</button> 
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

                $.ajaxSetup({
                        headers:
                        { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') }
                    });

                    $.ajax({
                        url: 'purchase-order/get-supplier',
                        type: "post",
                        data: {
                            'id': $('#select-pr-no').find('option:selected').val()
                        },
                        dataType: 'json',
                        success: function(data){

                            $("#add-supplier").find('option').remove();

                            var len = data.suppliers.length;

                            $('select#add-supplier').append('<option value="">Select a supplier</option>');

                            for(var i = 0; i < len; i++)
                            {
                                $('select#add-supplier').append('<option value="' + data.suppliers[i].id + '">' + data.suppliers[i].supplier_name + '</option>');
                            }

                            $('#add-supplier').selectpicker('refresh');
                        }

                    });         
    
    });

    $('#select-pr-no').change(function(){
                    
                    $.ajaxSetup({
                        headers:
                        { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') }
                    });

                    $.ajax({
                        url: 'purchase-order/get-supplier',
                        type: "post",
                        data: {
                            'id': $('#select-pr-no').find('option:selected').val()
                        },
                        dataType: 'json',
                        success: function(data){

                            $("#add-supplier").find('option').remove();

                            var len = data.suppliers.length;

                            $('select#add-supplier').append('<option value="">Select a supplier</option>');

                            for(var i = 0; i < len; i++)
                            {
                                $('select#add-supplier').append('<option value="' + data.suppliers[i].id + '">' + data.suppliers[i].supplier_name + '</option>');
                            }

                            $('#add-supplier').selectpicker('refresh');
                        }

                    });      
        }); 

    </script>

@stop