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
                            <span style="font-size: 20px;">Agency</span> 
                            <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#add-agency">Add New</button> 
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table" id="dt-agency">
                                <thead>
                                    <tr>
                                        <th style="width:10%;">ID</th>
                                        <th>Agency Name</th>
                                        <th>Department</th>
                                        <th style="width:10%;">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($agencies as $agency)
                                        @if($agency->is_active == 1)
                                        <tr>
                                            <td>{{ $agency->id }}</td>
                                            <td>{{ $agency->agency_name }}</td>
                                            <td>{{ $agency->department_name }}</td>
                                            <td>
                                                <a style="color:green" data-toggle="modal" href="#{{ $agency->id }}edit-agency"><span class="glyphicon glyphicon-edit"></span></a>
                                                <a style="color:red" data-toggle="modal" href="#{{ $agency->id }}del-agency"><span class="glyphicon glyphicon-trash"></span></a>
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
            
            <!-- Add New Agency -->
            <div id="add-agency" class="modal fade" role="dialog">
            {!! Form::open(['url' => 'maintenance/agency', 'method' => 'post']) !!} 
                <div class="modal-dialog">
            
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Add New Agency</h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="agency-name">Agency Name</label>
                                <input type="text" class="form-control" id="add-agency-name" name="add-agency-name" placeholder="Enter an agency name">
                            </div>
                            <div class="form-group">   
                                <label for="add-department">Department</label>         
                                    <select class="form-control" id="add-department" name="add-department">
                                        @foreach($departments as $department)
                                            <option value="{{ $department->id }}">{{ $department->department_name }}</option>
                                        @endforeach
                                    </select>
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
            <!-- /Add New Agency -->
            
            @foreach($agencies as $agency)
            <!-- Edit New Agency -->
            <div id="{{ $agency->id }}edit-agency" class="modal fade" role="dialog">
            {!! Form::open(['url' => 'maintenance/agency/update', 'method' => 'post']) !!} 
                <div class="modal-dialog">
            
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Edit Agency</h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="agency-name">Agency Name</label>
                                <input type="hidden" value="{{ $agency->id }}" name="edit-agency-id">
                                <input type="text" class="form-control" id="edit-agency-name" name="edit-agency-name" placeholder="Enter an agency name" value="{{ $agency->agency_name }}">
                            </div>
                            <div class="form-group">   
                                <label for="edit-department">Department</label>         
                                    <select class="form-control" id="edit-department" name="edit-department">
                                        @foreach($departments as $department)
                                            <option value="{{ $department->id }}" @if($agency->department_fk == $department->id) selected @endif>{{ $department->department_name }}</option>
                                        @endforeach
                                    </select>
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
            <!-- /Edit New Agency -->

            <!-- Delete New Agency -->
            <div id="{{ $agency->id }}del-agency" class="modal fade" role="dialog">
            {!! Form::open(['url' => 'maintenance/agency/destroy', 'method' => 'post']) !!} 
                <div class="modal-dialog">
            
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Delete Agency</h4>
                        </div>
                        <div class="modal-body container-fluid">
                            <div class="form-group">
                                <input type="hidden" value="{{ $agency->id }}" name="del-agency-id">
                                Are you sure you want to delete <label for="agency-name">{{ $agency->agency_name }}?</label>
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
            <!-- /Delete New Agency -->


            @endforeach


        </div>
        <!-- /#page-wrapper -->



@stop

@section('scripts')

    <script>
    $(document).ready(function() {
        $('#dt-agency').DataTable({
            responsive: true
        });
    });
    </script>

@stop