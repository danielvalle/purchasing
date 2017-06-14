<!DOCTYPE HTML>
<html>
	<head>
		<title>Purchasing</title>
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
        <!--<meta name="_token" content="{!! csrf_token() !!}"/>-->

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
                <a class="navbar-brand" href="index.html">Purchasing</a>
            </div>
            <!-- /.navbar-header -->

            <ul class="nav navbar-top-links navbar-right">
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">Maintenance</a>
                    <ul class="dropdown-menu dropdown-messages">
                        <li><a href="{{URL::to('maintenance/agency')}}"><strong>Agency</strong></a></li>
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

                        <li><a href="{{URL::to('maintenance/section')}}"><strong>Section</strong></a></li>
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
                    </ul>
                </li>
                <!-- /.dropdown -->
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">Account</a>
                    <ul class="dropdown-menu dropdown-user">
                        <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
                        <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                        </li>
                        <li class="divider"></li>
                        <li><a href="login.html"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            </ul>
            <!-- /.navbar-top-links -->
        </nav>

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

    @yield('scripts')

	</body>
</html>