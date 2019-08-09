@extends('admin.master')
@section('title','Dash Board')
@section('content')
<div class="btn-controls">
	<div class="btn-box-row row-fluid">
		<a href="#" class="btn-box big span4"><i class=" icon-user"></i><b>{{$user}}</b>
					<p class="text-muted">
							User</p>
			</a><a href="#" class="btn-box big span4"><i class="icon-user-md"></i><b>{{$admin}}</b>
					<p class="text-muted">
							Admin</p>
			</a><a href="#" class="btn-box big span4"><i class="icon-book"></i><b>{{$new}}</b>
					<p class="text-muted">
							New</p>
			</a>
	</div>
	<div class="btn-box-row row-fluid">
			<a href="#" class="btn-box big span4"><i class=" icon-quote-left"></i><b>{{$cmt}}</b>
					<p class="text-muted">
							Comment</p>
			</a><a href="#" class="btn-box big span4"><i class="icon-list"></i><b>{{$cate}}</b>
					<p class="text-muted">
							Category</p>
			</a><a href="#" class="btn-box big span4"><i class="icon-eye-open"></i><b>{{$sum}}</b>
					<p class="text-muted">
							View</p>
			</a>
	</div>
</div>
@endsection