@extends('layouts.master')

@section('title', 'SLSU - Disbursement Voucher')

@if(Auth::check())
    @if(Auth::user()->user_type == 1)
        @section('content')
                <head>
                    @if(Session::has('dv_new_check'))
                        <meta http-equiv="refresh" content="0; url=/purchasing/public/transaction/disbursement-voucher-pdf">
                    @endif
                </head>

                <div id="page-wrapper">
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header">Transaction</h1>
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    @if(Session::has('dv_add_success'))
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="alert alert-success alert-dismissable">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <strong>{!! session('dv_add_success') !!}</strong>
                                <a href="{{ URL::to('transaction/disbursement-voucher-pdf') }}" class="btn-sm btn-info">Save PDF</a>
                            </div>
                        </div>
                    </div>
                    @endif
                    <div class="row">   
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <span style="font-size: 20px;">Disbursement Voucher</span> 
                                </div>
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                {!! Form::open(['method' => 'post', 'url' => 'transaction/disbursement-voucher']) !!}
                                <div class="panel-body">
                                        <div class="form-group col-lg-6">
                                            <label for="">Entity</label>
                                            <select class="form-control" name="add-entity" required>
                                                @foreach($entities as $entity)
                                                    <option value="{{ $entity->id }}">{{ $entity->entity_name }}</option>
                                                @endforeach
                                            </select>    
                                        </div>
                                        <div class="form-group col-lg-6">
                                            <label for="">Fund Cluster</label>
                                            <input type="text" class="form-control" name="add-fund-cluster">
                                        </div>
                                </div>
                                <div class="panel-body">
                                        <div class="form-group col-lg-8" style="width: auto">
                                            <label for="">Mode Of Payment:&nbsp&nbsp&nbsp&nbsp</label>
                                            <label class="radio-inline"><input type="radio" class="mode-of-payment" name="add-mode-of-payment" value="1">MDS Check</label>
                                            <label class="radio-inline"><input type="radio" class="mode-of-payment" name="add-mode-of-payment" value="2">Commercial Check</label>
                                            <label class="radio-inline"><input type="radio" class="mode-of-payment" name="add-mode-of-payment" value="3">ADA</label>
                                            <label class="radio-inline"><input type="radio" class="mode-of-payment" id="others" name="add-mode-of-payment" value="4">Others (Please specify)</label>                                            
                                        </div>
                                        <div class="form-group col-lg-4">
                                            <input type="text" class="form-control" id="add-others" name="add-others" style="display: none">
                                        </div>  
                                </div>
                                <div class="panel-body">
                                        <div class="form-group col-lg-4">
                                            <label for="">Payee</label>
                                            <select class="form-control" name="add-payee" required>
                                                @foreach($users as $user)
                                                    <option value="{{ $user->id }}">{{ $user->first_name }} {{ $user->last_name }}</option>
                                                @endforeach
                                            </select>    
                                        </div>
                                        <div class="form-group col-lg-4">
                                            <label for="">TIN/Employee No.</label>
                                            <input type="text" class="form-control" name="add-tin">
                                        </div>
                                        <div class="form-group col-lg-4">
                                            <label for="">ORS/BUR No.</label>
                                            <input type="text" class="form-control" name="add-ors-bur-no">
                                        </div>

                                        <div class="form-group col-lg-12">
                                            <label for="">Address</label>
                                            <input type="text" class="form-control" name="add-address">
                                        </div>
                                </div>

                                <div class="panel-body">
                                    <div class="panel panel-default">
                                        <div class="panel-heading"> 
                                            <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#add-item-particulars">Add New Item</button>
                                        </div>
                                        <div class="panel-body">
                                            <div class="form-group col-lg-12">
                                                <table class="table table-bordered" id="dv-detail">
                                                    <thead>
                                                        <tr>
                                                            <th style="width: 40%;">Particulars</th>
                                                            <th>Responsibility Center</th>
                                                            <th>MFO/PAP</th>
                                                            <th>Amount</th>
                                                            {{--<th>Actions</th>--}}
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    </tbody>
                                                </table>
                                                
                                            </div>  
                                        </div>             
                                    </div>
                                </div>
                                    
                                <div class="panel-body">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <label for="">A. Certified: Expenses/Cash Advance necessary, lawful and incurred under my direct supervision.</label>
                                        </div>
                                        <div class="panel-body">
                                            <div class="form-group col-lg-6">
                                                <label>Certifier:</label>
                                                <select class="form-control" name="add-certifier-expense" required>
                                                    @foreach($users as $user)
                                                        <option value="{{ $user->id }}">{{ $user->first_name }} {{ $user->last_name  }}</option>
                                                    @endforeach
                                                </select> 
                                            </div>
                                            <div class="form-group col-lg-6">
                                                <label>Designation:</label>
                                                <select class="form-control" id="add-certifier-expense-designation" name="add-certifier-expense-designation"> 
                                                    @foreach($designations as $designation) 
                                                        <option value="{{ $designation->id }}">{{ $designation->designation_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="panel-body">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <label>B. Accounting Entry</label> 
                                            <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#add-item-accounting">Add New Item</button>
                                        </div>
                                        <div class="panel-body">
                                            <div class="form-group col-lg-12">
                                                <table class="table table-bordered" id="dv-accounting">
                                                    <thead>
                                                        <tr>
                                                            <th style="width: 50%;">Accounting Title</th>
                                                            <th>UACS Code</th>
                                                            <th>Debit</th>
                                                            <th>Credit</th>
                                                            <th>Actions</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    </tbody>
                                                </table>
                                                
                                            </div>  
                                        </div>             
                                    </div>
                                </div>

                                <div class="panel-body">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <label>C. Certified</label> 
                                        </div>
                                        <div class="panel-body">
                                            <div class="form-group col-lg-12">
                                                <label class="radio-inline"><input type="radio" name="add-certified" value="1">Cash Available</label>
                                                <label class="radio-inline"><input type="radio" name="add-certified" value="2">Subject to Authority to Debit Account (when applicable)</label>
                                                <label class="radio-inline"><input type="radio" name="add-certified" value="3">Supporting documents complete</label>
                                            </div>
                                            <div class="form-group col-lg-4">
                                                <label>Certifier:</label>
                                                <select class="form-control" name="add-certifier" required>
                                                    @foreach($users as $user)
                                                        <option value="{{ $user->id }}">{{ $user->first_name }} {{ $user->last_name  }}</option>
                                                    @endforeach
                                                </select> 
                                            </div>
                                            <div class="form-group col-lg-4">
                                                <label>Designation:</label>
                                                <select class="form-control" name="add-certifier-designation" required>
                                                    @foreach($designations as $designation) 
                                                        <option value="{{ $designation->id }}">{{ $designation->designation_name }}</option>
                                                    @endforeach
                                                </select> 
                                            </div>
                                            <div class="form-group col-lg-4">
                                                <label>Date:</label>
                                                <input type="date" class="form-control" name="add-certified-date">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="panel-body">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <label for="">D. Approved For Payment:</label>
                                        </div>
                                        <div class="panel-body">
                                            <div class="form-group col-lg-12">
                                                <textarea type="text" class="form-control" rows="2" name="add-approved-for-payment"></textarea>
                                            </div>
                                            <div class="form-group col-lg-4">
                                                <label>Approver:</label>
                                                <select class="form-control" name="add-approver" required>
                                                    @foreach($users as $user)
                                                        <option value="{{ $user->id }}">{{ $user->first_name }} {{ $user->last_name  }}</option>
                                                    @endforeach
                                                </select> 
                                            </div>
                                            <div class="form-group col-lg-4">
                                                <label>Designation:</label>
                                                <select class="form-control" name="add-approver-designation" required>
                                                    @foreach($designations as $designation) 
                                                        <option value="{{ $designation->id }}">{{ $designation->designation_name }}</option>
                                                    @endforeach
                                                </select> 
                                            </div>
                                            <div class="form-group col-lg-4">
                                                <label>Date:</label>
                                                <input type="date" class="form-control" id="add-approved-date" name="add-approved-date">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="panel-body">
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <label for="">E. Receipt Payment:</label>
                                        </div>
                                        <div class="panel-body">
                                            <div class="form-group col-lg-5">
                                                <label for="">Check/ADA No.</label>
                                                <input type="text" class="form-control" name="add-check-ada">
                                            </div>
                                            <div class="form-group col-lg-2">
                                                <label>Date:</label>
                                                <input type="date" class="form-control" id="add-check-date" name="add-check-date">
                                            </div>
                                            <div class="form-group col-lg-5">
                                                <label for="">Bank Name</label>
                                                <input type="text" class="form-control" name="add-bank">
                                            </div>
                                            <div class="form-group col-lg-5">
                                                <label for="">Printed Name</label>
                                                <select class="form-control" name="add-printed-name" required>
                                                    @foreach($users as $user)
                                                        <option value="{{ $user->id }}">{{ $user->first_name }} {{ $user->last_name  }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group col-lg-2">
                                                <label>Date:</label>
                                                <input type="date" class="form-control" id="add-printed-name-date" name="add-printed-name-date">
                                            </div>

                                            <div class="form-group col-lg-5">
                                                <label for="">JEV No.</label>
                                                <input type="text" class="form-control" name="add-jev-no">
                                            </div>         

                                            <div class="form-group col-lg-12">
                                                <label for="">Official Receipt/Other Documents</label>
                                                <input type="text" class="form-control" name="add-documents">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                        <div id="submit-iss" class="modal fade" role="dialog">
             
                                            <div class="modal-dialog">
                                        
                                                <!-- Modal content-->
                                                <div class="modal-content ">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Save Disbursement Voucher Request?</h4>
                                                    </div>
                                                    <div class="modal-body container-fluid">
                                                        <div class="form-group col-lg-12">   
                                                            <label for="add-department">
                                                                Are you sure you want to save your Disbursement Voucher Request? Changes cannot be made after it is sent.
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
                                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#submit-iss" style="float: right; width: 20%;">Submit Disbursement Voucher</button>  
                                </div> 

                                <div id="add-item-particulars" class="modal fade" role="dialog">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Add New Item</h4>
                                            </div>
                                            <div class="modal-body container-fluid">
                                                {!! Form::open(['id' => 'frm-add-particulars']) !!}
                                                <div class="col-lg-12">
                                                    <div class="form-group col-lg-12">
                                                        <label for="">Particulars</label>
                                                        <input class="form-control" name="add-particulars" id="add-particulars" required>
                                                    </div>        
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="form-group col-lg-5">
                                                        <label for="">Responsibility Center</label>
                                                        <input class="form-control" name="add-responsibility-center" id="add-responsibility-center" required>
                                                    </div>    
                                                    <div class="form-group col-lg-4">
                                                        <label for="">MFO/PAP</label>
                                                        <input type="text" class="form-control" name="add-mfo-pap" id="add-mfo-pap">
                                                    </div> 
                                                    <div class="form-group col-lg-3">
                                                        <label for="">Amount</label>
                                                        <input type="number" class="form-control" name="add-amount" id="add-amount">
                                                    </div>        
                                                </div>
                                                {!! Form::close() !!}

                                            </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-success" id="btn-add-particulars">Add</button>
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                </div>
                                        </div>
                                    </div>
                                </div>     

                                <div id="add-item-accounting" class="modal fade" role="dialog">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Add New Item</h4>
                                            </div>
                                            <div class="modal-body container-fluid">
                                                {!! Form::open(['id' => 'frm-add-accounting']) !!}
                                                <div class="col-lg-12">
                                                    <div class="form-group col-lg-12">
                                                        <label for="">Accounting Title</label>
                                                        <input class="form-control" name="add-accounting-title" id="add-accounting-title" required>
                                                    </div>        
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="form-group col-lg-4">
                                                        <label for="">UACS Code</label>
                                                        <input class="form-control" name="add-uacs" id="add-uacs" required>
                                                    </div>    
                                                    <div class="form-group col-lg-4">
                                                        <label for="">Debit</label>
                                                        <input type="number" class="form-control" name="add-debit" id="add-debit">
                                                    </div> 
                                                    <div class="form-group col-lg-4">
                                                        <label for="">Credit</label>
                                                        <input type="number" class="form-control" name="add-credit" id="add-credit">
                                                    </div>        
                                                </div>
                                                {!! Form::close() !!}
                                            </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-success" id="btn-add-accounting">Add</button>
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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

            });

            $('.mode-of-payment').click(function(){
                
                if($('#others').is(':checked')) $('#add-others').css('display', 'block');
                else $('#add-others').css('display', 'none');

                $('#add-others').val('');

            });

            $('#btn-add-particulars').click(function(){
                
                var tbl_len = $("#dv-detail tr").length;

                $('#dv-detail tbody').append(
                        '<tr id="' + tbl_len + '">' +
                            '<td>' + $("#add-particulars").val() + '</td>' +
                            '<td>' + $("#add-responsibility-center").val() + '</td>' +
                            '<td>' + $("#add-mfo-pap").val() + '</td>' +
                            '<td>' + $("#add-amount").val() + '</td>' +
                            /*'<td>' +
                                '<a data-toggle="modal" href="#edit-det' + tbl_len + '"><span class="glyphicon glyphicon-edit"></span></a>' +
                                '<a data-toggle="modal" href="#del-det' + tbl_len + '"><span class="glyphicon glyphicon-trash"></span></a>' +
                            '</td>' +*/
                            '<input type="hidden" name="hdn-particulars[]' + '" value="' + $("#add-particulars").val() + '">' +
                            '<input type="hidden" name="hdn-responsibility-center[]' + '" value="' + $("#add-particulars").val() + '">' +
                            '<input type="hidden" name="hdn-mfo-pap[]' + '" value="' + $("#add-mfo-pap").val() + '">' +
                            '<input type="hidden" name="hdn-amount[]' + '" value="' + $("#add-amount").val() + '">' +
                            '<input type="hidden" name="hdn-detail-quantity' + '" value="' + tbl_len + '">' +
                        '</tr>'
                    );

                var detail  = {
                    id: tbl_len,
                    particulars: $("#add-particulars").val(),
                    resp_center: $("#add-responsibility-center").val(),
                    mfo_pap: $("#add-mfo-pap").val(),
                    amount: $("#add-amount").val()
                };

                createDelDetModal(detail);
                createEditDetModal(detail);

                $("#add-item-particulars").modal("hide");
                $("#add-item-particulars").find('form').trigger('reset');
            }); 

            
            $('#btn-add-accounting').click(function(){
                         
                var tbl_len = $("#dv-accounting tr").length;

                $('#dv-accounting tbody').append(
                        '<tr id="' + tbl_len + '">' +
                            '<td>' + $("#add-accounting-title").val() + '</td>' +
                            '<td>' + $("#add-uacs").val() + '</td>' +
                            '<td>' + $("#add-debit").val() + '</td>' +
                            '<td>' + $("#add-credit").val() + '</td>' +
                            /*'<td>' +
                                '<a data-toggle="modal" href="#edit-acc' + tbl_len + '"><span class="glyphicon glyphicon-edit"></span></a>' +
                                '<a data-toggle="modal" href="#del-acc' + tbl_len + '"><span class="glyphicon glyphicon-trash"></span></a>' +
                            '</td>' +*/
                            '<input type="hidden" name="hdn-accounting-title[]' + '" value="' + $("#add-accounting-title").val() + '">' +
                            '<input type="hidden" name="hdn-uacs[]' + '" value="' + $("#add-uacs").val() + '">' +
                            '<input type="hidden" name="hdn-debit[]' + '" value="' + $("#add-debit").val() + '">' +
                            '<input type="hidden" name="hdn-credit[]' + '" value="' + $("#add-credit").val() + '">' +
                            '<input type="hidden" name="hdn-acc-quantity' + '" value="' + tbl_len + '">' +
                        '</tr>'
                    );

                var acc  = {
                    id: tbl_len,
                    acc_title: $("#add-accounting-title").val(),
                    uacs: $("#add-uacs").val(),
                    debit: $("#add-debit").val(),
                    credit: $("#add-credit").val()
                };

                createDelAccModal(acc);
                createEditAccModal(acc);

                $("#add-item-accounting").modal("hide");
                $("#add-item-accounting").find('form').trigger('reset');
            }); 

            function createEditDetModal(detail)
            {
                $('#add-item-particulars').after(
                                '<div id="edit-det' + detail.id + '" class="modal fade" role="dialog">' +
                                    '<div class="modal-dialog">' +
                                        '<div class="modal-content">' +
                                            '<div class="modal-header">' +
                                                '<label>Edit Item</label>' +
                                            '</div>' +
                                            '<div class="modal-body container-fluid">' +
                                                '<div class="col-lg-12">' + 
                                                    '<div class="form-group col-lg-12">' +
                                                        '<label for="">Particulars</label>' +
                                                        '<input class="form-control" name="add-particulars" id="add-particulars" value="' + detail.particulars + '" required>' +
                                                    '</div>' +
                                                '</div>' +
                                                '<div class="col-lg-12">' +
                                                    '<div class="form-group col-lg-5">' +
                                                        '<label for="">Responsibility Center</label>' +
                                                        '<input class="form-control" name="add-responsibility-center" id="add-responsibility-center" value="' + detail.resp_center + '" required>' +
                                                    '</div>' +    
                                                    '<div class="form-group col-lg-4">' +
                                                        '<label for="">MFO/PAP</label>' +
                                                        '<input type="text" class="form-control" name="add-mfo-pap" id="add-mfo-pap" value="' + detail.mfo_pap + '" required>' +
                                                    '</div>' +
                                                    '<div class="form-group col-lg-3">' +
                                                        '<label for="">Amount</label>' +
                                                        '<input type="number" class="form-control" name="add-amount" id="add-amount" value="' + detail.amount + '" required>' +
                                                    '</div>' +        
                                                '</div>' +
                                            '</div>' +
                                            '<div class="modal-footer">' +
                                                    '<button type="button" class="btn btn-success">Update</button>' +
                                                    '<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>' +
                                            '</div>' +
                                        '</div>' +
                                    '</div>' +
                                '</div>'
                    );
            } 

            function createDelDetModal(detail)
            {
                $('#add-item-particulars').after(
                                '<div id="del-det' + detail.d + '" class="modal fade" role="dialog">' +
                                    '<div class="modal-dialog">' +
                                        '<div class="modal-content">' +
                                            '<div class="modal-header">' +
                                                '<label>Remove Item</label>' +
                                            '</div>' +
                                            '<div class="modal-body container-fluid">' +
                                                '<div class="col-lg-12">' +
                                                    '<div class="form-group col-lg-12">' +
                                                        '<span>Are you sure you want to remove' + detail.particulars + '?</span>' +
                                                    '</div>' +        
                                                '</div>' +
                                            '</div>' +
                                            '<div class="modal-footer">' +
                                                    '<button type="button" class="btn btn-success">Yes</button>' +
                                                    '<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>' +
                                            '</div>' +
                                        '</div>' +
                                    '</div>' +
                                '</div>'
                    );
            }   

            function createEditAccModal(acc)
            {
                $('#add-item-accounting').after(
                                '<div id="edit-acc' + acc.id + '" class="modal fade" role="dialog">' +
                                    '<div class="modal-dialog">' +
                                        '<div class="modal-content">' +
                                            '<div class="modal-header">' +
                                                '<label>Edit Item</label>' +
                                            '</div>' +
                                            '<div class="modal-body container-fluid">' +
                                                '<div class="col-lg-12">' + 
                                                    '<div class="form-group col-lg-12">' +
                                                        '<label for="">Accounting Title</label>' +
                                                        '<input class="form-control" name="add-particulars" id="add-particulars" value="' + acc.acc_title + '" required>' +
                                                    '</div>' +
                                                '</div>' +
                                                '<div class="col-lg-12">' +
                                                    '<div class="form-group col-lg-5">' +
                                                        '<label for="">UACS Code</label>' +
                                                        '<input class="form-control" name="add-responsibility-center" id="add-responsibility-center" value="' + acc.uacs + '" required>' +
                                                    '</div>' +    
                                                    '<div class="form-group col-lg-4">' +
                                                        '<label for="">Debit</label>' +
                                                        '<input type="text" class="form-control" name="add-mfo-pap" id="add-mfo-pap" value="' + acc.debit + '" required>' +
                                                    '</div>' +
                                                    '<div class="form-group col-lg-3">' +
                                                        '<label for="">Credit</label>' +
                                                        '<input type="number" class="form-control" name="add-amount" id="add-amount" value="' + acc.credit + '" required>' +
                                                    '</div>' +        
                                                '</div>' +
                                            '</div>' +
                                            '<div class="modal-footer">' +
                                                    '<button type="button" class="btn btn-success">Update</button>' +
                                                    '<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>' +
                                            '</div>' +
                                        '</div>' +
                                    '</div>' +
                                '</div>'
                    );
            } 

            function createDelAccModal(acc)
            {
                $('#add-item-accounting').after(
                                '<div id="del-acc' + acc.id + '" class="modal fade" role="dialog">' +
                                    '<div class="modal-dialog">' +
                                        '<div class="modal-content">' +
                                            '<div class="modal-header">' +
                                                '<label>Remove Item</label>' +
                                            '</div>' +
                                            '<div class="modal-body container-fluid">' +
                                                '<div class="col-lg-12">' +
                                                    '<div class="form-group col-lg-12">' +
                                                        '<span>Are you sure you want to remove' + acc.acc_title + '?</span>' +
                                                    '</div>' +        
                                                '</div>' +
                                            '</div>' +
                                            '<div class="modal-footer">' +
                                                    '<button type="button" class="btn btn-success">Yes</button>' +
                                                    '<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>' +
                                            '</div>' +
                                        '</div>' +
                                    '</div>' +
                                '</div>'
                    );
            }   



            </script>

        @stop
    @else
        @section('content')
            <div id="page-wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            <div class="alert" style="background-color: #f2f2f2">
                                <strong style="color: #565656;">You have no permission to access this page.</strong>
                            </div>
                        </h1>
                    </div>
                </div>
            </div>
        @stop
    @endif
    @else
        @section('content')
            <div id="page-wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            <div class="alert" style="background-color: #f2f2f2">
                                <strong style="color: #565656;">You have no permission to access this page.</strong>
                            </div>
                        </h1>
                    </div>
                </div>
            </div>
        @stop
@endif