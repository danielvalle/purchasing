@extends('layouts.master')

@section('title', 'SLSU - Issuance')

@if(Auth::check())
    @if(Auth::user()->user_type == 1)
        @section('content')
                <head>
                    @if(Session::has('issue_new_check'))
                        <meta http-equiv="refresh" content="0; url=/purchasing/public/transaction/issuance-pdf">
                    @endif
                </head>

                <div id="page-wrapper">
                    <div class="row">
                        <div class="col-lg-12">
                            <h1 class="page-header">Transaction</h1>
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
                    @if(Session::has('issue_add_success'))
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="alert alert-success alert-dismissable">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <strong>{!! session('issue_add_success') !!}</strong>
                                <a href="{{ URL::to('transaction/issuance-pdf') }}" class="btn-sm btn-info">Save PDF</a>
                            </div>
                        </div>
                    </div>
                    @endif
    
                    @if(Session::has('issue_add_fail'))
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="alert alert-danger alert-dismissable">
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                <strong>{!! session('issue_add_fail') !!}</strong>
                            </div>
                        </div>
                    </div>
                    @endif
                    <div class="row">   
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <span style="font-size: 20px;">Issuance</span> 
                                </div>
                                <!-- /.panel-heading -->
                                <div class="panel-body">

                                <div class="panel-body">
                                    {!! Form::open(['method' => 'post', 'url' => 'transaction/issuance']) !!}
                                <div class="panel-body">   
                                    <div class="form-group col-lg-3">                          
                                            <label for="">Entity</label>
                                            <select class="form-control" name="add-entity" id="add-entity" required>
                                                @foreach($entities as $entity)
                                                    <option value="{{ $entity->id }}">{{ $entity->entity_name }}</option>
                                                @endforeach
                                            </select>                                                            
                                    </div>

                                    <div class="form-group col-lg-3">                          
                                        
                                            <label for="">Department</label>
                                            <select class="form-control" name="add-department" id="add-department" required>
                                                @foreach($departments as $department)
                                                    <option value="{{ $department->id }}">{{ $department->department_name }}</option>
                                                @endforeach
                                            </select>                              
                                        
                                    </div>

                                    <div class="form-group col-lg-3">                          
                                        
                                            <label for="">Office</label>
                                            <select class="form-control" name="add-office" id="add-office" required>
                                                @foreach($offices as $office)
                                                    <option value="{{ $office->id }}">{{ $office->office_name }}</option>
                                                @endforeach
                                            </select>                              
                                       
                                    </div>

                                     <div class="form-group col-lg-3">                          
                                        
                                            <label for="">Reasonability Center Code</label>
                                            <input type="text" class="form-control" name="add-code" id="add-code">                              
                                        </div>
                                   
                                </div>

                                <div class="panel-body">   

                                    <div class="form-group col-lg-3">                          
                                        <div class="form-group">
                                            <label for="">RIS No.</label>
                                            <input type="text" class="form-control" name="add-ris-no" id="add-ris-no">                            
                                        </div>
                                    </div>

                                    <div class="form-group col-lg-3">                          
                                        <div class="form-group">
                                            <label for="">RIS Date</label>
                                            <input type="date" class="form-control" name="add-ris-date" id="add-ris-date">                           
                                        </div>
                                    </div>

                                    <div class="form-group col-lg-3">                          
                                        <div class="form-group">
                                            <label for="">SAI No.</label>
                                            <input type="text" class="form-control" name="add-sai-no" id="add-sai-no">                             
                                        </div>
                                    </div>

                                     <div class="form-group col-lg-3">                          
                                        <div class="form-group">
                                            <label for="">SAI Date.</label>
                                            <input type="date" class="form-control" name="add-sai-date" id="add-sai-date">                              
                                        </div>
                                    </div>
                                </div>

                                 <div class="panel-body">
                                    <div class="panel panel-default">
                                        <div class="panel-heading"><button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#add-item">Add New Item</button> </div>
                                        <div class="panel-body">
                                            <div class="form-group col-lg-12">
                                                <table class="table table-bordered" id="issuance-items">
                                                    <thead>
                                                        <tr>
                                                            <th>Stock No.</th>
                                                            <th style="width: 20%;">Item</th>
                                                            <th style="width: 15%">Quantity</th>
                                                            <th>Unit</th>
                                                            <th>Item Description</th>
                                                            <th>Remarks</th>
                                                            <th style="width: 15%">No. of Days to Consume</th>
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
                                        <div class="form-group col-lg-12">                          
                                            <label for="">Purpose</label>
                                            <textarea type="text"row="2" class="form-control" name="add-purpose" id="add-purpose"></textarea>                      
                                        </div>
                                    </div>

                                    <div class="panel-body">
                                        <div class="form-group col-lg-4">                          
                                            <div class="form-group">
                                                <label for="">Requested By</label>
                                                <select class="form-control" name="add-requested-by" id="add-requested-by" required>
                                                    @foreach($users as $user)
                                                        <option value="{{ $user->id }}">{{ $user->first_name }} {{ $user->last_name }}</option>
                                                    @endforeach
                                                </select>                                                  
                                            </div>
                                        </div>

                                        <div class="form-group col-lg-4">                          
                                            <div class="form-group">
                                                <label for="">Requestor Designation</label>
                                                <select class="form-control" name="add-requestor-designation" id="add-requestor-designation" required>
                                                    @foreach($designations as $designation)
                                                        <option value="{{ $designation->id }}">{{ $designation->designation_name }}</option>
                                                    @endforeach
                                                </select>                         
                                            </div>
                                        </div>

                                         <div class="form-group col-lg-4">                          
                                            <div class="form-group">
                                                <label for="">Request Date</label>
                                                <input type="date" class="form-control" name="add-request-date" id="add-request-date">                              
                                            </div>
                                        </div>
                                    </div>

                                    <div class="panel-body">
                                        <div class="form-group col-lg-4">                          
                                            <div class="form-group">
                                                <label for="">Approved By</label>
                                                <select class="form-control" name="add-approved-by" id="add-approved-by" required>
                                                    @foreach($users as $user)
                                                        <option value="{{ $user->id }}">{{ $user->first_name }} {{ $user->last_name }}</option>
                                                    @endforeach
                                                </select>                                                  
                                            </div>
                                        </div>

                                        <div class="form-group col-lg-4">                          
                                            <div class="form-group">
                                                <label for="">Approver Designation</label>
                                                <select class="form-control" name="add-approver-designation" id="add-approver-designation" required>
                                                    @foreach($designations as $designation)
                                                        <option value="{{ $designation->id }}">{{ $designation->designation_name }}</option>
                                                    @endforeach
                                                </select>                         
                                            </div>
                                        </div>

                                         <div class="form-group col-lg-4">                          
                                            <div class="form-group">
                                                <label for="">Approved Date</label>
                                                <input type="date" class="form-control" name="add-approved-date" id="add-approved-date">                              
                                            </div>
                                        </div>
                                    </div>                        
                                
                                    <div class="panel-body">
                                        <div class="form-group col-lg-4">                          
                                            <div class="form-group">
                                                <label for="">Issued By</label>
                                                <select class="form-control" name="add-issued-by" id="add-issued-by" required>
                                                    @foreach($users as $user)
                                                        <option value="{{ $user->id }}">{{ $user->first_name }} {{ $user->last_name }}</option>
                                                    @endforeach
                                                </select>                                                  
                                            </div>
                                        </div>

                                        <div class="form-group col-lg-4">                          
                                            <div class="form-group">
                                                <label for="">Issuer Designation</label>
                                                <select class="form-control" name="add-issuer-designation" id="add-issuer-designation" required>
                                                    @foreach($designations as $designation)
                                                        <option value="{{ $designation->id }}">{{ $designation->designation_name }}</option>
                                                    @endforeach
                                                </select>                         
                                            </div>
                                        </div>

                                         <div class="form-group col-lg-4">                          
                                            <div class="form-group">
                                                <label for="">Issued Date</label>
                                                <input type="date" class="form-control" name="add-issued-date" id="add-issued-date">                              
                                            </div>
                                        </div>
                                    </div>
                               
                                    <div class="panel-body">
                                        <div class="form-group col-lg-4">                          
                                            <div class="form-group">
                                                <label for="">Received By</label>
                                                <select class="form-control" name="add-received-by" id="add-received-by" required>
                                                    @foreach($users as $user)
                                                        <option value="{{ $user->id }}">{{ $user->first_name }} {{ $user->last_name }}</option>
                                                    @endforeach
                                                </select>                                                  
                                            </div>
                                        </div>

                                        <div class="form-group col-lg-4">                          
                                            <div class="form-group">
                                                <label for="">Reciepient Designation</label>
                                                <select class="form-control" name="add-reciepient-designation" id="add-reciepient-designation" required>
                                                    @foreach($designations as $designation)
                                                        <option value="{{ $designation->id }}">{{ $designation->designation_name }}</option>
                                                    @endforeach
                                                </select>                         
                                            </div>
                                        </div>

                                         <div class="form-group col-lg-4">                          
                                            <div class="form-group">
                                                <label for="">Receipt Date</label>
                                                <input type="date" class="form-control" name="add-receipt-date" id="add-receipt-date">                              
                                            </div>
                                        </div>
                                    </div>

                                        <div id="submit-iss" class="modal fade" role="dialog">
             
                                            <div class="modal-dialog">
                                        
                                                <!-- Modal content-->
                                                <div class="modal-content ">
                                                    <div class="modal-header">
                                                        <h4 class="modal-title">Save Issuance?</h4>
                                                    </div>
                                                    <div class="modal-body container-fluid">
                                                        <div class="form-group col-lg-12">   
                                                            <label for="add-department">
                                                                Are you sure you want to save your Issuance? Changes cannot be made after it is sent.
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
                                    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#submit-iss" style="float: right; width: 20%;">Convert to RFQ</button>  
                                </div>             

                                <div id="add-item" class="modal fade" role="dialog">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Add New Item</h4>
                                            </div>
                                            <div class="modal-body container-fluid">
                                                <div class="col-lg-12">
                                                    <div class="form-group col-lg-6">
                                                        <label for="">Item:</label>
                                                        <select class="form-control" name="add-item" id="add-item" required>
                                                            @foreach($items as $item)
                                                                <option value="{{ $item->id }}">{{ $item->item_name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>        
                                                    <div class="form-group col-lg-3">
                                                        <label for="">Unit</label>
                                                        <select class="form-control" name="add-unit" id="add-unit" required>
                                                            @foreach($units as $unit)
                                                                <option value="{{ $unit->id }}">{{ $unit->unit_name }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>    
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="form-group col-lg-12">
                                                        <label for="">Remarks:</label>
                                                        <textarea type="text" class="form-control" name="add-remarks" id="add-remarks"></textarea>
                                                    </div>        
                                                </div>


                                            </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-success" id="btn-add-item">Add</button>
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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

            var i = 0;

            $(document).ready(function(){

                $('#modal-close').click(function(){
                    location.reload(true);
                });

                $('#btn-add-item').click(function(){

                    $.ajaxSetup({
                        headers:
                        { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') }
                    });

                    $.ajax({
                        url: 'issuance/add-item',
                        type: "post",
                        data: {
                            'item_id': $('#add-item').find('option:selected').val(), 
                            'quantity' : $('#add-quantity').val(),
                            'unit_id': $('#add-unit').find('option:selected').val(), 
                            'remarks' : $('#add-remarks').val()
                        },
                        dataType: 'json',
                        success: function(data){
                            
                            $("select#add-item").find('[value=' + data.item_id + ']').remove();

                            $('#issuance-items tbody').append(
                                '<tr>' +
                                '<td>' + data.stock_no + '</td>' +
                                '<td>' + data.item_name + '</td>' +
                                '<td> <input type="number" class="form-control col-lg-3" name="quantity' + i + '" required></td>' +
                                '<td>' + data.unit_name + '</td>' +
                                '<td>' + data.item_description + '</td>' +
                                '<td>' + data.remarks + '</td>' +
                                '<input type="hidden" name="hdn-stock-no'  + i + '" value="' + data.stock_no + '">' +
                                '<input type="hidden" name="hdn-item'  + i + '" value="' + data.item_id + '">' +
                                '<input type="hidden" name="hdn-unit'  + i + '" value="' + data.unit_id + '">' +
                                '<input type="hidden" name="hdn-remarks'  + i + '" value="' + data.remarks + '">' +
                                '<td> <input type="text" class="form-control col-lg-3" name="no-days-consume' + i + '"></td>' +
                                '</tr>'
                            );

                            i++;

                            $("#add-item").modal("hide");
                            $("#add-remarks").val("");

                            if($('select#add-item').has('option').length == 0 ) {
                                $('#btn-add-item').prop('disabled', true);
                        
                            }
                        }

                    });      
                }); 
            
            });

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