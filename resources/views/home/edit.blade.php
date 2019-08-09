@extends('home.master')
@section('title','Edit info')
@section('content')
<div class="col-lg-8">
        <h2 style="margin-top:20px">Edit</h2>
        <form action="{{route('home.post.edit')}}" method="POST" enctype="multipart/form-data">
            {{ csrf_field() }}
          <div class="form-group">
            <label for="email">Fullname</label>
            <input type="text" 
            @if($user['fullname'])
                value="{{$user['fullname']}}"
            @endif
            class="form-control" id="email" placeholder="Enter username" name="fullname">
          </div>
          <div class="form-group">
            <label for="email">Age</label>
            <input type="text" class="form-control" 
            @if($user['age'])
                value="{{$user['age']}}"
            @endif
            id="email" placeholder="Enter age" name="age">
        </div>
        <div class="control-group">
            
            <div class="controls">Avatar
                <input type="file" style="display:none;" id="basicinput" name="avatar" class="span8 img-upload" >
                <br>
                <img style="padding: 10px 10px;
                background-color: white;
                box-shadow: 0 1px 3px rgba(34, 25, 25, 0.4);
                -moz-box-shadow: 0 1px 2px rgba(34,25,25,0.4);
                -webkit-box-shadow: 0 1px 3px rgba(34, 25, 25, 0.4);" class="img-bnupload" 
                @if($user['avatar'])
                src="{{asset($user['avatar'])}}"
                @endif
                @if(!$user['avatar'])
                src="{{asset('admin_layout/images/default.png')}}"
                @endif
                width="50px" height="50px">
            </div>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="text" class="form-control" 
            @if($user['email'])
                value="{{$user['email']}}"
            @endif
            id="email" placeholder="Enter email" name="email">
        </div>
        <div class="form-group">
            <label for="email">Facebook</label>
            <input type="text" class="form-control" 
            @if($user['facebook'])
                value="{{$user['facebook']}}"
            @endif
            id="email" placeholder="Enter facebook" name="facebook">
        </div>
        <div class="form-group">
            <label for="email">Github</label>
            <input type="text" class="form-control" 
            @if($user['github'])
                value="{{$user['github']}}"
            @endif
            id="email" placeholder="Enter github" name="github">
        </div>
        <div class="form-group">
            <label for="email">Skype</label>
            <input type="text" class="form-control" 
            @if($user['skype'])
                value="{{$user['skype']}}"
            @endif
            id="email" placeholder="Enter skype" name="skype">
        </div>
          @if (count($errors) > 0)
          <div class="alert alert-danger span8">
              <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
              @foreach ($errors->all() as $error)
                  {{ $error }}<br>
              @endforeach
          </div>
          @endif
          <button type="submit" class="btn btn-default">Submit</button>
        </form>
        <br>
</div>
@endsection
@section('js')
<script>
    $('.img-bnupload').click(function(){
        $('.img-upload').click();
        //var a = $('input[type="file"]').val();
        //$(".img-bnupload").attr("src",a);
    });
    $('.img-upload').change( function(event) {
        var tmppath = URL.createObjectURL(event.target.files[0]);
            $(".img-bnupload").fadeIn("fast").attr('src',tmppath);       
        });
</script>
@endsection