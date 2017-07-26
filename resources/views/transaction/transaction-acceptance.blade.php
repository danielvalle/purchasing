@extends('layouts.master')

@section('title', 'SLSU - Acceptance')

@section('content')
        <head>
            @if(Session::has('accept_new_check'))
                <meta http-equiv="refresh" content="0; url=/purchasing/public/transaction/acceptance-pdf">
            @endif
        </head>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Transaction</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            @if(Session::has('accept_add_success'))
            <div class="row">
                <div class="col-lg-12">
                    <div class="alert alert-success alert-dismissable">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>{!! session('accept_add_success') !!}</strong>
                        <a href="{{ URL::to('transaction/acceptance-pdf') }}" class="btn-sm btn-info">Save PDF</a>
                    </div>
                </div>
            </div>
            @endif

            @if(Session::has('accept_add_fail'))
            <div class="row">
                <div class="col-lg-12">
                    <div class="alert alert-danger alert-dismissable">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>{!! session('accept_add_fail') !!}</strong>
                    </div>
                </div>
            </div>
            @endif
            <div class="row">   
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <span style="font-size: 20px;">Acceptance</span> 
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">

                        <div class="panel-body">
                        {!! Form::open(['class' => 'form-inline', 'method' => 'post', 'url' => 'transaction/acceptance-search']) !!}
                            <div class="panel-body">   
                                <div class="form-group">
                                    <label for="">Purchase Order Number</label>
                                    <select class="selectpicker" name="select-po-no" id="select-po-no">
                                        <option selected disabled>Select a PO No.</option>
                                        @foreach($po_nos as $po_no)
                                            <option value="{{ $po_no->id }}">{{ $po_no->po_number }}</option>
                                        @endforeach
                                    </select>     
                                </div>
                                <div class="form-group" style="margin-right: 40px;">
                                    <button class="form-control btn btn-success">Select</button>        
                                </div>    

                                <div class="form-group" style="margin-right: 40px;">
                                    <label for="">Purchase Order Date</label>
                                    <input class="form-control" value="{{ $po_date }}" readonly>     
                                </div>
                            </div>
                        {!! Form::close() !!}

                        {!! Form::open(['method' => 'post', 'url' => 'transaction/acceptance']) !!}                    
                            <input type="hidden" name="add-po-date" id="add-po-date" value="{{ $po_date }}">     
                            <input type="hidden" name="add-po-no" id="add-po-no" value="{{ $po_number }}">     
                            <div class="panel-body"> 

                                <div class="form-group col-lg-4">
                                    <label for="">IAR</label>
                                    <input class="form-control" name="add-iar" id="add-iar">                                
                                </div>
     
                                {{-- <div class="form-group col-lg-4">
                                    <label for="">Entity</label>
                                    <input type="hidden" name="add-entity" id="add-entity" value="{{ $po_entity_fk }}" >
                                    <input class="form-control" value="{{ $po_entity_name }}" readonly>                            
                                </div> --}}

                                <div class="form-group col-lg-4">
                                    <label for="">Supplier</label>
                                    <input type="hidden" name="add-supplier" id="add-supplier" value="{{ $po_supplier_fk }}" >
                                    <input class="form-control" value="{{ $po_supplier_name }}" readonly>                             
                                </div>

                            </div>

                            <div class="panel-body"> 
                                <div class="form-group col-lg-4">
                                    <label for="">Invoice No.</label>
                                    <input class="form-control" name="add-invoice-no" id="add-invoice-no">                                
                                </div>

                                <div class="form-group col-lg-4" >
                                    <label for="">Invoice Date</label>
                                    <input type="date" class="form-control" id="add-invoice-date" name="add-invoice-date" value="{{ date("Y-m-d") }}" required>                           
                                </div>

                                <div class="form-group col-lg-4">
                                    <label for="">Requisitioning Office/Dept.</label>
                                    <select class="form-control" name="select-dept" id="select-dept" required>   
                                        @foreach($departments as $department)
                                            <option value="{{ $department->id}}">{{ $department->department_name }}</option>
                                        @endforeach  
                                    </select>                       
                                </div>
                            </div>
                              

                         <div class="panel-body">
                            <div class="panel panel-default">
                                <div class="panel-heading"></div>
                                <div class="panel-body">
                                    <div class="form-group col-lg-12">
                                        <table class="table table-bordered" id="dt-acceptance-det">
                                            <thead>
                                                <tr>
                                                    <th>Stock No.</th>
                                                    <th style="width: 20%;">Item</th>
                                                    <th>Quantity</th>
                                                    <th>Unit</th>
                                                    <th>Item Description</th>
                                                    <th style="width: 15%">Received Qty</th>
                                                    <th style="width: 15%">Outright Expense</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($po_items as $i => $po_item)
                                                <tr>
                                                    <td>{!! $po_item->stock_no !!}</td>
                                                    <td>{!! $po_item->item_name !!}</td>
                                                    <td>{!! $po_item->quantity !!}</td>
                                                    <td>{!! $po_item->unit_name !!}</td>
                                                    <td>{!! $po_item->item_description !!}</td>
                                                    <td><input type="number" class="form-control add-received-qty" id="{!! $i !!}" name="add-received-qty[]" /></td>
                                                    <td><input type="number" class="form-control add-outright-expense" id="{!! $i !!}" name="add-outright-expense[]" /></td>
                                                    <input type="hidden" name="add-item[]" value="{!! $po_item->item_fk !!}"> 
                                                    <input type="hidden" name="add-unit[]" value="{!! $po_item->unit_fk !!}"> 
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                        
                                    </div>  
                                </div>             
                            </div>
                        </div>

                            <div class="panel-body" style="width:50%; float: left">   
                                <div class="panel panel-default">
                                    <div class="panel-heading">Inspection</div>
                                    <div class="panel-body"> 
                                        <div class="form-group col-lg-6">
                                            <label for="">Date Inspected</label>
                                            <input type="date" class="form-control" id="add-date-inspected" name="add-date-inspected" value="{{ date("Y-m-d") }}" required>                               
                                        </div>

                                        <div class="form-group col-lg-6">
                                            <label for="">Inspector</label>
                                            <select class="selectpicker" name="add-inspector" id="add-inspector" required>  
                                                @foreach($users as $user)
                                                    <option value="{{ $user->id }}">{{ $user->first_name }} {{ $user->last_name }}</option>
                                                @endforeach
                                            </select>                              
                                        </div>

                                    </div>
                                    <div class="panel-body">
                                        <div class="form-group col-lg-12">
                                            <label class=""><input type="checkbox" name="cbx-inspected" value="1">Inspected, verified and found OK at to quantity and specification</label>  
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="panel-body" style="width:50%; float: left">   
                                <div class="panel panel-default">
                                    <div class="panel-heading">Acceptance</div>
                                    <div class="panel-body"> 
                                        <div class="form-group col-lg-6">
                                            <label for="">Date Inspected</label>
                                            <input type="date" class="form-control" id="add-date-accepted" name="add-date-accepted" value="{{ date("Y-m-d") }}" required>                               
                                        </div>

                                        <div class="form-group col-lg-6">
                                            <label for="">Property Officer</label>
                                            <select class="selectpicker" name="add-officer" id="add-officer" required>  
                                                @foreach($users as $user)
                                                    <option value="{{ $user->id }}">{{ $user->first_name }} {{ $user->last_name }}</option>
                                                @endforeach
                                            </select>                                   
                                        </div>
                                    </div>
                                    <div class="panel-body">
                                        <div class="form-group col-lg-3">
                                            <label class=""><input type="radio" name="rdb-completeness" value="1">Complete</label>  
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <label class=""><input type="radio" name="rdb-completeness" value="0">Partial (Pls. Specify Quantity)</label>  
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                                <div id="submit-acc" class="modal fade" role="dialog">
     
                                    <div class="modal-dialog">
                                
                                        <!-- Modal content-->
                                        <div class="modal-content ">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Save Acceptance?</h4>
                                            </div>
                                            <div class="modal-body container-fluid">
                                                <div class="form-group col-lg-12">   
                                                    <label for="add-department">
                                                        Are you sure you want to save your Acceptance? Changes cannot be made after it is sent.
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
                        <button button type="button" class="btn btn-success" data-toggle="modal" data-target="#submit-acc" style="float: right; width: 20%;">Submit Acceptance Form</button>  
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
        $('#dt-acceptance-det').DataTable({
            responsive: true,
            searching: false,
            paging: false
        });

        var monthNames = [ "January", "February", "March", "April", "May", "June",
        "July", "August", "September", "October", "November", "December" ];
        
        var dayNames= ["Sunday","Monday","Tuesday","Wednesday","Thursday","Friday","Saturday"]

        var newDate = new Date();
        newDate.setDate(newDate.getDate());    
        $('#Date').html(dayNames[newDate.getDay()] +" | " +" " + " " + newDate.getDate() + ' ' + monthNames[newDate.getMonth()] + "," + ' ' + newDate.getFullYear());
        $('#transaction_date').val(newDate.getFullYear() + "-" +  (newDate.getMonth()+1) + "-" + newDate.getDate());

        $('#modal-close').click(function(){
            location.reload(true);
        });

    });

    $(".add-received-qty, .add-outright-expense").keyup(function(){

            var id = $(this).attr('id');

            var received = parseInt($("#" + id + ".add-received-qty").val(), 10);
            var outright = parseInt($("#" + id + ".add-outright-expense").val(), 10);

            if(isNaN(received)) received = 0;
            if(isNaN(outright)) outright = 0;

            var qty = received + outright;
            var input = parseInt($(this).val(), 10);

            var item_qty = {!! json_encode($po_items) !!};

            if(qty > item_qty[id].quantity) 
            {
                var excess = qty - item_qty[id].quantity;
                var new_qty = input - excess;
                $(this).val(new_qty);
            }

    });

    </script>

@stop