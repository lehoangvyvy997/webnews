<!DOCTYPE html>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Login</title>
	<link type="text/css" href="{{ asset('admin_layout/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
	<link type="text/css" href="{{ asset('admin_layout/bootstrap/css/bootstrap-responsive.min.css')}}" rel="stylesheet">
	<link type="text/css" href="{{ asset('admin_layout/css/theme.css')}}" rel="stylesheet">
	<link type="text/css" href="{{ asset('admin_layout/images/icons/css/font-awesome.css')}}" rel="stylesheet">
	<link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600' rel='stylesheet'>
</head>
<body>

	<div class="navbar navbar-fixed-top">
		<div class="navbar-inner">
			<div class="container">
				<a class="btn btn-navbar" data-toggle="collapse" data-target=".navbar-inverse-collapse">
					<i class="icon-reorder shaded"></i>
				</a>

			  	<a class="brand" href="#">
			  		Admin Dashboard
			  	</a>

				
			</div>
		</div><!-- /navbar-inner -->
	</div><!-- /navbar -->



	<div class="wrapper">
		<div class="container">
			<div class="row">
				<div class="module module-login span4 offset4">
					<form class="form-vertical" method="post" action="{{route('admin.post.login')}}">
						{{ csrf_field() }}
						<div class="module-head">
							<h3>Sign In</h3>
						</div>
						<div class="module-body">
							<div class="control-group">
								<div class="controls row-fluid">
									<input class="span12" type="text" id="inputEmail" name="username" placeholder="Username">
								</div>
							</div>
							<div class="control-group">
								<div class="controls row-fluid">
									<input class="span12" type="password" id="inputPassword" name="password" placeholder="Password">
								</div>
							</div>
							@if(session('error'))
							<div class="control-group">
								<div class="controls row-fluid">
									<div class="alert alert-danger alert-dismissible">
										<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
										<strong>Danger!</strong> {{session('error')}}
									</div>
								</div>
							</div>
							@endif
						</div>
						<div class="module-foot">
							<div class="control-group">
								<div class="controls clearfix">
									<button type="submit" class="btn btn-primary pull-right">Login</button>
									<label class="checkbox">
										<input type="checkbox" name="remember"> Remember me
									</label>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div><!--/.wrapper-->

	<div class="footer">
		<div class="container">
			 

			<b class="copyright">&copy; 2014 Edmin - EGrappler.com </b> All rights reserved.
		</div>
	</div>
	<script src="{{ asset('admin_layout/scripts/jquery-1.9.1.min.js')}}" type="text/javascript"></script>
	<script src="{{ asset('admin_layout/scripts/jquery-ui-1.10.1.custom.min.js')}}" type="text/javascript"></script>
	<script src="{{ asset('admin_layout/bootstrap/js/bootstrap.min.js')}}" type="text/javascript"></script>
</body>