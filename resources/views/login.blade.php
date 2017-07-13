<!DOCTYPE html>
<html lang="en">

<head>
		<title>Southern Leyte State University</title>
        <link rel="shortcut icon" href="{{ asset('slsulogo.png') }}">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <meta name="_token" content="{!! csrf_token() !!}"/>

		{!! Html::style('css/bootstrap.min.css') !!}
        {!! Html::style('css/metisMenu.min.css') !!}
        {!! Html::style('css/dataTables.bootstrap.css') !!}
        {!! Html::style('css/dataTables.responsive.css') !!}
        {!! Html::style('css/sb-admin-2.css') !!}
        {!! Html::style('css/font-awesome.css') !!}
        {!! Html::style('css/jquery.datetimepicker.css') !!}
        {!! Html::style('css/global.css') !!}

</head>

<body>

    <div class="container">

        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Please Sign In</h3>
                    </div>
                    <div class="panel-body">
                        {!! Form::open(['url' => 'login', 'method' => 'post']) !!}
                            <fieldset>
                                @if (count($errors->register) > 0)
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->register->all() as $error)
                                                <P>{{ $error }}</p>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                @if (Session::has('login_error'))
                                    <div class="alert alert-danger">
                                        <strong>{!! session('login_error') !!}</strong>
                                    </div>
                                @endif
                                <div class="form-group">
                                    <label for="email">E-mail</label>
                                    <input required value="{{ old('email') }}" class="form-control" placeholder="E-mail" name="email" type="email" autofocus>
                                </div>
                                <div class="form-group">

                                    <label for="email">Password</label>
                                    <input required class="form-control" placeholder="Password" name="password" type="password" value="">
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                <button type="submit" class="btn btn-md btn-success btn-block">Login</button>
                                <a href="#add-user" data-toggle="modal" class="btn btn-md btn-primary btn-block">Register</a>
                            </fieldset>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
        <!-- Add New User -->
            <div id="add-user" class="modal fade" role="dialog">
            {!! Form::open(['url' => '/register', 'method' => 'post']) !!} 
                <div class="modal-dialog modal-lg">
            
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Add New User</h4>
                        </div>
                        <div class="modal-body container-fluid">
                            <div class="col-lg-12">
                                @if (Session::has('register_success'))
                                    <div class="alert alert-success">
                                        <strong>{!! session('register_success') !!}</strong>
                                    </div>
                                @endif
                                @if (Session::has('register_fail'))
                                    <div class="alert alert-danger">
                                        <strong>{!! session('register_fail') !!}</strong>
                                    </div>
                                @endif
                                <div class="form-group col-lg-4">
                                    <label for="add-first-name">First Name</label>         
                                    <input value="{{ old('add-first-name') }}" type="text" class="form-control" id="add-first-name" name="add-first-name" placeholder="Juan" required>
                                </div>
                                <div class="form-group col-lg-3">
                                    <label for="add-middle-name">Middle Name</label>         
                                    <input value="{{ old('add-middle-name') }}" type="text" class="form-control" id="add-middle-name" name="add-middle-name" placeholder="Rivera">
                                </div>
                                <div class="form-group col-lg-3">
                                    <label for="add-last-name" >Last Name</label>         
                                    <input value="{{ old('add-last-name') }}" type="text" class="form-control" id="add-last-name" name="add-last-name" placeholder="Dela Cruz" required>
                                </div>
                                <div class="form-group col-lg-2">
                                    <label for="add-suffix" >Suffix</label>         
                                    <input value="{{ old('add-suffix') }}" type="text" class="form-control" id="add-suffix" name="add-suffix" placeholder="Jr.">
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
                                    <input value="{{ old('add-email') }}" type="email" class="form-control" id="add-email" name="add-email" placeholder="juandelacruz@gmail.com" required>
                                </div>
                                <div class="form-group col-lg-3">
                                    <label for="add-birthday" >Birthday</label>         
                                    <input type="date" class="form-control" id="add-birthday" name="add-birthday" @if(Session::has('register_fail')) value="{{ old('add-birthday') }}" else value="{{ date("Y-m-d") }}" @endif required>
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
                                        <option @if(old('add-agency') == $agency->id) selected @endif value="{{ $agency->id }}">{{ $agency->agency_name }}</option>
                                    @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-lg-5">
                                    <label for="add-designation" >Designation</label> 
                                    <select class="form-control" id="add-designation" name="add-designation">
                                    @foreach($designations as $designation)
                                        <option @if(old('add-designation') == $designation->id) selected @endif value="{{ $designation->id }}">{{ $designation->designation_name }}</option>
                                    @endforeach
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
    </div>

        {!! Html::script('js/jquery.js') !!}
        {!! Html::script('js/bootstrap.js') !!}
        {!! Html::script('js/metisMenu.js') !!}
        {!! Html::script('js/jquery.dataTables.js') !!}
        {!! Html::script('js/dataTables.bootstrap.js') !!}
        {!! Html::script('js/dataTables.responsive.js') !!}
        {!! Html::script('js/sb-admin-2.js') !!}
        {!! Html::script('js/jquery.datetimepicker.full.min.js') !!}

        @if(Session::has('register_success') || Session::has('register_fail'))
            <script>
                $(document).ready(function(){
                    $('#add-user').modal('show');
                });
            </script>   
        @endif 

</body>

</html>
