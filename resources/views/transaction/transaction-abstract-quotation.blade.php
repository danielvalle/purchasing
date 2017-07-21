@extends('layouts.master')

@section('title', 'SLSU - Abstract Quotation')

@section('content')
        <head>
            @if(Session::has('aq_new_check'))
                <meta http-equiv="refresh" content="0; url=/purchasing/public/transaction/abstract-quotation-pdf">
            @endif
        </head>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Transaction</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            @if(Session::has('aq_add_success'))
            <div class="row">
                <div class="col-lg-12">
                    <div class="alert alert-success alert-dismissable">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>{!! session('aq_add_success') !!}</strong>
                    </div>
                </div>
            </div>
            @endif

            @if(Session::has('aq_add_fail'))
            <div class="row">
                <div class="col-lg-12">
                    <div class="alert alert-danger alert-dismissable">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>{!! session('aq_add_fail') !!}</strong>
                    </div>
                </div>
            </div>
            @endif
            <div class="row">   
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <span style="font-size: 20px;">Abstract Quotation</span> 
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">

                        <div class="panel-body">
                            {!! Form::open(['class' => 'form-inline', 'method' => 'post', 'url' => 'transaction/abstract-quotation-search']) !!}
                            <div class="form-group">
                                <div class="form-group" style="margin-right: 50px;">
                                    <label for="">Select Request for Quotation Number: </label>
                                    <select class="selectpicker" name="select-rfq-no" id="select-rfq-no">
                                        <option value="" selected disabled>Select an RFQ No.</option>
                                        @foreach($rfqs as $rfq)
                                            <option value="{{ $rfq->id }}">{{ $rfq->rfq_number }}</option>
                                        @endforeach
                                    </select>        
                                    <button class="form-control btn btn-success">Select</button>                          
                                </div>

                            </div>
                            {!! Form::close() !!}
                        </div>          
                    {!! Form::open(['method' => 'post', 'url' => 'transaction/abstract-quotation']) !!}       
                        <input type="hidden" id="Date" name="Date">
                        <input type="hidden" id="transaction_date" name="transaction_date" />

                        <div class="panel-body">
                            <div class="form-inline col-lg-4">
                                <label for="">Supplier 1: </label>   
                                <input class="form-control" type="text" @if(array_key_exists(0, $rfq_suppliers)) value="{{ $rfq_suppliers[0]->supplier_name }}" @endif readonly>     
                            </div>
                            <div class="form-inline col-lg-4">
                                <label for="">Supplier 2: </label>   
                                <input class="form-control" type="text" @if(array_key_exists(1, $rfq_suppliers)) value="{{ $rfq_suppliers[1]->supplier_name }}" @endif readonly>    
                            </div>
                            <div class="form-inline col-lg-4">  
                                <label for="">Supplier 3: </label>   
                                <input class="form-control" type="text" @if(array_key_exists(2, $rfq_suppliers)) value="{{ $rfq_suppliers[2]->supplier_name }}" @endif readonly> 
                            </div>                                
                        </div>  
                        <div class="panel-body">   
                            <div class="form-inline col-lg-4">
                                <label for="">Supplier 4: </label>   
                                <input class="form-control" type="text" @if(array_key_exists(3, $rfq_suppliers)) value="{{ $rfq_suppliers[3]->supplier_name }}" @endif readonly>  
                            </div>
                            <div class="form-inline col-lg-4">     
                                <label for="">Supplier 5: </label>   
                                <input class="form-control" type="text" @if(array_key_exists(4, $rfq_suppliers)) value="{{ $rfq_suppliers[4]->supplier_name }}" @endif readonly>   
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
                                                    <th style="width: 20%;">Item</th>
                                                    <th>Unit</th>
                                                    <th>Supplier 1 Amount</th>
                                                    <th>Supplier 2 Amount</th>
                                                    <th>Supplier 3 Amount</th>
                                                    <th>Supplier 4 Amount</th>
                                                    <th>Supplier 5 Amount</th>
                                                    <th style="width: 20%;">Winning Supplier</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                
                                                @foreach($rfq_items as $i => $rfq_item)
                                            
                                                <tr>
                                                    <td>{{ $rfq_item->item_name }}</td>
                                                    <td>{{ $rfq_item->unit_name }}</td>
                                                    <td><input name="supplier1_amount{{ $i }}" class="form-control" type="number" min="1" @if(!array_key_exists(0, $rfq_suppliers)) readonly @endif></td>
                                                    <td><input name="supplier2_amount{{ $i }}" class="form-control" type="number" min="1" @if(!array_key_exists(1, $rfq_suppliers)) readonly @endif></td>
                                                    <td><input name="supplier3_amount{{ $i }}" class="form-control" type="number" min="1" @if(!array_key_exists(2, $rfq_suppliers)) readonly @endif></td>
                                                    <td><input name="supplier4_amount{{ $i }}" class="form-control" type="number" min="1" @if(!array_key_exists(3, $rfq_suppliers)) readonly @endif></td>
                                                    <td><input name="supplier5_amount{{ $i }}" class="form-control" type="number" min="1" @if(!array_key_exists(4, $rfq_suppliers)) readonly @endif></td>
                                                    <td>
                                                        <select class="form-control" name="add-winner-supplier{{ $i }}" id="add-winner-supplier" required>
                                                            @foreach($rfq_suppliers as $j => $rfq_supplier)
                                                                <option value="{{ $rfq_supplier->id }},{{ $j }}">{{ $rfq_supplier->supplier_name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                </tr>
                                                <input type="hidden" name="add-pr-fk" value="{{ $rfq_item->pr_fk }}">
                                                @endforeach
                                            </tbody>
                                        </table>
                                        
                                    </div>  
                                </div>             
                            </div>
                        </div>
                        <div class="panel-body">
                            
                            <div class="form-group col-lg-6">
                                <label for="">Supervising Admin</label>
                                <select class="form-control" name="add-supervising-admin" id="add-supervising-admin">
                                    <option value="">None</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->first_name }} {{ $user->middle_name }} {{ $user->last_name }}</option>
                                    @endforeach
                                </select>
                            </div> 
                            <div class="form-group col-lg-6">
                                <label for="">Supervising Admin Designation</label>
                                <select class="form-control" name="add-supervising-admin-designation" id="add-supervising-admin-designation">
                                    <option value="" disabled>None</option>
                                    @foreach($designations as $designation)
                                        <option value="{{ $designation->id }}">{{ $designation->designation_name }}</option>
                                    @endforeach
                                </select>
                            </div> 

                            <div class="form-group col-lg-6">
                                <label for="">Admin Officer</label>
                                <select class="form-control" name="add-admin-officer" id="add-admin-officer">
                                    <option value="">None</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->first_name }} {{ $user->middle_name }} {{ $user->last_name }}</option>
                                    @endforeach
                                </select>
                            </div> 
                            <div class="form-group col-lg-6">
                                <label for="">Admin Officer Designation</label>
                                <select class="form-control" name="add-admin-officer-designation" id="add-admin-officer-designation">
                                    <option value="" disabled>None</option>
                                    @foreach($designations as $designation)
                                        <option value="{{ $designation->id }}">{{ $designation->designation_name }}</option>
                                    @endforeach
                                </select>
                            </div> 

                            <div class="form-group col-lg-6">
                                <label for="">Admin Officer</label>
                                <select class="form-control" name="add-admin-officer-2" id="add-admin-officer-2">
                                    <option value="">None</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->first_name }} {{ $user->middle_name }} {{ $user->last_name }}</option>
                                    @endforeach
                                </select>
                            </div> 
                            <div class="form-group col-lg-6">
                                <label for="">Admin Officer Designation</label>
                                <select class="form-control" name="add-admin-officer-2-designation" id="add-admin-officer-2-designation">
                                    <option value="" disabled>None</option>
                                    @foreach($designations as $designation)
                                        <option value="{{ $designation->id }}">{{ $designation->designation_name }}</option>
                                    @endforeach
                                </select>
                            </div> 

                            <div class="form-group col-lg-6">
                                <label for="">Head of Requesting Officer/Authorized Representative</label>
                                <select class="form-control" name="add-requesting-officer" id="add-requesting-officer">
                                    <option value="">None</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->first_name }} {{ $user->middle_name }} {{ $user->last_name }}</option>
                                    @endforeach
                                </select>
                            </div> 
                            <div class="form-group col-lg-6">
                                <label for="">Head of Requesting Officer/Authorized Representative Designation</label>
                                <select class="form-control" name="add-requesting-officer-designation" id="add-requesting-officer-designation">
                                    <option value="" disabled>None</option>
                                    @foreach($designations as $designation)
                                        <option value="{{ $designation->id }}">{{ $designation->designation_name }}</option>
                                    @endforeach
                                </select>
                            </div> 

                            <div class="form-group col-lg-6">
                                <label for="">Board Secretary</label>
                                <select class="form-control" name="add-board-secretary" id="add-board-secretary">
                                    <option value="">None</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->first_name }} {{ $user->middle_name }} {{ $user->last_name }}</option>
                                    @endforeach
                                </select>
                            </div> 
                            <div class="form-group col-lg-6">
                                <label for="">Board Secretary Designation</label>
                                <select class="form-control" name="add-board-secretary-designation" id="add-board-secretary-designation">
                                    <option value="" disabled>None</option>
                                    @foreach($designations as $designation)
                                        <option value="{{ $designation->id }}">{{ $designation->designation_name }}</option>
                                    @endforeach
                                </select>
                            </div> 

                            <div class="form-group col-lg-6">
                                <label for="">VPAF</label>
                                <select class="form-control" name="add-vpaf" id="add-vpaf">
                                    <option value="">None</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->first_name }} {{ $user->middle_name }} {{ $user->last_name }}</option>
                                    @endforeach
                                </select>
                            </div>  
                            <div class="form-group col-lg-6">
                                <label for="">VPAF Designation</label>
                                <select class="form-control" name="add-vpaf-designation" id="add-vpaf-designation">
                                    <option value="" disabled>None</option>
                                    @foreach($designations as $designation)
                                        <option value="{{ $designation->id }}">{{ $designation->designation_name }}</option>
                                    @endforeach
                                </select>
                            </div> 

                            <div class="form-group col-lg-6">
                                <label for="">Approved by</label>
                                <select class="form-control" name="add-approved-by" id="add-approved-by">
                                    <option value="">None</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->first_name }} {{ $user->middle_name }} {{ $user->last_name }}</option>
                                    @endforeach
                                </select>   
                            </div>  
                            <div class="form-group col-lg-6">
                                <label for="">Approver Designation</label>
                                <select class="form-control" name="add-approved-by-designation" id="add-approved-by-designation">
                                    <option value="" disabled>None</option>
                                    @foreach($designations as $designation)
                                        <option value="{{ $designation->id }}">{{ $designation->designation_name }}</option>
                                    @endforeach
                                </select>
                            </div>                             
                        </div>

                                <div id="submit-aq" class="modal fade" role="dialog">
     
                                    <div class="modal-dialog">
                                
                                        <!-- Modal content-->
                                        <div class="modal-content ">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Save Abstract Quotation?</h4>
                                            </div>
                                            <div class="modal-body container-fluid">
                                                <div class="form-group col-lg-12">   
                                                    <label for="add-department">
                                                        Are you sure you want to save your Abstract Quotation? Changes cannot be made after it is sent.
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
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#submit-aq" style="float: right; width: 20%;">Convert to PO</button> 
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

        $('#modal-close').click(function(){
            location.reload(true);
        });

        $('select#add-supervising-admin option:eq(1)').prop('selected', 1);
        $('select#add-admin-officer option:eq(1)').prop('selected', 1);
        $('select#add-admin-officer-2 option:eq(1)').prop('selected', 1);
        $('select#add-requesting-officer option:eq(1)').prop('selected', 1);
        $('select#add-board-secretary option:eq(1)').prop('selected', 1);
        $('select#add-vpaf option:eq(1)').prop('selected', 1);
        $('select#add-approved-by option:eq(1)').prop('selected', 1);

    });


    $('#add-supervising-admin, #add-admin-officer, #add-admin-officer-2, #add-requesting-officer, #add-board-secretary, #add-vpaf, #add-approved-by').change(function(){

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