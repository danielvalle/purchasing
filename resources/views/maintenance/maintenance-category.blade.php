@extends('layouts.master')

@section('content')


        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Maintenance</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            @if(Session::has('category_new_success'))
            <div class="row">
                <div class="col-lg-12">
                    <div class="alert alert-success alert-dismissable">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>{!! session('category_new_success') !!}</strong>
                    </div>
                </div>
            </div>
            @endif

            @if(Session::has('category_new_fail'))
            <div class="row">
                <div class="col-lg-12">
                    <div class="alert alert-danger alert-dismissable">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>{!! session('category_new_fail') !!}</strong>
                    </div>
                </div>
            </div>
            @endif

            @if(Session::has('category_edit_success'))
            <div class="row">
                <div class="col-lg-12">
                    <div class="alert alert-success alert-dismissable">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>{!! session('category_edit_success') !!}</strong>
                    </div>
                </div>
            </div>
            @endif

            @if(Session::has('category_edit_fail'))
            <div class="row">
                <div class="col-lg-12">
                    <div class="alert alert-danger alert-dismissable">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>{!! session('category_edit_fail') !!}</strong>
                    </div>
                </div>
            </div>
            @endif
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <span style="font-size: 20px;">Category</span> 
                            <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#add-category">Add New</button> 
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table" id="dt-category">
                                <thead>
                                    <tr>
                                        <th>Category Name</th>
                                        <th style="width:10%;">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($categories as $category)
                                        @if($category->is_active == 1)
                                        <tr>
                                            <td>{{ $category->category_name }}</td>
                                            <td>
                                                <a data-toggle="modal" href="#{{ $category->id }}edit-category"><span class="glyphicon glyphicon-edit"></span></a>
                                                <a data-toggle="modal" href="#{{ $category->id }}del-category"><span class="glyphicon glyphicon-trash"></span></a>
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
            
            <!-- Add New Category -->
            <div id="add-category" class="modal fade" role="dialog">
            {!! Form::open(['url' => 'maintenance/category', 'method' => 'post']) !!} 
                <div class="modal-dialog">
            
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Add New Category</h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="category-name">Category Name</label>
                                <input type="text" class="form-control" id="add-category-name" name="add-category-name" placeholder="Enter an category name" required>
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
            <!-- /Add New Category -->
            
            @foreach($categories as $category)
            <!-- Edit New Category -->
            <div id="{{ $category->id }}edit-category" class="modal fade" role="dialog">
            {!! Form::open(['url' => 'maintenance/category/update', 'method' => 'post']) !!} 
                <div class="modal-dialog">
            
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Edit Category</h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="category-name">Category Name</label>
                                <input type="hidden" value="{{ $category->id }}" name="edit-category-id">
                                <input type="text" class="form-control" id="edit-category-name" name="edit-category-name" placeholder="Enter an category name" value="{{ $category->category_name }}" required>
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
            <!-- /Edit New Category -->

            <!-- Delete New Category -->
            <div id="{{ $category->id }}del-category" class="modal fade" role="dialog">
            {!! Form::open(['url' => 'maintenance/category/destroy', 'method' => 'post']) !!} 
                <div class="modal-dialog">
            
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Delete Category</h4>
                        </div>
                        <div class="modal-body container-fluid">
                            <div class="form-group">
                                <input type="hidden" value="{{ $category->id }}" name="del-category-id">
                                Are you sure you want to delete <label for="category-name">{{ $category->category_name }}?</label>
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
            <!-- /Delete New Category -->


            @endforeach


        </div>
        <!-- /#page-wrapper -->



@stop

@section('scripts')

    <script>
    $(document).ready(function() {
        $('#dt-category').DataTable({
            responsive: true
        });
    });
    </script>

@stop