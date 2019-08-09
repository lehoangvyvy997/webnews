<!DOCTYPE html>
<html lang="en">
    <?php 
      use App\cate;
      use Illuminate\Support\Facades\Auth;
      use Illuminate\Support\Facades\DB;
      $cate = cate::all();
      $new = DB::table('news')->orderBy('view', 'desc')->get();
      $user = Auth::user();
    ?>

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>@yield('title')</title>

    <!-- Bootstrap core CSS -->
    <link href="{{asset('home_layout/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <link href="{{asset('home_layout/css/blog-home.css')}}" rel="stylesheet">
    <link href="{{asset('home_layout/css/blog-post.css')}}" rel="stylesheet">
    <style>
      .c6{
        width:50%;
        float:left;
        list-style: none;
      }
      .clf{
        clear: both;
      }
    </style>

  </head>

  <body>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="container">
        <a class="navbar-brand" href="{{route('home.get.index')}}">My Blog</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            
            <li class="nav-item">
              <a class="nav-link" href="{{route('home.get.about')}}">About Me</a>
            </li>
            @if(!Auth::check())
              <li class="nav-item">
                <a class="nav-link" href="{{route('home.get.login')}}">Login</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="{{route('home.get.regis')}}">Register</a>
              </li>
            @endif
            @if(Auth::check())
              <li class="nav-item">
                <div class="dropdown">
                  <a class="nav-link" data-toggle="dropdown" href="#">{{$user['username']}}</a>
                  <ul class="dropdown-menu" style="min-width:auto;text-align:center;">
                      <li><a href="{{route('home.get.edit')}}">Edit info</a></li>
                      <li><a href="#" data-toggle="modal" data-target="#myModal">Change pass</a></li>
                    </ul>
                </div>
              </li>
              <li class="nav-item">
                <a class="nav-link xacnhan" href="{{route('home.get.logout')}}">Logout</a>
              </li>
            @endif
          </ul>
        </div>
      </div>
    </nav>

    <!-- Page Content -->
    <div class="container">

      <div class="row">

        @yield('content')

        <!-- Sidebar Widgets Column -->
        <div class="col-md-4">

          <!-- Search Widget -->
          <div class="card my-4">
            <h5 class="card-header">Search</h5>
            <div class="card-body">
              <div class="input-group">
                <input type="text" class="form-control" placeholder="Search for...">
                <span class="input-group-btn">
                  <button class="btn btn-secondary" type="button">Go!</button>
                </span>
              </div>
            </div>
          </div>
  
          <!-- Categories Widget -->
          <div class="card my-4">
            <h5 class="card-header">Categories</h5>
            <div class="card-body">
                @foreach($cate as  $val)
                @if($val->status == 1)
                  <li class="c6">
                    <a href="{{route('home.get.category',$val->cate)}}">{{$val->cate}}</a>
                  </li>
                @endif
              @endforeach
              <div class="clf"></div>
            </div>
          </div>

          <!-- Side Widget -->
          <div class="card my-4">
            <h5 class="card-header">Hot news</h5>
            <div class="card-body">
              @foreach($new as $val)
                @if($val->status == 1)
                  <li style="list-style:none">
                    <a href="{{route('home.get.content',$val->changetitle)}}">{{$val->title}}</a>
                  </li>
                @endif
              @endforeach
            </div>
          </div>

        </div>

      </div>
      <!-- /.row -->

    </div>
    <!-- /.container -->
    {{-- modal --}}
	<div class="modal fade" id="myModal" role="dialog">
      <div class="modal-dialog">
          <div class="modal-content">
          <form class="chpass" method="POST" action="{{route('home.post.changepass')}}">
              {{ csrf_field() }}
            <div class="modal-header">
              
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

    <!-- Footer -->
    <footer class="py-5 bg-dark">
      <div class="container">
        <p class="m-0 text-center text-white">Copyright &copy; Starboostrap - cre by <a target="blank" href="https://www.facebook.com/nguyenphuong.2661999">nguyen phuong</a> </p>
      </div>
      <!-- /.container -->
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="{{asset('home_layout/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('home_layout/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    @if(session('phanquyen'))
      <script>
          alert('{{session('phanquyen')}}');
      </script>
    @endif
    <script>
      $('.xacnhan').click(function(e) {
					if (!confirm('Bạn chắc chắn không ? ')) {
						e.preventDefault();
					}
    	});
      $('#luu').click(function(event){
				event.preventDefault();
				$.ajax({
					url: '{{route('home.post.changepass')}}',
					type: 'post',
					data: $('.chpass').serialize(),
				})
				.done(function(data) {
					$('#ketqua').html(data);
				});
			});
    </script>
    @yield('js')
  </body>

</html>
