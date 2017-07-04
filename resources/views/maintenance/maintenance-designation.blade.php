@extends('layouts.master')

@section('content')


        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Maintenance</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            @if(Session::has('designation_new_success'))
            <div class="row">
                <div class="col-lg-12">
                    <div class="alert alert-success alert-dismissable">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>{!! session('designation_new_success') !!}</strong>
                    </div>
                </div>
            </div>
            @endif

            @if(Session::has('designation_new_fail'))
            <div class="row">
                <div class="col-lg-12">
                    <div class="alert alert-danger alert-dismissable">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>{!! session('designation_new_fail') !!}</strong>
                    </div>
                </div>
            </div>
            @endif

            @if(Session::has('designation_edit_success'))
            <div class="row">
                <div class="col-lg-12">
                    <div class="alert alert-success alert-dismissable">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>{!! session('designation_edit_success') !!}</strong>
                    </div>
                </div>
            </div>
            @endif

            @if(Session::has('designation_edit_fail'))
            <div class="row">
                <div class="col-lg-12">
                    <div class="alert alert-danger alert-dismissable">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>{!! session('designation_edit_fail') !!}</strong>
                    </div>
                </div>
            </div>
            @endif
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <span style="font-size: 20px;">Designation</span> 
                            <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#add-designation">Add New</button> 
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table" id="dt-designation">
                                <thead>
                                    <tr>
                                        <th>Designation Name</th>
                                        <th style="width:10%;">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($designations as $designation)
                                        @if($designation->is_active == 1)
                                        <tr>
                                            <td>{{ $designation->designation_name }}</td>
                                            <td>
                                                <a data-toggle="modal" href="#{{ $designation->id }}edit-designation"><span class="glyphicon glyphicon-edit"></span></a>
                                                <a data-toggle="modal" href="#{{ $designation->id }}del-designation"><span class="glyphicon glyphicon-trash"></span></a>
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
            
            <!-- Add New Designation -->
            <div id="add-designation" class="modal fade" role="dialog">
            {!! Form::open(['url' => 'maintenance/designation', 'method' => 'post']) !!} 
                <div class="modal-dialog">
            
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Add New Designation</h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="designation-name">Designation Name</label>
                                <input required type="text" class="form-control" id="add-designation-name" name="add-designation-name" placeholder="Enter an designation name">
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
            <!-- /Add New Designation -->
            
            @foreach($designations as $designation)
            <!-- Edit New Designation -->
            <div id="{{ $designation->id }}edit-designation" class="modal fade" role="dialog">
            {!! Form::open(['url' => 'maintenance/designation/update', 'method' => 'post']) !!} 
                <div class="modal-dialog">
            
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Edit Designation</h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="designation-name">Designation Name</label>
                                <input type="hidden" value="{{ $designation->id }}" name="edit-designation-id">
                                <input required type="text" class="form-control" id="edit-designation-name" name="edit-designation-name" placeholder="Enter an designation name" value="{{ $designation->designation_name }}">
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
            <!-- /Edit New Designation -->

            <!-- Delete New Designation -->
            <div id="{{ $designation->id }}del-designation" class="modal fade" role="dialog">
            {!! Form::open(['url' => 'maintenance/designation/destroy', 'method' => 'post']) !!} 
                <div class="modal-dialog">
            
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Delete Designation</h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <input type="hidden" value="{{ $designation->id }}" name="del-designation-id">
                                Are you sure you want to delete <label for="designation-name">{{ $designation->designation_name }}?</label>
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
            <!-- /Delete New Designation -->


            @endforeach


        </div>
        <!-- /#page-wrapper -->



@stop

@section('scripts')

    <script>
    $(document).ready(function() {
        $('#dt-designation').DataTable({
            responsive: true
        });
    });
    </script>

@stop