@extends('layouts.master')

@section('content')


        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Maintenance</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            @if(Session::has('item_new_success'))
            <div class="row">
                <div class="col-lg-12">
                    <div class="alert alert-success alert-dismissable">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>{!! session('item_new_success') !!}</strong>
                    </div>
                </div>
            </div>
            @endif

            @if(Session::has('item_new_fail'))
            <div class="row">
                <div class="col-lg-12">
                    <div class="alert alert-danger alert-dismissable">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>{!! session('item_new_fail') !!}</strong>
                    </div>
                </div>
            </div>
            @endif

            @if(Session::has('stock_no_new_fail'))
            <div class="row">
                <div class="col-lg-12">
                    <div class="alert alert-danger alert-dismissable">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>{!! session('stock_no_new_fail') !!}</strong>
                    </div>
                </div>
            </div>
            @endif

            @if(Session::has('item_edit_success'))
            <div class="row">
                <div class="col-lg-12">
                    <div class="alert alert-success alert-dismissable">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>{!! session('item_edit_success') !!}</strong>
                    </div>
                </div>
            </div>
            @endif

            @if(Session::has('item_edit_fail'))
            <div class="row">
                <div class="col-lg-12">
                    <div class="alert alert-danger alert-dismissable">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>{!! session('item_edit_fail') !!}</strong>
                    </div>
                </div>
            </div>
            @endif

            @if(Session::has('stock_no_edit_fail'))
            <div class="row">
                <div class="col-lg-12">
                    <div class="alert alert-danger alert-dismissable">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>{!! session('stock_no_edit_fail') !!}</strong>
                    </div>
                </div>
            </div>
            @endif
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <span style="font-size: 20px;">Item</span> 
                            <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#add-item">Add New</button> 
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table" id="dt-item">
                                <thead>
                                    <tr>
                                        <th>Stock No.</th>
                                        <th>Item Name</th>
                                        <th style="width:60%">Item Description</th>
                                        <th>Item Quantity</th>
                                        <th style="width:10%;">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($items as $item)
                                        @if($item->is_active == 1)
                                        <tr>
                                            <td>{{ $item->stock_no }}</td>
                                            <td>{{ $item->item_name }}</td>
                                            <td>{{ $item->item_description }}</td>
                                            <td>{{ $item->item_quantity }}</td>
                                            <td>
                                                <a data-toggle="modal" href="#{{ $item->id }}edit-item"><span class="glyphicon glyphicon-edit"></span></a>
                                                <a data-toggle="modal" href="#{{ $item->id }}del-item"><span class="glyphicon glyphicon-trash"></span></a>
                                                <a data-toggle="modal" href="#{{ $item->id }}view-stock-card"><span class="glyphicon glyphicon-eye-open"></span></a> 
                                            </td>
                                        </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                       </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            
            <!-- Add New Item -->
            <div id="add-item" class="modal fade" role="dialog">
            {!! Form::open(['url' => 'maintenance/item', 'method' => 'post']) !!} 
                <div class="modal-dialog">
            
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Add New Item</h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="add-item-name">Stock No.</label>
                                <input type="text" class="form-control" id="add-stock-no" name="add-stock-no" placeholder="Enter a stock number">
                            </div>
                            <div class="form-group">
                                <label for="add-item-name">Item Name</label>
                                <input type="text" class="form-control" id="add-item-name" name="add-item-name" placeholder="Enter an item name">
                            </div>
                            <div class="form-group">
                                <label for="add-item-description">Item Description</label>
                                <textarea class="form-control" name="add-item-description" id="add-item-description" rows="3"></textarea> 
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">Add</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>

                </div>
            {!! Form::close() !!}
            </div>
            <!-- /Add New Item -->

            @foreach($items as $item)
            <!-- Edit New Item -->
            <div id="{{ $item->id }}edit-item" class="modal fade" role="dialog">
            {!! Form::open(['url' => 'maintenance/item/update', 'method' => 'post']) !!} 
                <div class="modal-dialog">
            
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Edit Item</h4>
                        </div>
                        <div class="modal-body">
                            <input type="hidden" value="{{ $item->id }}" name="edit-item-id">
                            <div class="form-group">
                                <label for="item-name">Stock No.</label>
                                <input type="text" class="form-control" id="edit-stock-no" name="edit-stock-no" placeholder="Enter a stock number" value="{{ $item->stock_no }}">
                            </div>
                            <div class="form-group">
                                <label for="item-name">Item Name</label>
                                <input type="text" class="form-control" id="edit-item-name" name="edit-item-name" placeholder="Enter an item name" value="{{ $item->item_name }}">
                            </div>
                            <div class="form-group">
                                <label for="edit-item-description">Item Description</label>
                                <textarea class="form-control" name="edit-item-description" id="edit-item-description" rows="3">{{ $item->item_description }}</textarea> 
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">Edit</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>

                </div>
            {!! Form::close() !!}
            </div>
            <!-- /Edit New Item -->

            <!-- Delete New Item -->
            <div id="{{ $item->id }}del-item" class="modal fade" role="dialog">
            {!! Form::open(['url' => 'maintenance/item/destroy', 'method' => 'post']) !!} 
                <div class="modal-dialog">
            
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Delete Item</h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <input type="hidden" value="{{ $item->id }}" name="del-item-id">
                                Are you sure you want to delete <label for="item-name">{{ $item->item_name }}?</label>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">Delete</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>

                </div>
            {!! Form::close() !!}
            </div>
            <!-- /Delete New Item -->

            <!-- View Stock Card -->
            <div id="{{ $item->id }}view-stock-card" class="modal fade" role="dialog">
            {!! Form::open(['url' => 'maintenance/item', 'method' => 'post']) !!} 
                <div class="modal-dialog  modal-lg">
            
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">View Stock Card</h4>
                        </div>
                        <div class="modal-body">
                        <div class="row">   
                            <div class="col-lg-12">
                        
                              <div class="panel-body">
                                    <div class="form-group" style="width: 100%">   
                                        <div class="form-group" style="width: 45%; float: left">
                                            <div class="form-group" style="width: 100%; float: left">
                                                <label for="" style="width: 30%; float: left">Stock Number:</label>
                                                <input style="width: 70%; float: left" class="form-control" type="text" value="{{ $item->stock_no }}" readonly>                               
                                            </div>

                                            <div style="margin: 10px 0; float: left"></div>

                                            <div class="form-group" style="width: 100%;  float: left">
                                                <label for="" style="width: 30%; float: left">Item Name:</label>
                                                <input style="width: 70%; float: left" class="form-control" type="text" value="{{ $item->item_name }}" readonly>                               
                                            </div>

                                            <div class="form-group" style="width: 100%;  float: left">
                                                <label for="" style="width: 30%; float: left">Quantity:</label>
                                                <input style="width: 70%; float: left" class="form-control" type="text" value="{{ $item->item_quantity }}" readonly>                               
                                            </div>
                                        </div>

                                        <div class="form-group" style="width: 45%; float: right">                          
                                            <div class="form-group" style="width: 100%">
                                                <label for="" style="width: 10%">Description:</label>
                                                <textarea class="form-control" name="add-item-description" id="add-item-description" rows="3" readonly>{{ $item->item_description }}</textarea>                 
                                            </div>
                                        </div>
                                    </div>
                                </div>             
                                
                                <div class="form-group col-lg-12">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Date</th>
                                                <th>Reference</th>
                                                <th>Received Qty</th>
                                                <th>Office</th>
                                                <th>Issued Qty</th>
                                                <th>No. Of Days To Consume</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($stock_cards as $stock_card)
                                                @if($stock_card->item_fk == $item->id)
                                                <tr>    
                                                    <td>{{ $stock_card->date }}</td>
                                                    <td>({{ $stock_card->reference }}) {{ $stock_card->reference_no }}</td>
                                                    <td>{{ $stock_card->received_quantity }}</td>
                                                    <td>{{ $stock_card->office_name }}</td>
                                                    <td>{{ $stock_card->issued_quantity }}</td>
                                                    <td>{{ $stock_card->no_of_days_consume }}</td>
                                                </tr>
                                                @endif
                                            @endforeach
                                           </tbody>
                                        </table>
                                </div>               
                        </div>
                        <!-- /.col-lg-12 -->
                    </div>
  
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">Add</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>

                </div>
            {!! Form::close() !!}
            </div>
            <!-- /View Stock Card -->

            @endforeach

        </div>
        <!-- /#page-wrapper -->



@stop

@section('scripts')

    <script>
    $(document).ready(function() {
        $('#dt-item').DataTable({
            responsive: true
        });
    });
    </script>

@stop