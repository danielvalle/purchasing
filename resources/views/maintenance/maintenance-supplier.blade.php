@extends('layouts.master')

@section('title', 'SLSU - Supplier')

@section('content')


        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Maintenance</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            @if(Session::has('supplier_new_success'))
            <div class="row">
                <div class="col-lg-12">
                    <div class="alert alert-success alert-dismissable">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>{!! session('supplier_new_success') !!}</strong>
                    </div>
                </div>
            </div>
            @endif

            @if(Session::has('supplier_new_fail'))
            <div class="row">
                <div class="col-lg-12">
                    <div class="alert alert-danger alert-dismissable">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>{!! session('supplier_new_fail') !!}</strong>
                    </div>
                </div>
            </div>
            @endif

            @if(Session::has('supplier_edit_success'))
            <div class="row">
                <div class="col-lg-12">
                    <div class="alert alert-success alert-dismissable">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>{!! session('supplier_edit_success') !!}</strong>
                    </div>
                </div>
            </div>
            @endif

            @if(Session::has('supplier_edit_fail'))
            <div class="row">
                <div class="col-lg-12">
                    <div class="alert alert-danger alert-dismissable">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>{!! session('supplier_edit_fail') !!}</strong>
                    </div>
                </div>
            </div>
            @endif
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <span style="font-size: 20px;">Supplier</span> 
                            <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#add-supplier">Add New</button> 
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table" id="dt-supplier">
                                <thead>
                                    <tr>
                                        <th>Supplier Name</th>
                                        <th style="width:10%;">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($suppliers as $supplier)
                                        @if($supplier->is_active == 1)
                                        <tr>
                                            <td>{{ $supplier->supplier_name }}</td>
                                            <td>
                                                <a data-toggle="modal" href="#{{ $supplier->id }}edit-supplier"><span class="glyphicon glyphicon-edit"></span></a>
                                                <a data-toggle="modal" href="#{{ $supplier->id }}del-supplier"><span class="glyphicon glyphicon-trash"></span></a>
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
            
            <!-- Add New Supplier -->
            <div id="add-supplier" class="modal fade" role="dialog">
            {!! Form::open(['url' => 'maintenance/supplier', 'method' => 'post']) !!} 
                <div class="modal-dialog">
            
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Add New Supplier</h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="supplier-name">Supplier Name</label>
                                <input required type="text" class="form-control" id="add-supplier-name" name="add-supplier-name" placeholder="Enter an supplier name">
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
            <!-- /Add New Supplier -->
            
            @foreach($suppliers as $supplier)
            <!-- Edit New Supplier -->
            <div id="{{ $supplier->id }}edit-supplier" class="modal fade" role="dialog">
            {!! Form::open(['url' => 'maintenance/supplier/update', 'method' => 'post']) !!} 
                <div class="modal-dialog">
            
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Edit Supplier</h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="supplier-name">Supplier Name</label>
                                <input type="hidden" value="{{ $supplier->id }}" name="edit-supplier-id">
                                <input required type="text" class="form-control" id="edit-supplier-name" name="edit-supplier-name" placeholder="Enter an supplier name" value="{{ $supplier->supplier_name }}">
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
            <!-- /Edit New Supplier -->

            <!-- Delete New Supplier -->
            <div id="{{ $supplier->id }}del-supplier" class="modal fade" role="dialog">
            {!! Form::open(['url' => 'maintenance/supplier/destroy', 'method' => 'post']) !!} 
                <div class="modal-dialog">
            
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Delete Supplier</h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <input type="hidden" value="{{ $supplier->id }}" name="del-supplier-id">
                                Are you sure you want to delete <label for="supplier-name">{{ $supplier->supplier_name }}?</label>
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
            <!-- /Delete New Supplier -->


            @endforeach


        </div>
        <!-- /#page-wrapper -->



@stop

@section('scripts')

    <script>
    $(document).ready(function() {
        $('#dt-supplier').DataTable({
            responsive: true
        });
    });
    </script>

@stop