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
                            <span style="font-size: 20px;">Office</span> 
                            <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#add-office">Add New</button> 
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table" id="dt-office">
                                <thead>
                                    <tr>
                                        <th style="width:10%;">ID</th>
                                        <th>Office Name</th>
                                        <th style="width:10%;">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($offices as $office)
                                        @if($office->is_active == 1)
                                        <tr>
                                            <td>{{ $office->id }}</td>
                                            <td>{{ $office->office_name }}</td>
                                            <td>
                                                <a style="color:green" data-toggle="modal" href="#{{ $office->id }}edit-office"><span class="glyphicon glyphicon-edit"></span></a>
                                                <a style="color:red" data-toggle="modal" href="#{{ $office->id }}del-office"><span class="glyphicon glyphicon-trash"></span></a>
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
            
            <!-- Add New Office -->
            <div id="add-office" class="modal fade" role="dialog">
            {!! Form::open(['url' => 'maintenance/office', 'method' => 'post']) !!} 
                <div class="modal-dialog">
            
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Add New Office</h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="office-name">Office Name</label>
                                <input type="text" class="form-control" id="add-office-name" name="add-office-name" placeholder="Enter an office name">
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
            <!-- /Add New Office -->
            
            @foreach($offices as $office)
            <!-- Edit New Office -->
            <div id="{{ $office->id }}edit-office" class="modal fade" role="dialog">
            {!! Form::open(['url' => 'maintenance/office/update', 'method' => 'post']) !!} 
                <div class="modal-dialog">
            
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Edit Office</h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="office-name">Office Name</label>
                                <input type="hidden" value="{{ $office->id }}" name="edit-office-id">
                                <input type="text" class="form-control" id="edit-office-name" name="edit-office-name" placeholder="Enter an office name" value="{{ $office->office_name }}">
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
            <!-- /Edit New Office -->

            <!-- Delete New Office -->
            <div id="{{ $office->id }}del-office" class="modal fade" role="dialog">
            {!! Form::open(['url' => 'maintenance/office/destroy', 'method' => 'post']) !!} 
                <div class="modal-dialog">
            
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Delete Office</h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <input type="hidden" value="{{ $office->id }}" name="del-office-id">
                                Are you sure you want to delete <label for="office-name">{{ $office->office_name }}?</label>
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
            <!-- /Delete New Office -->


            @endforeach


        </div>
        <!-- /#page-wrapper -->



@stop

@section('scripts')

    <script>
    $(document).ready(function() {
        $('#dt-office').DataTable({
            responsive: true
        });
    });
    </script>

@stop