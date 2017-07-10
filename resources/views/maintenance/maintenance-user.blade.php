@extends('layouts.master')

@section('content')


        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">Maintenance</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            @if(Session::has('user_new_success'))
            <div class="row">
                <div class="col-lg-12">
                    <div class="alert alert-success alert-dismissable">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>{!! session('user_new_success') !!}</strong>
                    </div>
                </div>
            </div>
            @endif

            @if(Session::has('user_new_fail'))
            <div class="row">
                <div class="col-lg-12">
                    <div class="alert alert-danger alert-dismissable">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>{!! session('user_new_fail') !!}</strong>
                    </div>
                </div>
            </div>
            @endif

            @if(Session::has('user_edit_success'))
            <div class="row">
                <div class="col-lg-12">
                    <div class="alert alert-success alert-dismissable">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>{!! session('user_edit_success') !!}</strong>
                    </div>
                </div>
            </div>
            @endif

            @if(Session::has('user_edit_fail'))
            <div class="row">
                <div class="col-lg-12">
                    <div class="alert alert-danger alert-dismissable">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>{!! session('user_edit_fail') !!}</strong>
                    </div>
                </div>
            </div>
            @endif
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <span style="font-size: 20px;">User</span> 
                            <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#add-user">Add New</button> 
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table" id="dt-user">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Sex</th>
                                        <th>E-mail</th>
                                        <th>Birthday</th>
                                        <th>Agency</th>
                                        <th>Designation</th>
                                        <th style="width:10%;">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($users as $user)
                                        @if($user->is_active == 1)
                                        <tr>
                                            <td>{{ $user->first_name }} {{ $user->middle_name }} {{ $user->last_name }} {{ $user->suffix }}</td>
                                            <td>
                                                @if( $user->sex == "M" )Male
                                                @elseif( $user->sex == "F" )Female @endif
                                            </td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->birthday }}</td>
                                            <td>{{ $user->agency_name }}</td>
                                            <td>{{ $user->designation_name }}</td>
                                            <td>
                                                <a data-toggle="modal" href="#{{ $user->id }}edit-user"><span class="glyphicon glyphicon-edit"></span></a>
                                                <a data-toggle="modal" href="#{{ $user->id }}del-user"><span class="glyphicon glyphicon-trash"></span></a>
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
            
            <!-- Add New User -->
            <div id="add-user" class="modal fade" role="dialog">
            {!! Form::open(['url' => 'maintenance/user', 'method' => 'post']) !!} 
                <div class="modal-dialog modal-lg">
            
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Add New User</h4>
                        </div>
                        <div class="modal-body container-fluid">
                            <div class="col-lg-12">
                                <div class="form-group col-lg-4">
                                    <label for="add-first-name">First Name</label>         
                                    <input type="text" class="form-control" id="add-first-name" name="add-first-name" placeholder="Juan" required>
                                </div>
                                <div class="form-group col-lg-3">
                                    <label for="add-middle-name">Middle Name</label>         
                                    <input type="text" class="form-control" id="add-middle-name" name="add-middle-name" placeholder="Rivera">
                                </div>
                                <div class="form-group col-lg-3">
                                    <label for="add-last-name" >Last Name</label>         
                                    <input type="text" class="form-control" id="add-last-name" name="add-last-name" placeholder="Dela Cruz" required>
                                </div>
                                <div class="form-group col-lg-2">
                                    <label for="add-suffix" >Suffix</label>         
                                    <input type="text" class="form-control" id="add-suffix" name="add-suffix" placeholder="Jr.">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group col-lg-2">
                                    <label for="add-first-sex" >Sex</label>         
                                    <select class="form-control" id="add-sex" name="add-sex">
                                        <option value="M">Male</option>
                                        <option value="F">Female</option>
                                    </select>
                                </div>
                                <div class="form-group col-lg-4">
                                    <label for="add-email" >E-mail</label>         
                                    <input type="email" class="form-control" id="add-email" name="add-email" placeholder="juandelacruz@gmail.com" required>
                                </div>
                                <div class="form-group col-lg-3">
                                    <label for="add-birthday" >Birthday</label>         
                                    <input type="date" class="form-control" id="add-birthday" name="add-birthday" value="{{ date("Y-m-d") }}" required>
                                </div>
                                <div class="form-group col-lg-3">
                                    <label for="add-password" >Password</label>         
                                    <input type="password" class="form-control" id="add-password" name="add-password"  required>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group col-lg-5">
                                    <label for="add-agency" >Agency</label>         
                                    <select class="form-control" id="add-agency" name="add-agency">
                                    @foreach($agencies as $agency)
                                        <option value="{{ $agency->id }}">{{ $agency->agency_name }}</option>
                                    @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-lg-5">
                                    <label for="add-designation" >Designation</label> 
                                    <select class="form-control" id="add-designation" name="add-designation">
                                    @foreach($designations as $designation)
                                        <option value="{{ $designation->id }}">{{ $designation->designation_name }}</option>
                                    @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-lg-2">
                                    <label for="add-type" >User Type</label>         
                                    <select class="form-control" id="add-type" name="add-type">
                                        <option value="1">Admin</option>
                                        <option value="0">User</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">Add</button>
                            <button type="reset" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>

                </div>
            {!! Form::close() !!}
            </div>
            <!-- /Add New User -->
            
            @foreach($users as $user)
            <!-- Edit New User -->
            <div id="{{ $user->id }}edit-user" class="modal fade" role="dialog">
            {!! Form::open(['url' => 'maintenance/user/update', 'method' => 'post']) !!} 
                <div class="modal-dialog modal-lg">
            
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Edit User</h4>
                        </div>
                        <div class="modal-body container-fluid">
                            <input type="hidden" id="edit-user-id" name="edit-user-id" value="{{ $user->id }}">
                            <div class="col-lg-12">
                                <div class="form-group col-lg-4">
                                    <label for="edit-first-name">First Name</label>         
                                    <input type="text" class="form-control" id="edit-first-name" name="edit-first-name" placeholder="Juan" value="{{ $user->first_name }}">
                                </div>
                                <div class="form-group col-lg-3">
                                    <label for="edit-middle-name">Middle Name</label>         
                                    <input type="text" class="form-control" id="edit-middle-name" name="edit-middle-name" placeholder="Rivera" value="{{ $user->middle_name }}">
                                </div>
                                <div class="form-group col-lg-3">
                                    <label for="edit-last-name" >Last Name</label>         
                                    <input type="text" class="form-control" id="edit-last-name" name="edit-last-name" placeholder="Dela Cruz" value="{{ $user->last_name }}">
                                </div>
                                <div class="form-group col-lg-2">
                                    <label for="edit-suffix" >Suffix</label>         
                                    <input type="text" class="form-control" id="edit-suffix" name="edit-suffix" placeholder="Jr." value="{{ $user->suffix }}">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group col-lg-3">
                                    <label for="edit-first-sex" >Sex</label>         
                                    <select class="form-control" id="edit-sex" name="edit-sex">
                                        @if($user->sex == "M")
                                            <option value="M" selected>Male</option>
                                            <option value="F">Female</option>
                                        @elseif($user->sex == "F")
                                            <option value="M">Male</option>
                                            <option value="F" selected>Female</option>
                                        @endif
                                    </select>
                                </div>
                                <div class="form-group col-lg-6">
                                    <label for="edit-email" >E-mail</label>         
                                    <input type="email" class="form-control" id="edit-email" name="edit-email" placeholder="juandelacruz@gmail.com" value="{{ $user->email }}">
                                </div>
                                <div class="form-group col-lg-3">
                                    <label for="edit-birthday" >Birthday</label>         
                                    <input type="date" class="form-control" id="edit-birthday" name="edit-birthday" value="{{ $user->birthday }}">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group col-lg-5">
                                    <label for="edit-agency" >Agency</label>         
                                    <select class="form-control" id="edit-agency" name="edit-agency">
                                        @foreach($agencies as $agency)
                                            <option value="{{ $agency->id }}" @if($user->agency_fk == $agency->id) selected @endif>{{ $agency->agency_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-lg-5">
                                    <label for="edit-designation" >Designation</label> 
                                    <select class="form-control" id="edit-designation" name="edit-designation">
                                    @foreach($designations as $designation)
                                        <option value="{{ $designation->id }}" @if($user->designation_fk == $designation->id) selected @endif>{{ $designation->designation_name }}</option>
                                    @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-lg-2">
                                    <label for="edit-type" >User Type</label>         
                                    <select class="form-control" id="edit-type" name="edit-type">
                                        @if($user->user_type == 1)
                                            <option value="1" selected>Admin</option>
                                            <option value="0">User</option>
                                        @else
                                            <option value="1" >Admin</option>
                                            <option value="0" selected>User</option>
                                        @endif
                                    </select>
                                </div>
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
            <!-- /Edit New User -->

            <!-- Delete New User -->
            <div id="{{ $user->id }}del-user" class="modal fade" role="dialog">
            {!! Form::open(['url' => 'maintenance/user/destroy', 'method' => 'post']) !!} 
                <div class="modal-dialog">
            
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Delete User</h4>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <input type="hidden" value="{{ $user->id }}" name="del-user-id">
                                Are you sure you want to delete <label for="user-name">{{ $user->first_name }} {{ $user->middle_name }} {{ $user->last_name }} {{ $user->suffix }}?</label>
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
            <!-- /Delete New User -->


            @endforeach


        </div>
        <!-- /#page-wrapper -->



@stop

@section('scripts')

    <script>
    $(document).ready(function() {
        $('#dt-user').DataTable({
            responsive: true
        });
    });

    </script>

@stop