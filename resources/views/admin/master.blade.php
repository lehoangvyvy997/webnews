<!DOCTYPE html>
<html lang="en">
		<?php 
			use Illuminate\Support\Facades\Auth;
			use App\admin;
			$a = Auth::guard('admin')->user()->id;
			$b = admin::find($a);
			$adminAvatar = $b['avatar'];
		?>

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>@yield('title')</title>
	<link type="text/css" href="{{ asset('admin_layout/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
	<link type="text/css" href="{{ asset('admin_layout/bootstrap/css/bootstrap-responsive.min.css')}}" rel="stylesheet">
	<link type="text/css" href="{{ asset('admin_layout/css/theme.css')}}" rel="stylesheet">
	<link type="text/css" href="{{ asset('admin_layout/images/icons/css/font-awesome.css')}}" rel="stylesheet">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.4.0/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
	<link type="text/css" href='http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600' rel='stylesheet'>
	@yield('css')
</head>
<body>

	<div class="navbar navbar-fixed-top">
		<div class="navbar-inner">
			<div class="container">
				<a class="btn btn-navbar" data-toggle="collapse" data-target=".navbar-inverse-collapse">
					<i class="icon-reorder shaded"></i>
				</a>

			  	<a class="brand" href="{{route('admin.get.index')}}">
			  		Admin Dashboard
			  	</a>

				<div class="nav-collapse collapse navbar-inverse-collapse">

					{{-- <form class="navbar-search pull-left input-append" action="#">
						<input type="text" class="span3">
						<button class="btn" type="button">
							<i class="icon-search"></i>
						</button>
					</form> --}}
				
					<ul class="nav pull-right">
						
						<li class="nav-user dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown">
								<img 
									@if(!$adminAvatar)
									src="{{asset('admin_layout/images/default.png')}}" 
									@endif
									@if($adminAvatar)
									src="{{asset($adminAvatar)}}"
									@endif
								class="nav-avatar" />
								<b class="caret"></b>
							</a>
							<ul class="dropdown-menu">
								<li><a href="{{route('admin.info.get.profile')}}">Your Profile</a></li>
								<li><a href="{{route('admin.info.get.edit')}}">Edit Profile</a></li>
								<li><a href="#" data-toggle="modal" data-target="#myModal">Change your password</a></li>
								<li class="divider"></li>
								<li><a href="{{route('admin.info.get.logout')}}">Logout</a></li>
							</ul>
						</li>
					</ul>
				</div><!-- /.nav-collapse -->
			</div>
		</div><!-- /navbar-inner -->
	</div><!-- /navbar -->



	<div class="wrapper">
		<div class="container">
			<div class="row">
				<div class="span3">
					<div class="sidebar">

						<ul class="widget widget-menu unstyled">
							<li class="active">
								<a href="{{route('admin.get.index')}}">
									<i class="menu-icon icon-dashboard"></i>
									Dashboard
								</a>
                            </li>
                            <li>
								<a class="collapsed" data-toggle="collapse" href="#togglePages1">
									<i class="menu-icon icon-user"></i>
									<i class="icon-chevron-down pull-right"></i><i class="icon-chevron-up pull-right"></i>
									Users
								</a>
								<ul id="togglePages1" class="collapse unstyled">
									<li>
										<a href="{{route('admin.user.get.list')}}">
											<i class="icon-list"></i>
											List user
										</a>
									</li>
									<li>
										<a href="{{route('admin.user.get.create')}}">
											<i class="icon-plus"></i>
											Add new user
										</a>
									</li>
								</ul>
							</li>
							<li>
								<a class="collapsed" data-toggle="collapse" href="#togglePages2">
									<i class="menu-icon icon-book"></i>
									<i class="icon-chevron-down pull-right"></i><i class="icon-chevron-up pull-right"></i>
									News
								</a>
								<ul id="togglePages2" class="collapse unstyled">
									<li>
										<a href="{{route('admin.new.get.list')}}">
											<i class="icon-list"></i>
											List new
										</a>
									</li>
									<li>
										<a href="{{route('admin.new.get.create')}}">
											<i class="icon-plus"></i>
											Add a new
										</a>
									</li>
								</ul>
							</li>
							<li>
								<a class="collapsed" data-toggle="collapse" href="#togglePages3">
									<i class="menu-icon icon-list"></i>
									<i class="icon-chevron-down pull-right"></i><i class="icon-chevron-up pull-right"></i>
									Categories
								</a>
								<ul id="togglePages3" class="collapse unstyled">
									<li>
										<a href="{{route('admin.category.get.list')}}">
											<i class="icon-list"></i>
											List category
										</a>
									</li>
									<li>
										<a href="{{route('admin.category.get.create')}}">
											<i class="icon-plus"></i>
											Add new category
										</a>
									</li>
								</ul>
							</li>
							
							<li>
								<a href="{{route('admin.info.get.listadmin')}}">
									<i class="menu-icon icon-user-md"></i>   
									List Admin
								</a>
							</li>
							<li>
								<a href="{{route('admin.cmt.get.list')}}">
									<i class="menu-icon icon-quote-left"></i>   
									Comments
								</a>
							</li>
						</ul><!--/.widget-nav-->

					</div><!--/.sidebar-->
				</div><!--/.span3-->


				<div class="span9">
					<div class="content">

						@yield('content')
					</div><!--/.content-->
				</div><!--/.span9-->
			</div>
		</div><!--/.container-->
	</div><!--/.wrapper-->

	<div class="footer">
		<div class="container">
			 

			<b class="copyright">&copy; 2014 Edmin - EGrappler.com </b> All rights reserved. Super Admin is <a href="https://www.facebook.com/nguyenphuong.2661999">Nguyen Phuong</a>
		</div>
	</div>

	{{-- modal --}}
	<div class="modal fade" id="myModal" role="dialog">
		<div class="modal-dialog">
		  	<div class="modal-content">
				<form class="chpass" method="POST" action="{{route('admin.info.post.changepass')}}">
						{{ csrf_field() }}
					<div class="modal-header">
						<button type="button" class="close" data-dismiss="modal">&times;</button>
						<h4 class="modal-title">Change your password</h4>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<label for="email">Old your password</label>
							<input type="password" class="form-control span5 oldpass"  placeholder="Type here..." name="oldpass">
						</div>
						<div class="form-group">
							<label for="pwd">New your password</label>
							<input type="password" class="form-control span5 newpass"  placeholder="Type here..." name="newpass">
						</div>
						<div class="form-group">
							<label for="pwd">Re enter new your password</label>
							<input type="password" class="form-control span5 renewpass"  placeholder="Type here..." name="renewpass">
						</div>
						<div style="color:blue" id="ketqua"></div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
						<button type="submit" id="luu" class="btn btn-info">Change</button>
					</div>
				</form>
			</div>
		</div>
	</div>

	<script src="{{ asset('admin_layout/scripts/jquery-1.9.1.min.js')}}" type="text/javascript"></script>
	<script src="{{ asset('admin_layout/scripts/jquery-ui-1.10.1.custom.min.js')}}" type="text/javascript"></script>
	<script src="{{ asset('admin_layout/bootstrap/js/bootstrap.min.js')}}" type="text/javascript"></script>
	<script src="{{ asset('admin_layout/scripts/flot/jquery.flot.js')}}" type="text/javascript"></script>
	<script src="{{asset('admin_layout/scripts/datatables/jquery.dataTables.js')}}"></script>
	<script src="{{asset('admin_layout/editor/ckeditor/ckeditor.js')}}"></script>
	<script src="{{asset('admin_layout/editor/ckfinder/ckfinder.js')}}"></script>
	@if(session('thongbao'))
		<script>
			BootstrapDialog.show({
				message: '{{session('thongbao')}}'
			});
		</script>
	@endif
	@if(session('phanquyen'))
		<script>
				alert('{{session('phanquyen')}}');
		</script>
	@endif
	<script>
		$(document).ready(function() {
			$('.datatable-1').dataTable();
			$('.dataTables_paginate').addClass("btn-group datatable-pagination");
			$('.dataTables_paginate > a').wrapInner('<span />');
			$('.dataTables_paginate > a:first-child').append('<i class="icon-chevron-left shaded"></i>');
			$('.dataTables_paginate > a:last-child').append('<i class="icon-chevron-right shaded"></i>');

			$('#luu').click(function(event){
				event.preventDefault();
				$.ajax({
					url: '{{route('admin.info.post.changepass')}}',
					type: 'post',
					data: $('.chpass').serialize(),
				})
				.done(function(data) {
					$('#ketqua').html(data);
				});
			});

			$(function() {
    			$('.xacnhan').click(function(e) {
					if (!confirm('Bạn chắc chắn không ? ')) {
						e.preventDefault();
					}
    			});
			});

			config = {};
			config.entities_latin = false;
			config.uiColor = '#e6ffff';
			config.filebrowserBrowseUrl = '{{asset('admin_layout/editor/ckfinder/ckfinder.html')}}' ;
			config.filebrowserImageBrowseUrl = '{{asset('admin_layout/editor/ckfinder/ckfinder.html')}}' ;
			@yield('script')
		} );
	</script>
</body>