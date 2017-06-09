@extends('layouts.master')

@section('content')


        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Maintenance</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>

            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <span style="font-size: 20px;">Unit</span> 
                            <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#add-unit">Add New</button> 
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table" id="dt-unit">
                                <thead>
                                    <tr>
                                        <th style="width:10%;">ID</th>
                                        <th>Unit Name</th>
                                        <th style="width:10%;">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($units as $unit)
                                        @if($unit->is_active == 1)
                                        <tr>
                                            <td>{{ $unit->id }}</td>
                                            <td>{{ $unit->unit_name }}</td>
                                            <td>
                                                <a style="color:green" data-toggle="modal" href="#{{ $unit->id }}edit-unit"><span class="glyphicon glyphicon-edit"></span></a>
                                                <a style="color:red" data-toggle="modal" href="#{{ $unit->id }}del-unit"><span class="glyphicon glyphicon-trash"></span></a>
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
            
            <!-- Add New Unit -->
            <div id="add-unit" class="modal fade" role="dialog">
            {!! Form::open(['url' => 'maintenance/unit', 'method' => 'post']) !!} 
                <div class="modal-dialog">
            
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Add New Unit</h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="unit-name">Unit Name</label>
                                <input type="text" class="form-control" id="add-unit-name" name="add-unit-name" placeholder="Enter an unit name">
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
            <!-- /Add New Unit -->
            
            @foreach($units as $unit)
            <!-- Edit New Unit -->
            <div id="{{ $unit->id }}edit-unit" class="modal fade" role="dialog">
            {!! Form::open(['url' => 'maintenance/unit/update', 'method' => 'post']) !!} 
                <div class="modal-dialog">
            
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Edit Unit</h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="unit-name">Unit Name</label>
                                <input type="hidden" value="{{ $unit->id }}" name="edit-unit-id">
                                <input type="text" class="form-control" id="edit-unit-name" name="edit-unit-name" placeholder="Enter an unit name" value="{{ $unit->unit_name }}">
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
            <!-- /Edit New Unit -->

            <!-- Delete New Unit -->
            <div id="{{ $unit->id }}del-unit" class="modal fade" role="dialog">
            {!! Form::open(['url' => 'maintenance/unit/destroy', 'method' => 'post']) !!} 
                <div class="modal-dialog">
            
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Delete Unit</h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <input type="hidden" value="{{ $unit->id }}" name="del-unit-id">
                                Are you sure you want to delete <label for="unit-name">{{ $unit->unit_name }}?</label>
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
            <!-- /Delete New Unit -->


            @endforeach


        </div>
        <!-- /#page-wrapper -->



@stop

@section('scripts')

    <script>
    $(document).ready(function() {
        $('#dt-unit').DataTable({
            responsive: true
        });
    });
    </script>

@stop