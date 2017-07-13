@extends('layouts.master')

@section('title', 'SLSU - Section')

@section('content')


        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Maintenance</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            @if(Session::has('section_new_success'))
            <div class="row">
                <div class="col-lg-12">
                    <div class="alert alert-success alert-dismissable">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>{!! session('section_new_success') !!}</strong>
                    </div>
                </div>
            </div>
            @endif

            @if(Session::has('section_new_fail'))
            <div class="row">
                <div class="col-lg-12">
                    <div class="alert alert-danger alert-dismissable">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>{!! session('section_new_fail') !!}</strong>
                    </div>
                </div>
            </div>
            @endif

            @if(Session::has('section_edit_success'))
            <div class="row">
                <div class="col-lg-12">
                    <div class="alert alert-success alert-dismissable">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>{!! session('section_edit_success') !!}</strong>
                    </div>
                </div>
            </div>
            @endif

            @if(Session::has('section_edit_fail'))
            <div class="row">
                <div class="col-lg-12">
                    <div class="alert alert-danger alert-dismissable">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>{!! session('section_edit_fail') !!}</strong>
                    </div>
                </div>
            </div>
            @endif
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <span style="font-size: 20px;">Section</span> 
                            <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#add-section">Add New</button> 
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table" id="dt-section">
                                <thead>
                                    <tr>
                                        <th>Section Name</th>
                                        <th>Department</th>
                                        <th style="width:10%;">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($sections as $section)
                                        @if($section->is_active == 1)
                                        <tr>
                                            <td>{{ $section->section_name }}</td>
                                            <td>{{ $section->department_name }}</td>
                                            <td>
                                                <a data-toggle="modal" href="#{{ $section->id }}edit-section"><span class="glyphicon glyphicon-edit"></span></a>
                                                <a data-toggle="modal" href="#{{ $section->id }}del-section"><span class="glyphicon glyphicon-trash"></span></a>
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
            
            <!-- Add New Section -->
            <div id="add-section" class="modal fade" role="dialog">
            {!! Form::open(['url' => 'maintenance/section', 'method' => 'post']) !!} 
                <div class="modal-dialog">
            
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Add New Section</h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="section-name">Section Name</label>
                                <input required type="text" class="form-control" id="add-section-name" name="add-section-name" placeholder="Enter an section name">
                            </div>
                            <div class="form-group">
                                <label for="add-section-department">Department</label>
                                <select class="form-control" name="add-section-department" id="add-section-department">
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
            <!-- /Add New Section -->
            
            @foreach($sections as $section)
            <!-- Edit New Section -->
            <div id="{{ $section->id }}edit-section" class="modal fade" role="dialog">
            {!! Form::open(['url' => 'maintenance/section/update', 'method' => 'post']) !!} 
                <div class="modal-dialog">
            
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Edit Section</h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="section-name">Section Name</label>
                                <input type="hidden" value="{{ $section->id }}" name="edit-section-id">
                                <input required type="text" class="form-control" id="edit-section-name" name="edit-section-name" placeholder="Enter an section name" value="{{ $section->section_name }}">
                            </div>
                            <div class="form-group">
                                <label for="edit-section-department">Department</label>
                                <select class="form-control" name="edit-section-department" id="edit-section-department">
                                    @foreach($departments as $department)
                                        <option value="{{ $department->id }}" @if($department->id == $section->department_fk) selected @endif>{{ $department->department_name }}</option>
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
            <!-- /Edit New Section -->

            <!-- Delete New Section -->
            <div id="{{ $section->id }}del-section" class="modal fade" role="dialog">
            {!! Form::open(['url' => 'maintenance/section/destroy', 'method' => 'post']) !!} 
                <div class="modal-dialog">
            
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Delete Section</h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <input type="hidden" value="{{ $section->id }}" name="del-section-id">
                                Are you sure you want to delete <label for="section-name">{{ $section->section_name }}?</label>
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
            <!-- /Delete New Section -->


            @endforeach


        </div>
        <!-- /#page-wrapper -->



@stop

@section('scripts')

    <script>
    $(document).ready(function() {
        $('#dt-section').DataTable({
            responsive: true
        });
    });
    </script>

@stop