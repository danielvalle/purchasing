@extends('layouts.master')

@section('title', 'SLSU - Entity')

@section('content')

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Maintenance</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            @if(Session::has('entity_new_success'))
            <div class="row">
                <div class="col-lg-12">
                    <div class="alert alert-success alert-dismissable">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>{!! session('entity_new_success') !!}</strong>
                    </div>
                </div>
            </div>
            @endif

            @if(Session::has('entity_new_fail'))
            <div class="row">
                <div class="col-lg-12">
                    <div class="alert alert-danger alert-dismissable">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>{!! session('entity_new_fail') !!}</strong>
                    </div>
                </div>
            </div>
            @endif

            @if(Session::has('entity_edit_success'))
            <div class="row">
                <div class="col-lg-12">
                    <div class="alert alert-success alert-dismissable">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>{!! session('entity_edit_success') !!}</strong>
                    </div>
                </div>
            </div>
            @endif

            @if(Session::has('entity_edit_fail'))
            <div class="row">
                <div class="col-lg-12">
                    <div class="alert alert-danger alert-dismissable">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>{!! session('entity_edit_fail') !!}</strong>
                    </div>
                </div>
            </div>
            @endif
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <span style="font-size: 20px;">Entity</span> 
                            <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#add-entity">Add New</button> 
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table" id="dt-entity">
                                <thead>
                                    <tr>
                                        <th>Entity Name</th>
                                        <th style="width:10%;">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($entities as $entity)
                                        @if($entity->is_active == 1)
                                        <tr>
                                            <td>{{ $entity->entity_name }}</td>
                                            <td>
                                                <a data-toggle="modal" href="#{{ $entity->id }}edit-entity"><span class="glyphicon glyphicon-edit"></span></a>
                                                <a data-toggle="modal" href="#{{ $entity->id }}del-entity"><span class="glyphicon glyphicon-trash"></span></a>
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
            
            <!-- Add New Entity -->
            <div id="add-entity" class="modal fade" role="dialog">
            {!! Form::open(['url' => 'maintenance/entity', 'method' => 'post']) !!} 
                <div class="modal-dialog">
            
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Add New Entity</h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="entity-name">Entity Name</label>
                                <input required type="text" class="form-control" id="add-entity-name" name="add-entity-name" placeholder="Enter an entity name">
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
            <!-- /Add New Entity -->
            
            @foreach($entities as $entity)
            <!-- Edit New Entity -->
            <div id="{{ $entity->id }}edit-entity" class="modal fade" role="dialog">
            {!! Form::open(['url' => 'maintenance/entity/update', 'method' => 'post']) !!} 
                <div class="modal-dialog">
            
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Edit Entity</h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="entity-name">Entity Name</label>
                                <input type="hidden" value="{{ $entity->id }}" name="edit-entity-id">
                                <input required type="text" class="form-control" id="edit-entity-name" name="edit-entity-name" placeholder="Enter an entity name" value="{{ $entity->entity_name }}">
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
            <!-- /Edit New Entity -->

            <!-- Delete New Entity -->
            <div id="{{ $entity->id }}del-entity" class="modal fade" role="dialog">
            {!! Form::open(['url' => 'maintenance/entity/destroy', 'method' => 'post']) !!} 
                <div class="modal-dialog">
            
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Delete Entity</h4>
                        </div>
                        <div class="modal-body container-fluid">
                            <div class="form-group">
                                <input type="hidden" value="{{ $entity->id }}" name="del-entity-id">
                                Are you sure you want to delete <label for="entity-name">{{ $entity->entity_name }}?</label>
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
            <!-- /Delete New Entity -->


            @endforeach


        </div>
        <!-- /#page-wrapper -->



@stop

@section('scripts')

    <script>
    $(document).ready(function() {
        $('#dt-entity').DataTable({
            responsive: true
        });
    });
    </script>

@stop