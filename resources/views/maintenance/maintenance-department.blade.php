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
                            <span style="font-size: 20px;">Department</span> 
                            <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#add-department">Add New</button> 
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table" id="dt-department">
                                <thead>
                                    <tr>
                                        <th style="width:10%;">ID</th>
                                        <th>Department Name</th>
                                        <th style="width:10%;">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($departments as $department)
                                        @if($department->is_active == 1)
                                        <tr>
                                            <td>{{ $department->id }}</td>
                                            <td>{{ $department->department_name }}</td>
                                            <td>
                                                <a style="color:green" data-toggle="modal" href="#{{ $department->id }}edit-department"><span class="glyphicon glyphicon-edit"></span></a>
                                                <a style="color:red" data-toggle="modal" href="#{{ $department->id }}del-department"><span class="glyphicon glyphicon-trash"></span></a>
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
            
            <!-- Add New Department -->
            <div id="add-department" class="modal fade" role="dialog">
            {!! Form::open(['url' => 'maintenance/department', 'method' => 'post']) !!} 
                <div class="modal-dialog">
            
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Add New Department</h4>
                        </div>
                        <div class="modal-body  container-fluid">
                            <div class="form-group">
                                <label for="department-name">Department Name</label>
                                <input type="text" class="form-control" id="add-department-name" name="add-department-name" placeholder="Enter an department name">
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
            <!-- /Add New Department -->
            
            @foreach($departments as $department)
            <!-- Edit New Department -->
            <div id="{{ $department->id }}edit-department" class="modal fade" role="dialog">
            {!! Form::open(['url' => 'maintenance/department/update', 'method' => 'post']) !!} 
                <div class="modal-dialog">
            
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Edit Department</h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="department-name">Department Name</label>
                                <input type="hidden" value="{{ $department->id }}" name="edit-department-id">
                                <input type="text" class="form-control" id="edit-department-name" name="edit-department-name" placeholder="Enter an department name" value="{{ $department->department_name }}">
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
            <!-- /Edit New Department -->

            <!-- Delete New Department -->
            <div id="{{ $department->id }}del-department" class="modal fade" role="dialog">
            {!! Form::open(['url' => 'maintenance/department/destroy', 'method' => 'post']) !!} 
                <div class="modal-dialog">
            
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Delete Department</h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <input type="hidden" value="{{ $department->id }}" name="del-department-id">
                                Are you sure you want to delete <label for="department-name">{{ $department->department_name }}?</label>
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
            <!-- /Delete New Department -->


            @endforeach


        </div>
        <!-- /#page-wrapper -->



@stop

@section('scripts')

    <script>
    $(document).ready(function() {
        $('#dt-department').DataTable({
            responsive: true
        });
    });
    </script>

@stop