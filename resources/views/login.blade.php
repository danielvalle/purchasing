<!DOCTYPE html>
<html lang="en">

<head>

		<title>Purchasing</title>
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
                                <div class="form-group">
                                    <input class="form-control" placeholder="E-mail" name="email" type="email" autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Password" name="password" type="password" value="">
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                <button type="submit" class="btn btn-lg btn-success btn-block">Login</a>
                            </fieldset>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>

        {!! Html::script('js/jquery.js') !!}
        {!! Html::script('js/bootstrap.js') !!}
        {!! Html::script('js/metisMenu.js') !!}
        {!! Html::script('js/jquery.dataTables.js') !!}
        {!! Html::script('js/dataTables.bootstrap.js') !!}
        {!! Html::script('js/dataTables.responsive.js') !!}
        {!! Html::script('js/sb-admin-2.js') !!}
        {!! Html::script('js/jquery.datetimepicker.full.min.js') !!}

</body>

</html>
