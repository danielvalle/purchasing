@extends('layouts.master')

@section('title', 'SLSU - Purchase Request')

@section('content')
        <head>
            @if(Session::has('pr_new_check'))
                <meta http-equiv="refresh" content="0; url=/purchasing/public/transaction/purchase-request-pdf">
            @endif
        </head>

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Transaction</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            @if(Session::has('pr_add_success'))
            <div class="row">
                <div class="col-lg-12">
                    <div class="alert alert-success alert-dismissable">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>{!! session('pr_add_success') !!}</strong>
                        <a href="{{ URL::to('transaction/purchase-request-pdf') }}" class="btn-sm btn-info">Save PDF</a>
                    </div>
                </div>
            </div>
            @endif

            @if(Session::has('pr_add_fail'))
            <div class="row">
                <div class="col-lg-12">
                    <div class="alert alert-danger alert-dismissable">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>{!! session('pr_add_fail') !!}</strong>
                    </div>
                </div>
            </div>
            @endif
            {!! Form::open(['url' => 'transaction/purchase-request', 'method' => 'post']) !!} 
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <span style="font-size: 20px;">Purchase Request</span> 
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                        <div class="panel-body">
                            <div class="form-group col-lg-6">
                                <label for="">Purchase Request Date:  <span id="Date"></span></label>
                                
                                <input type="hidden" id="Date" name="Date">
                                <input type="hidden" id="transaction_date" name="transaction_date" />
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#add-item">Add New Item</button> 
                                </div>
                                <div class="panel-body">
                                    <div class="form-group col-lg-12">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Stock No.</th>
                                                    <th>Category</th>
                                                    <th>Item</th>
                                                    <th>Quantity</th>
                                                    <th>Unit</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @for($i = 0; $i < count($pr_items); $i++)
                                                <tr>
                                                    <td>{{ $pr_items[$i]->stock_no }}</td>
                                                    <td>{{ $pr_categories[$i]->category_name }}</td>
                                                    <td>{{ $pr_items[$i]->item_name }}</td>
                                                    <td>{{ $pr_quantities[$i] }}</td>
                                                    <td>{{ $pr_units[$i]->unit_name }}</td>                                            
                                                    <td>
                                                        <a data-toggle="modal" href="#{{ $i }}edit-pr"><span class="glyphicon glyphicon-edit"></span></a>
                                                        <a data-toggle="modal" href="#{{ $i }}del-pr"><span class="glyphicon glyphicon-trash"></span></a>
                                                    </td>
                                                </tr>
                                                @endfor
                                            </tbody>
                                        </table>
                                        
                                    </div>  
                                </div>             
                            </div>
                        </div>
                        <div class="panel-body">
                            <div class="form-group col-lg-6">
                                <label for="">Entity Name:</label>
                                <select class="form-control" name="add-entity" id="add-entity" required>
                                    @foreach($entities as $entity)
                                        <option value="{{ $entity->id }}">{{ $entity->entity_name }}</option>
                                    @endforeach
                                </select>
                            </div>  
                            <div class="form-group col-lg-6">
                                <label for="">Fund Cluster:</label>
                                <input class="form-control" id="add-fund-cluster" name="add-fund-cluster">
                            </div>  

                            <div class="form-group col-lg-6">
                                <label for="">Office/Section</label>
                                <select class="form-control" name="add-office" id="add-office" required>
                                    @foreach($offices as $office)
                                        <option value="{{ $office->id }}">{{ $office->office_name }}</option>
                                    @endforeach
                                </select>
                            </div> 
                            <div class="form-group col-lg-6">
                                <label for="">Responsibility Center Code:</label>
                                <input class="form-control" id="add-responsibility-center-code" name="add-responsibility-center-code">
                            </div>                               
                        </div>

                        <div class="panel-body">
                            <div class="form-group col-lg-12">
                                <label for="">Purpose:</label>
                                <textarea class="form-control" row="4" id="add-purpose" name="add-purpose"></textarea>
                            </div>
                        </div>

                        <div class="panel-body">
                            <div class="form-group col-lg-6">
                                <label for="">Requested by</label>
                                <select class="form-control" name="add-requested-by" id="add-requested-by" required>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->first_name }} {{ $user->middle_name }} {{ $user->last_name }}</option>
                                    @endforeach
                                </select>
                            </div>  
                            <div class="form-group col-lg-6">
                                <label for="">Requestor Designation</label>
                                <select class="form-control" name="add-requestor-designation" id="add-requestor-designation" required>
                                    @foreach($designations as $designation)
                                        <option value="{{ $designation->id }}">{{ $designation->designation_name }}</option>
                                    @endforeach
                                </select>
                            </div>  

                            <div class="form-group col-lg-6">
                                <label for="">Approved by</label>
                                <select class="form-control" name="add-approved-by" id="add-approved-by" required>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->first_name }} {{ $user->middle_name }} {{ $user->last_name }}</option>
                                    @endforeach
                                </select>   
                            </div> 
                            <div class="form-group col-lg-6">
                                <label for="">Approver Designation</label>
                                <select class="form-control" name="add-approver-designation" id="add-approver-designation" required>
                                    @foreach($designations as $designation)
                                        <option value="{{ $designation->id }}">{{ $designation->designation_name }}</option>
                                    @endforeach
                                </select>
                            </div>  
                        </div>

                                <div id="submit-pr" class="modal fade" role="dialog">
     
                                    <div class="modal-dialog">
                                
                                        <!-- Modal content-->
                                        <div class="modal-content ">
                                            <div class="modal-header">
                                                <h4 class="modal-title">Save Purchase Request?</h4>
                                            </div>
                                            <div class="modal-body container-fluid">
                                                <div class="form-group col-lg-12">   
                                                    <label>
                                                        Are you sure you want to save your Purchase Request? Changes cannot be made after it is sent.
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
                          <button type="button" data-toggle="modal" data-target="#submit-pr" style="float: right; width: 20%;"class="btn btn-success">Convert to RFQ</button>  
                    <div>
                              

                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>

            <div id="add-item" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    {!! Form::open(['url' => 'transaction/purchase-request/add-item', 'method' => 'post']) !!}
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Add New Item</h4>
                        </div>
                        <div class="modal-body container-fluid">
                            <div class="col-lg-12"> 
                                <div class="form-group col-lg-7">
                                    <label for="">Item Category</label>
                                    <select style="float: left; width: 91%;" class="form-control category" name="add-category" id="add-category">
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                        @endforeach
                                    </select>
                                    <a style="color:green; float: left; margin-left: 5px; font-size: 27px;" data-toggle="modal" href="#add-new-category"><span class="glyphicon glyphicon-plus-sign"></span></a>
                                </div>              
                            </div>
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
                                    <label for="">Quantity</label>
                                    <input type="number" class="form-control" name="add-quantity" id="add-quantity" min="1" required>
                                </div>   
                                <div class="form-group col-lg-3">
                                    <label for="">Unit</label>
                                    <select class="form-control" name="add-unit" id="add-unit">
                                        @foreach($units as $unit)
                                            <option value="{{ $unit->id }}">{{ $unit->unit_name }}</option>
                                        @endforeach
                                    </select>
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

            <div id="add-new-category" class="modal fade" role="dialog" style="top: 40px;">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Add New Category</h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="category-name">Category Name</label>
                                <input type="text" class="form-control" id="add-new-category-name" name="add-new-category-name" placeholder="Enter an category name">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-success" id="btn-new-category">Add</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div>

            @for($i = 0; $i < count($pr_items); $i++)
            <div id="{{ $i }}edit-pr" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    {!! Form::open(['url' => 'transaction/purchase-request/edit-item', 'method' => 'post']) !!}
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Edit Item</h4>
                        </div>
                        <div class="modal-body container-fluid">
                            <div class="col-lg-12">
                                <input type="hidden" name="edit-item-id" value="{{ $i }}">    
                                <div class="form-group col-lg-7">
                                    <label for="">Item Category</label>
                                    <select style="float: left; width: 91%;" class="form-control category" name="edit-category" id="edit-category">
                                        @foreach($categories as $category)
                                            @if($category->id == $pr_categories[$i]->id)
                                                <option value="{{ $category->id }}" selected>{{ $category->category_name }}</option>
                                            @else
                                                <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                    <a style="color:green; float: left; margin-left: 5px; font-size: 27px;" data-toggle="modal" href="#add-new-category"><span class="glyphicon glyphicon-plus-sign"></span></a>
                                </div>   

                            </div>
                            <div class="col-lg-12">
                                <div class="form-group col-lg-4">
                                    <label for="">Item:</label>
                                    <select class="form-control" name="edit-item" id="edit-item">
                                        @foreach($items as $item)
                                            @if($pr_items[$i]->id == $item->id)
                                                <option value="{{ $item->id }}" selected>{{ $item->item_name }}</option>
                                            @else
                                                <option value="{{ $item->id }}">{{ $item->item_name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>        
                                <div class="form-group col-lg-3">
                                    <label for="">Quantity</label>
                                    <input type="number" class="form-control" name="edit-quantity" id="edit-quantity" min="1" value="{{ $pr_quantities[$i] }}">
                                </div>   
                                <div class="form-group col-lg-3">
                                    <label for="">Unit</label>
                                    <select class="form-control" name="edit-unit" id="edit-unit">
                                        @foreach($units as $unit)
                                            @if($pr_units[$i]->id == $unit->id)
                                                <option value="{{ $unit->id }}" selected>{{ $unit->unit_name }}</option>
                                            @else
                                                <option value="{{ $unit->id }}">{{ $unit->unit_name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>   
                            </div>                    
                        </div>

                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">Edit</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal" id="modal-close">Close</button>
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>

            <div id="{{ $i }}del-pr" class="modal fade" role="dialog">
                <div class="modal-dialog">
                    {!! Form::open(['url' => 'transaction/purchase-request/destroy', 'method' => 'post']) !!}
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Remove Item</h4>
                        </div>
                        <div class="modal-body container-fluid">
                            <div class="col-lg-12" >
                                <div class="form-group">
                                    <input type="hidden" name="del-item-id" value="{{ $i }}">
                                    Are you sure you want to remove <label for=""> {{ $pr_items[$i]->stock_no }} {{ $pr_items[$i]->item_name }}</label>?
                                </div>                               
                            </div>
                        
                        </div>
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-danger">Remove</button>
                                <button type="button" class="btn btn-default" data-dismiss="modal" id="modal-close">Close</button>
                            </div>
                    </div>
                    {!! Form::close() !!}
                </div>
            </div>

        @endfor
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

        $(window).keydown(function(event){
            if(event.keyCode == 13) {
              event.preventDefault();
              return false;
            }
          });
    });


    $(document).ready(function(){

        $('#modal-close').click(function(){
            location.reload(true);
        });

        $('#btn-new-category').click(function(){

            $.ajaxSetup({
                headers:
                { 'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content') }
            });

            $.ajax({
                url: 'purchase-request/new-category',
                type: "post",
                data: {
                    'new-category' : $('#add-new-category-name').val()
                },
                dataType: 'json',
                success: function(data){
                    var new_category = "<option value=" + data.id + ">" + data.name + "</option>"; 
                    $('.category').append(new_category);

                    $('#add-new-category').modal('hide');
                }

            });      

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
                            '<button type="button" id="btn-del-supplier"><span class="glyphicon glyphicon-trash"></span></button>' +
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