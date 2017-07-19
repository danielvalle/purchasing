<!DOCTYPE HTML>
<html>
	<head>
        <title>@yield('title')</title>
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
        {!! Html::style('css/bootstrap-select.css') !!}
        {!! Html::style('css/global.css') !!}

	</head>

	<body>
		
    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                </button>
                <a class="navbar-brand">Southern Leyte State University</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">Maintenance</a>
                    <ul class="dropdown-menu dropdown-messages">
                        <li><a href="{{URL::to('maintenance/entity')}}"><strong>Entity</strong></a></li>
                        <li class="divider"></li>

                        <li><a href="{{URL::to('maintenance/category')}}"><strong>Category</strong></a></li>
                        <li class="divider"></li>

                        <li><a href="{{URL::to('maintenance/department')}}"><strong>Department</strong></a></li>
                        <li class="divider"></li>

                        <li><a href="{{URL::to('maintenance/designation')}}"><strong>Designation</strong></a></li>
                        <li class="divider"></li>

                        <li><a href="{{URL::to('maintenance/item')}}"><strong>Item</strong></a></li>
                        <li class="divider"></li>

                        <li><a href="{{URL::to('maintenance/office')}}"><strong>Office</strong></a></li>
                        <li class="divider"></li>

                        <li><a href="{{URL::to('maintenance/supplier')}}"><strong>Supplier</strong></a></li>
                        <li class="divider"></li>

                        <li><a href="{{URL::to('maintenance/unit')}}"><strong>Unit</strong></a></li>
                        <li class="divider"></li> 

                        <li><a href="{{URL::to('maintenance/user')}}"><strong>User</strong></a></li>
                    </ul>
                </li>
                    <li class="dropdown">
                        <a class="dropdown-toggle" data-toggle="dropdown" href="#">Transaction</a>
                        <ul class="dropdown-menu dropdown-messages">
                            <li><a href="{{URL::to('transaction/purchase-request')}}"><strong>Purchase Request</strong></a></li>
                        @if(Auth::check())
                            @if(Auth::user()->user_type == 1)
                            <li class="divider"></li>

                            <li><a href="{{URL::to('transaction/request-for-quotation')}}"><strong>Request For Quotation</strong></a></li>
                            <li class="divider"></li>

                            <li><a href="{{URL::to('transaction/abstract-quotation')}}"><strong>Abstract Quotation</strong></a></li>
                            <li class="divider"></li>

                            <li><a href="{{URL::to('transaction/purchase-order')}}"><strong>Purchase Order</strong></a></li>
                            <li class="divider"></li>

                            <li><a href="{{URL::to('transaction/acceptance')}}"><strong>Acceptance</strong></a></li>
                            <li class="divider"></li>

                            <li><a href="{{URL::to('transaction/issuance')}}"><strong>Issuance</strong></a></li>
                            <li class="divider"></li>

                            <li><a href="{{URL::to('transaction/disbursement-voucher')}}"><strong>Disbursement Voucher</strong></a></li>
                            @endif
                        @endif
                        </ul>
                    </li>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">Account</a>
                    <ul class="dropdown-menu dropdown-messages">
                        @if(Auth::check())
                        <li><a data-toggle="modal" data-target="#change-password"><strong>Change Password</strong></a></li>
                        <li class="divider"></li>
                        @endif

                        <li><a href="{{URL::to('logout')}}"><strong>Log Out</strong></a></li>
                    </ul>
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->
        </nav>

            <div id="change-password" class="modal fade" role="dialog">
            {!! Form::open(['url' => '/change-password', 'method' => 'post']) !!} 
                <div class="modal-dialog">
            
                    <!-- Modal content-->
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Change Password</h4>
                        </div>
                        <div class="modal-body">
                            @if (Session::has('new_success'))
                                    <div class="alert alert-success">
                                        <strong>{!! session('new_success') !!}</strong>
                                    </div>
                            @endif
                            @if (Session::has('confirm_error'))
                                    <div class="alert alert-warning">
                                        <strong>{!! session('confirm_error') !!}</strong>
                                    </div>
                            @endif
                            @if (Session::has('old_error'))
                                    <div class="alert alert-danger">
                                        <strong>{!! session('old_error') !!}</strong>
                                    </div>
                            @endif
                            <div class="form-group">
                                <label for="agency-name">Input Old Password</label>
                                <input required type="password" class="form-control" id="old-password" name="old-password" placeholder="Old Password">
                            </div>
                            <div class="form-group">
                                <label for="agency-name">Input New Password</label>
                                <input required type="password" class="form-control" id="new-password" name="new-password" placeholder="New Password">
                            </div>
                            <div class="form-group">
                                <label for="agency-name">Confirm New Password</label>
                                <input required type="password" class="form-control" id="confirm-password" name="confirm-password" placeholder="Confirm Password">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success">Save</button>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                        </div>
                    </div>

                </div>
            {!! Form::close() !!}
            </div>

    </div>


    <main>
        @yield('content')
    </main>

    <!-- SCRIPTS -->        

        {!! Html::script('js/jquery.js') !!}
        {!! Html::script('js/bootstrap.js') !!}
        {!! Html::script('js/metisMenu.js') !!}
        {!! Html::script('js/jquery.dataTables.js') !!}
        {!! Html::script('js/dataTables.bootstrap.js') !!}
        {!! Html::script('js/dataTables.responsive.js') !!}
        {!! Html::script('js/sb-admin-2.js') !!}
        {!! Html::script('js/jquery.datetimepicker.full.min.js') !!}
        {!! Html::script('js/bootstrap-select.js') !!}
        
        @if(Session::has('change_pw'))
            <script>
                $(document).ready(function(){
                    $('#change-password').modal('show');
                });
            </script>   
        @endif 

    @yield('scripts')

	</body>
</html>